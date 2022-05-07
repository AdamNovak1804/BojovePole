<style scoped>

    .send-row
    {
        min-height: 100px;
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
                    <div class="col-sm-6 p-2">
                        <label for="post-email"><b>Emailová adresa príjemcu</b></label>
                        <select class="options mt-3" v-model="form.recipient" name="post-email" id="post-email">
                            <option value="" disabled>Nevybratá emailová adresa</option>
                            <option v-for="contact in contacts" :key="contact.id" :value="contact.email">
                                {{ '[' + roles.find((e) => e.enum == contact.role).text + '] - ' + contact.email }}
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6 p-2">
                        <label for="post-subject"><b>Predmet správy</b></label>
                        <input v-model="form.subject" placeholder="Pridanie bitky" type="text" name="post-subject" id="post-subject">
                    </div>
                </div>
                <b-row class="justify-content-center">
                    <b-col cols="12">
                        <textarea v-model="form.text" placeholder="Sem napíšte správu..." rows="10" />
                    </b-col>
                    <b-col cols="4">
                        <button class="mt-2 btn btn-action" type="submit">Odoslať správu</button>
                    </b-col>
                </b-row>
            </div>
        </form>
        <b-modal
            ref="error-modal"
            hide-footer
        >
            <error-list 
                :errors="errors"
            />
        </b-modal>
    </div>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.');

            this.getContacts();
        },

        data() {
            return {
                form: {
                    recipient: '',
                    subject: '',
                    text: '',
                },

                contacts: '',
                errors: [],

                roles: [
                    { enum: 'user', text: 'Používateľ' },
                    { enum: 'historian', text: 'Historik' },
                    { enum: 'admin', text: 'Administrátor' }
                ]
            }
        },

        methods: {
            getContacts: function() {
                axios.get('/api/get_contacts').then((response) => {
                    this.contacts = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            sendMessage: function() {
                axios.post('/api/send_message', this.form).then(() => {
                    this.errors = [];
                    this.recipient = '';
                    this.subject = '';
                    this.text = '';
                    alert('Správu sa úspešne podarilo odoslať!');
                }).catch((error) => {
                    console.log(error.response.data.errors);
                    this.errors = error.response.data.errors;
                    this.showModal();
                });
            },

            showModal: function() {
                this.$refs['error-modal'].show();
            }
        }
    }

</script>
