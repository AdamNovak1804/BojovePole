<style scoped>

    input[type=radio]
    {
        display: none;
    }

    .btn-select
    {
        user-select: none;
        padding: 10px 10px 10px 10px;
        background-color: #FFF;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    input[type=radio]:checked + .btn-select
    {
        background-color: #EDE0A6;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    .btn-mode
    {
        width: 100%;
        text-align: center;
        user-select: none;
        padding: 10px 10px 10px 10px;
        background-color: #FFF;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    input[type=radio]:checked + label
    {
        font-weight: 900;
    }

    .messenger-content
    {
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
        background-color: #EDE0A6;
    }

    .contacts
    {
        border-radius: 15px;
        background-color: #FFF;
        box-shadow: 0px 2px 3px #999;
    }

    textarea
    {
        outline: none;
        border: none;
        border-radius: 15px;
        width: 100%;
        resize: none;
        box-shadow: 0px 2px 3px #999;
    }

    .message
    {
        height: 90px;
        cursor: pointer;
    }

    .msg-panel
    {
        border-radius: 15px;
        background-color: #FFF;
        width: 100%;
        height: 100px;
        box-shadow: 0px 2px 3px #999;
    }

    .msg-info
    {
        height: 100px;
        padding: 10px;
    }

    .msg-info h3
    {
        margin-bottom: 0;
    }

    .img-container
    {
        float: left;
        position: relative;
        height: 100px;
        width: 80px;
        padding: 10px 20px 10px 10px;
    }

    .img-center
    {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
    }

</style>

<template>
    <div>
        <div>
            <input @click="selected = 1" type="radio" name="inbox" id="read_message" checked>
            <label class="btn-select" for="read_message">Prijaté správy</label>
            <input @click="selected = 2" type="radio" name="inbox" id="post_message">
            <label class="btn-select" for="post_message">Nová správa</label>
        </div>
        <div v-if="selected === 1" class="messenger-content row g-0">
            <div class="col-6 col-md-4 p-2">
                <div class="contacts">
                    <div class="row g-0">
                        <div class="col-6 mb-2">
                            <input type="radio" name="type" id="message" checked>
                            <label class="btn-mode" for="message">Správy</label>
                        </div>
                        <div class="col-6 mb-2">
                            <input type="radio" name="type" id="request">
                            <label class="btn-mode" for="request">Žiadosti</label>
                        </div>
                        <message class="message"
                            v-for="message in messages"
                            :key="message.id"
                            :message="message"
                            @click.native="displayMessage($event)"
                        />
                        <button @click="getMessages">Load new</button>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-8 p-2 cont">
                <div v-if="this.selected_message === true" class="msg-panel mb-2">
                    <div class="img-container">
                        <img class="profile-pic img-center" :src="this.image" width="50px" height="50px" alt="Profilová fotka">
                    </div>
                    <div class="msg-info">
                        <h3>{{ this.sender }}</h3>
                        <small>{{ this.email }}</small>
                        <p><b>{{ this.subject }}</b></p>
                    </div>
                </div>
                <textarea v-model="message" rows="10" readonly />
            </div>
        </div>
        <div v-if="selected === 2" class="messenger-content">
            <post-message />
        </div>
    </div>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.');

            this.getMessages();
        },

        data() {
            return {
                selected_message: false,
                selected: 1,
                messages: '',
                image: '/images/add.png',
                sender: 'Od:',
                email: '',
                subject: 'Predmet:',
                message: ''
            }
        },

        methods: {
            getMessages: function() {
                axios.get('/api/get_messages').then(response => {
                    this.messages = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            displayMessage: function(event) {
                this.selected_message = true;
                var temp = event.currentTarget;
                this.image = temp.children[0].src;
                this.email = temp.children[2].children[0].textContent;
                this.subject = temp.children[1].children[1].textContent;
                this.sender = temp.children[1].children[0].textContent;
                this.message = temp.children[2].children[1].textContent;
            }
        }
    }

</script>
