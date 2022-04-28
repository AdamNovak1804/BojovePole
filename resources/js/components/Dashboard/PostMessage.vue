<style scoped>

    .send-row
    {
        height: 100px;
        border-radius: 15px;
        background-color: #FFF;
        box-shadow: 0px 2px 3px #999;
    }

    .btn-row
    {
        display: flex;
    }

</style>

<template>
    <div>
        <form method="POST" @submit.prevent="sendMessage">
            <div class="p-2">
                <div class="row send-row g-0 mb-2">
                    <div class="col-6 p-2">
                        <label for="post-email"><b>Emailová adresa príjemcu</b></label>
                        <input v-model="form.recipient" placeholder="jozef@novak.sk" type="text" name="post-email" id="post-email">
                    </div>
                    <div class="col-6 p-2">
                        <label for="post-subject"><b>Predmet správy</b></label>
                        <input v-model="form.subject" placeholder="Pridanie bitky" type="text" name="post-subject" id="post-subject">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <textarea placeholder="Sem napíšte správu..." v-model="form.text" rows="10"></textarea>
                    </div>
                    <div class="col-12 mt-2">
                        <error-list
                            :errors="this.errors"
                        />
                    </div>
                    <div class="col-4 offset-4 justify-content-end btn-row">
                        <button class="btn btn-action" type="submit">Odoslať správu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                form: {
                    recipient: '',
                    subject: '',
                    text: '',
                },
                errors: []
            }
        },

        methods: {
            sendMessage: function() {
                axios.post('/api/send_message', this.form).then((response) => {
                    this.errors = [];
                    this.recipient = '';
                    this.subject = '';
                    this.text = '';
                    alert('Správu sa úspešne podarilo odoslať!');
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }

</script>
