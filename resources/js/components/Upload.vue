<template>
    <div class="demoUploadFile">
        <div id="drop-area" @dragenter="OnDragEnter" @dragleave="OnDragLeave" @dragover.prevent @drop="onDrop" :class="{dragging : isDragging}">
            <form class="my-form">
                <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)" @change="uploadFile">
                <label class="button" for="fileElem">Select some files</label>
            </form>
            <progress id="progress-bar" max=100 value=0></progress>
            <div id="gallery"  style="display: flex;flex-wrap: wrap;">
                <img :src="image" alt="" v-for="image in images">
            </div>
        </div>
        <button @click="onUpload">Upload</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                file: [],
                images:[],
                isDragging : false,
                dragCount:0
            }

        },
        methods: {
            OnDragEnter(e){
                e.preventDefault();
                this.dragCount ++;
                this.isDragging = true
            },
            OnDragLeave(e){
                e.preventDefault();
                this.dragCount --;
                if(this.dragCount <= 0)
                this.isDragging = false
            },
            onDrop(e){
                e.preventDefault();
                e.stopPropagation();
                this.isDragging = false;
                const files = e.dataTransfer.files;
                var item = Array.from(files);
                item.forEach(element => this.addFile(element));
            },
            uploadFile(event) {
                var item = Array.from(event.target.files);
                item.forEach(element => this.addFile(element));
            },
            onUpload() {
                const formData = new FormData();
                this.file.forEach(element =>{
                    formData.append('image[]',element,element.name);
                });
                axios.post('/admin/upload',formData)
                    .then(response => {
                        console.log('ok')
                    })
                    .catch(error => {
                        console.log(error)
                    });

            },
            addFile(element){
                if(!element.type.match('image.*')){
                    return
                }
                this.file.push(element);

                const img = new Image(),
                    reader = new FileReader();
                reader.onload = (e)=> this.images.push(e.target.result);
                reader.readAsDataURL(element);
            }
        }
    }
</script>

<style>
    body {
        font-family: sans-serif;
    }
    a {
        color: #369;
    }
    #drop-area {
        border: 2px dashed #ccc;
        border-radius: 20px;
        width: auto;
        margin: 50px auto;
        padding: 20px;
    }
    #drop-area.highlight {
        border-color: purple;
    }
    p {
        margin-top: 0;
    }
    .my-form {
        margin-bottom: 10px;
    }
    #gallery {
        margin-top: 10px;
    }
    #gallery img {
        width: 150px;
        margin-bottom: 10px;
        margin-right: 10px;
        vertical-align: middle;
    }
    .button {
        display: inline-block;
        padding: 10px;
        background: #ccc;
        cursor: pointer;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .button:hover {
        background: #ddd;
    }
    #fileElem {
        display: none;
    }
</style>
