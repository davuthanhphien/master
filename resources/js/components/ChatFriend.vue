<template>
    <ul>
        <li v-for="friend in friends" @click="loadMessage(friend.id)">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="">
            <div>
                <h2>{{friend.name}}</h2>
                <h3 v-if="friend_id === friend.id">
                <span v-if="typing == true" class="help-block" style="font-style: italic;">
                           {{name}} is typing...
                </span>
                </h3>
                <h3 v-if="notification.friend_id == friend.id">
                    {{notification.name}}
                </h3>
                <h3>
                    <span class="status orange"></span>
                    <span v-if="inArray(friend.id)">online</span>
                    <span v-else>offline</span>
                </h3>
            </div>
        </li>
    </ul>
</template>

<script>
    import {EventBus} from '../event-bus.js';

    export default {
        data() {
            return {
                notification: [],
                typing: false,
                name: '',
                friend_id: '',
                check: '',
                online: [],
                list_messages: [],
                friends: [],
                status: false,
                id: '',
            }
        },
        created() {
            this.loadFriend();
            this.getonline();
            EventBus.$on('component-notification', data => {
                this.notification = data.data;
            });
            EventBus.$on('component-typing', data => {
                this.typing = data.typing;
                this.friend_id = data.user.id;
                this.name = data.user.name;
            });
            EventBus.$on('component-online', data => {
                this.check = data.id;
                this.id = data.id;
                axios.post('/chat/online',{
                    data:data.id
                })
                    .then(res=>{
                        this.online.push(data.id)
                    })
                    .catch(er=>{

                    })
            });
            EventBus.$on('component-offline', data => {
                this.check = data.id;
                this.id = data.id;
                axios.post('/chat/offline',{
                    data:data.id
                })
                    .then(res=>{
                        this.online.pop(data.id);
                    })
                    .catch(er=>{

                    })
            });
            EventBus.$on('component-notify', data => {
                this.notification = data.data;
            });
        },
        methods: {
            getonline(){
                var id = $('meta[name="auth"]').attr('content');
                axios.get('/chat/getonline')
                    .then(response => {
                        this.online = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            inArray(id){
                if (this.online.indexOf(id) > -1) {
                    return true
                }else{
                    return false
                }
            },
            loadFriend() {
                axios.get('/chat/friend')
                    .then(response => {
                        this.friends = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            loadMessage: function (id) {
                axios.get('/chat/friendMessage/' + id)
                    .then(response => {
                        EventBus.$emit('component-friend-click', response.data);
                    })
                    .catch(error => {
                        console.log(error)
                    });
                axios.post('/chat/deleteNotification/' + id)
                    .then(response => {
                        this.notification = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            loadNotification: function (id) {
                axios.get('/chat/notification/' + this.friend.id)
                    .then(response => {
                        this.notification = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
</script>
