<style scoped>

    .settings-overflow
    {
        border: 2px solid #540202;
        border-radius: 15px;
        padding: 15px;
        background-color: #FFF;
        height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .settings-menu
    {
        display: grid;
        border-radius: 15px;
        padding: 15px;
        background-color: #EDE0A6;
        width: 100%;
        height: 60vh;
    }

    .image-preview
    {
        margin: 10px auto 25px auto;
        border-radius: 50%;
        outline: 2px solid #540202;
        width: 100px;
        height: 100px;
        display: block;
        cursor: pointer;
        background-size: cover;
        background-position: center center;
    }

    .image-preview:hover
    {
        filter: brightness(0.85);
    }

    .btn-file
    {
        display: none;
    }

    h4
    {
        font-weight: 900;
    }

    .settings-text
    {
        margin-top: 10px;
        background-color: #EDE0A6;
    }

</style>

<template>
    <form action="POST" @submit.prevent="updateSettings" enctype="multipart/form-data">
        <div class="settings-menu">
            <div class="row justify-content-center">
                <div class="col-6">
                    <b-row
                        align-v="center"
                    >
                        <b-col>
                            <div
                                class="image-preview"
                                :style="{ 'background-image' : `url(${this.image})` }"
                                @click="selectImage"
                            />
                            <input class="btn-file" type="file" ref="addImage" name="addImage" id="addImage" @input="inputFile">
                        </b-col>
                        <b-col>
                            <div>
                                <h4>{{ user.name }}</h4>
                                <p>{{ user.email }}</p>
                            </div>
                        </b-col>
                    </b-row>
                </div>
            </div>
            <div class="settings-overflow">
                <b-row>
                    <b-col>
                        <label for="settings-username">
                            Používateľské meno
                        </label>
                        <input type="text" name="settings-username" id="settings-username">
                    </b-col>
                    <b-col>
                        <label for="settings-email">
                            Používateľský email
                        </label>
                        <input type="text" name="settings-email" id="settings-email">
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <label for="settings-password">
                            Heslo
                        </label>
                        <input type="password" name="settings-password" id="settings-password">
                    </b-col>
                    <b-col>
                        <label for="settings-confirm">
                            Potvrdenie hesla
                        </label>
                        <input type="password" name="settings-confirm" id="settings-confirm">
                    </b-col>
                </b-row>
                <label for="settings-about">
                    O mne
                </label>
                <textarea class="settings-text" name="settings-about" id="settings-about" rows="10" />
            </div>
        </div>
        <button class="btn btn-action mt-3">Uložiť zmeny</button>
    </form>
</template>

<script>

    export default {

        data() {
            return {
                image: require('/images/' + this.user.image).default,

                updatedUser: {
                    image: ''
                },

                form: {
                    name: this.user.name,
                    image: this.user.image
                }
            }
        },

        props: {
            user: ''
        },

        methods: {
            selectImage: function() {
                this.$refs.addImage.click();
            },

            inputFile: function(event) {
                var input   = this.$refs.addImage;
                var file    = input.files;

                if (file && file[0]) {
                    var read = new FileReader;
                    read.onload = e => {
                        this.image = e.target.result;
                    }
                    read.readAsDataURL(file[0]);
                    this.form.image = file[0];
                }
            },

            updateSettings: function() {
                
                var formData = new FormData();
                
                formData.append('name', this.form.name);
                formData.append('image', this.form.image);

                axios.post('/api/update_user', formData, { 
                    headers : {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.updatedUser.image = response.data;
                    console.log(this.updatedUser);
                    this.$emit('updateUser', this.updatedUser);
                }).catch((error) => {
                    console.log(error);
                })

                UploadService
            }
        }
    }

</script>