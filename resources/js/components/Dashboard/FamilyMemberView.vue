<style scoped>

    .family-list
    {
        padding: 7.5px;
        border-radius: 15px;
        background-color: #EDE0A6;
        width: 100%;
    }

    .member-col
    {
        padding: 7.5px;
    }

    .card
    {
        min-height: 300px;
    }

    textarea
    {
        outline: none;
        border: 2px solid #540202;
        border-radius: 5px;
        padding: 10px;
        background-color: #EDE0A6;
        resize: none;
        width: 100%;
        box-shadow: none;
    }

    select
    {
        border: 2px solid #540202;
        border-radius: 5px;
        background-color: #EDE0A6;
        padding: 8px 5px 8px 5px;
        width: 100%;
    }

    label
    {
        margin-top: 8px;
        padding: 5px 0px 5px 0px;
    }

    .submit-btn
    {
        width: 100%;
    }

    .dropbox
    {
        outline: 2px dashed #540202;
        outline-offset: -5px;
        background-color: #EDE0A6;
        position: relative;
        cursor: pointer;
    }

    input[type="file"]
    {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        cursor: pointer;
    }

    .dropbox p
    {
        margin: 0;
        text-align: center;
        padding: 30px 5px 30px 5px;
    }

</style>

<template>
    <div>
        <div class="family-list">
            <div class="row g-0">
                <div class="col-xl-4 col-lg-6 col-sm-12 member-col"
                    v-for="member in family"
                    :key="member.id"
                >
                    <b-card
                        class="card"
                        no-body
                        tag="article"
                    >
                        <b-card-body>
                            <b-row>
                                <b-col>
                                    <input type="checkbox" name="card-checkbox" id="card-checkbox">
                                </b-col>
                                <b-col>
                                    <img 
                                        class="float-end" 
                                        :src="require('/images/cancel.png').default" 
                                        alt="Indikátor statusu overenia" 
                                        width="14px" 
                                        height="14px"
                                    >
                                </b-col>
                            </b-row>
                            <h4 class="card-title text-center">{{ member.name }}</h4>
                        </b-card-body>

                        <b-list-group flush>
                            <b-list-group-item>
                                <b>*</b> : {{ formatDate(member.date_of_birth) }}
                            </b-list-group-item>
                            <b-list-group-item>
                                <b>✝</b> : {{ formatDate(member.date_of_death) }}
                            </b-list-group-item>
                        </b-list-group>

                        <b-card-body>
                            <p>{{ member.biography }}</p>
                        </b-card-body>

                    </b-card>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-action">Zmazať vybrané položky</button>
            </div>
            <div class="col">
                <button v-b-modal.add-member class="btn btn-action">Nový rodinný príslušník</button>
            </div>

            <b-modal
                id="add-member"
                hide-footer
                hide-header
            >
                <h4 class="modal-title">
                    Rodinný príslušník
                </h4>
                <form action="POST" @submit.prevent="postMember">
                    <div class="row mt-3">
                        <div class="col">
                            <label for="member-firstname">
                                Krstné meno
                            </label>
                            <input v-model="form.firstname" type="text" name="member-firstname" id="member-firstname">
                        </div>
                        <div class="col">
                            <label for="member-lastname">
                                Priezvisko
                            </label>
                            <input v-model="form.lastname" type="text" name="member-lastname" id="member-lastname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="member-date-of-birth">
                                Dátum narodenia
                            </label>
                            <input v-model="form.date_of_birth" class="date-input" type="date" name="member-date-of-birth" id="member-date-of-birth">
                        </div>
                        <div class="col">
                            <label for="member-date-of-death">
                                Dátum úmrtia
                            </label>
                            <input v-model="form.date_of_death" class="date-input" type="date" name="member-date-of-death" id="member-date-of-death">
                        </div>
                    </div>
                    <label for="member-biography">
                        Biografia
                    </label>
                    <textarea v-model="form.biography" name="member-biography" id="member-biography" rows="10" placeholder="Sem napíšte biografiu..."></textarea>
                    <label for="member-gallery">
                        Pridať fotografie
                    </label>
                    <div class="dropbox">
                        <input type="file" name="member-gallery" id="member-gallery" multiple>
                        <p>Súbory je možné vložiť do vyznačenej oblasti</p>
                    </div>
                    <button class="btn btn-action mt-3">Pridať nového člena rodiny</button>
                </form>
            </b-modal>
            <b-modal
                ref="error-modal"
                hide-footer
            >
                <error-list 
                    :errors="errors"
                />
            </b-modal>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import ErrorList from '../ErrorList.vue';

    export default {
        components: { ErrorList },

        data() {
            return {
                form: {
                    firstname: '',
                    lastname: '',
                    date_of_birth: '1840-01-01',
                    date_of_death: '1914-07-28',
                    biography: ''
                },

                family: '',
                errors: ''
            }
        },

        mounted() {
            this.getFamily();
        },

        methods: {
            getFamily: function() {
                axios.get('/api/get_family').then(response => {
                    this.family = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },

            postMember: function() {
                axios.post('/api/post_member', this.form).then(() => {
                    alert('Rodinný príslušník bol pridaný na posúdenie!');
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                    this.showModal();
                });
            },

            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },
            
            showModal: function() {
                this.$refs['error-modal'].show();
            }
        }
    }

</script>