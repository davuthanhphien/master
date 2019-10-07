<template>
    <div class="item">
        <ul id="chat" v-chat-scroll="{always: false, smooth: true}">
            <div v-for="(message, index) in list_messages" :key="index">
                <li v-if="message.image !== null " class="you"
                    v-bind:style="$root.currentUserLogin.id == message.user || $root.currentUserLogin.id == message.user_id ? {'float':'right'} : {'float':'left'}">
                    <img v-bind:src="message.image" style="width: 50px;height: auto">
                </li>
                <li v-if="message.message !== null && friend_id !== ''" class="you"
                    v-bind:style="$root.currentUserLogin.id == message.user || $root.currentUserLogin.id == message.user_id ? {'float':'right'} : {'float':'left'}">
                    <div class="message" v-html="message.message"></div>
                </li>
            </div>
        </ul>
        <footer v-if="friend_id !== ''">
            <textarea id="message" v-model="message" @keyup.enter="sendMessage" placeholder="Type your message"
                      @click="checkStatus"></textarea>
            <div style="display: flex">
                <img :src="image" class="img-responsive" height="70" width="90">
                <input type="file" v-on:change="onImageChange">
                <a type="button" class="message-submit" @click="sendMessage">Send</a>
            </div>
        </footer>
    </div>
</template>

<script>
    import {EventBus} from '../event-bus.js';

    export default {
        data() {
            return {
                message: '',
                friend_id: '',
                list_messages: [],
                friends: [],
                image: '',
                typing: false,
                message_id: '',
                microtime: '',
            }
        },
        created() {
            EventBus.$on('component-friend-click', repossive => {
                this.list_messages = repossive.message;
                this.friend_id = repossive.id;
                if (this.message_id !== '') {
                    axios.post('/chat/updateMessage', {
                        id: this.message_id,
                        status: 1,
                    })
                        .then(response => {
                            console.log('update thành công')
                        })
                        .catch(error => {
                            console.log('update thất bại')
                        })
                }
            });
            var id = $('meta[name="auth"]').attr('content');
            Echo.private('App.User.'+id)
                .notification((notification)=>{
                    axios.post('/chat/notification', {
                        amount: notification.amount,
                        id:notification.userId
                    })
                        .then(response => {
                            EventBus.$emit('component-notification', response);
                        })
                        .catch(error => {
                            console.log(error)
                        })
                });
            Echo.join('chat')
                .listen('MessagePosted', (data) => {
                    var now = new Date().getTime() / 1000;
                    console.log(now - data.microtime);
                    let message = data.message;
                    message.user = data.user;
                    this.list_messages.push(message);
                    axios.post('/chat/updateMessage', {
                        id: data.message.id,
                        status: 2,
                    })
                        .then(response => {
                            console.log('update thành công')
                        })
                        .catch(error => {
                            console.log('update thất bại')
                        });
                    this.message_id = data.message.id;
                })
                .listenForWhisper('ty', (e) => {
                    EventBus.$emit('component-typing', e);
                })
                .here((users) => {

                })
                .joining((user) => {
                    user['online'] = 1;
                    EventBus.$emit('component-online', user);
                })
                .leaving((user) => {
                    user['online'] = 0;
                    EventBus.$emit('component-offline', user);
                });
        },
        methods: {
            check() {
                let channel = Echo.join('chat');
                setTimeout( () => {
                    channel.whisper('ty', {
                        typing: false,
                        user:this.$root.currentUserLogin
                    })
                }, 300);
            },
            loadFriend() {
                axios.get('/chat/friend')
                    .then(response => {
                        this.friends = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            checkStatus() {
                let channel = Echo.join('chat');
                setTimeout( () => {
                    channel.whisper('ty', {
                        typing: true,
                        user:this.$root.currentUserLogin
                    })
                }, 300);
                event.stopPropagation();
                document.onclick = this.check;
                axios.post('/chat/deleteNotification/' + this.friend_id)
                    .then(response => {
                        EventBus.$emit('component-notify', response);
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            sendMessage() {
                if (this.message !== '') {
                    var microtime = new Date().getTime() / 1000;
                    axios.post('/chat/message', {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                        message: this.message,
                        id: this.friend_id,
                        image: this.image,
                        microtime: microtime
                    })
                        .then(response => {
                            this.list_messages.push({
                                message: response.data.message,
                                id: this.friend_id,
                                user: this.$root.currentUserLogin.id,
                                image: this.image,
                            });
                            this.message = '';
                            this.image = '';
                        })
                        .catch(erro => {
                            this.list_messages.push({
                                message: 'Đã có lỗi xảy ra !',
                                id: this.friend_id,
                                user: this.$root.currentUserLogin.id,
                                image: this.image,
                            });
                        })
                }

            },
        }
    }
</script>

<style>
    .you {
        clear: both;
    }
</style>
