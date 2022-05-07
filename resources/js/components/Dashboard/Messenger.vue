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
        min-height: 580px;
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
            <label class="btn-select" for="read_message">História správ</label>
            <input @click="selected = 2" type="radio" name="inbox" id="post_message">
            <label class="btn-select" for="post_message">Nová správa</label>
        </div>
        <div v-if="selected === 1" class="messenger-content row g-0">
            <div class="col-6 col-md-4 p-2">
                <div class="contacts">
                    <b-row no-gutters>
                        <b-col class="mb-3" cols="6">
                            <input @click="updateMessages(true)" type="radio" name="type" id="message" checked>
                            <label class="btn-mode" for="message">Prijaté</label>
                        </b-col>
                        <b-col class="mb-3" cols="6">
                            <input @click="updateMessages(false)" type="radio" name="type" id="request">
                            <label class="btn-mode" for="request">Odoslané</label>
                        </b-col>
                    </b-row>
                    <message 
                        class="message"
                        id="messages"
                        v-for="message in getDisplayedMessages()"
                        :key="message.id"
                        :message="message"
                        @click.native="displayMessage(message)"
                    />
                    <b-pagination
                        class="mt-3 pb-3"
                        v-model="current"
                        :total-rows="this.rows"
                        :per-page="this.max"
                        aria-controls="messages"
                        align="center"
                    />
                </div>
            </div>
            <div class="col-6 col-md-8 p-2 cont">
                <div v-if="this.selected_message === true" class="msg-panel mb-2">
                    <div class="img-container">
                        <img
                            class="profile-pic img-center"
                            :src="'/api/image/' + this.displayed.sender.image" 
                            width="50px" 
                            height="50px" 
                            alt="Profilová fotka"
                        >
                    </div>
                    <div class="msg-info">
                        <h3>{{ this.displayed.sender.name }}</h3>
                        <small>{{ this.displayed.sender.email }}</small>
                        <p><b>{{ this.displayed.subject }}</b></p>
                    </div>
                </div>
                <textarea v-model="this.displayed.text" rows="10" readonly />
            </div>
        </div>
        <div v-if="selected === 2" class="messenger-content">
            <post-message />
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                selected_message: false,
                selected: 1,
                image: '',
                sender: 'Od:',
                email: '',
                subject: 'Predmet:',
                message: '',
                displayed: '',

                received: true, 

                displayed_messages: '',

                current: 1,
                max: 5,
                rows: ''
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getReceivedMessages();
        },

        methods: {
            getReceivedMessages: function() {
                axios.get('/api/get_received_messages').then((response) => {
                    this.displayed_messages = response.data;
                    this.rows = this.displayed_messages.length;
                }).catch((error) => {
                    console.log(error);
                });
            },

            getSentMessages: function() {
                axios.get('/api/get_sent_messages').then((response) => {
                    this.displayed_messages = response.data;
                    this.rows = this.displayed_messages.length;
                }).catch((error) => {
                    console.log(error);
                });
            },

            displayMessage: function(message) {
                this.selected_message = true;
                this.displayed = message;
            },

            updateMessages: function(received) {
                if ( received == true) {
                    this.received = true;
                    this.getReceivedMessages();
                }
                else {
                    this.received = false;
                    this.getSentMessages();
                }
            },

            getDisplayedMessages: function() {
                return this.displayed_messages.slice(
                    (this.current - 1) * this.max,
                    this.current * this.max,
                );
            }
        }
    }

</script>
