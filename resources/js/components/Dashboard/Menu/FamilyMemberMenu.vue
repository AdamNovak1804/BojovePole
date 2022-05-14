<style scoped>

    .family-list
    {
        min-height: 400px;
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

    .card-title
    {
        font-weight: 900;
    }

    .status-mark
    {
        border-radius: 50%;
        height: 20px;
        width: 20px;
    }

    .member-select
    {
        height: 20px;
        width: 20px;
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
                                    <input v-model="selected" class="member-select" :value="member.id" type="checkbox" name="card-checkbox" id="card-checkbox">
                                </b-col>
                                <b-col>
                                    <img
                                        class="float-end status-mark" 
                                        :src="'/api/image/' + (member.visible ? 'icon-status-verified' : 'icon-status-waiting') + '.png'" 
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
                                <b-row>
                                    <b-col>
                                        <b>*</b> : {{ formatDate(member.date_of_birth) }}
                                    </b-col>
                                    <b-col>
                                        <b>✝</b> : {{ formatDate(member.date_of_death) }}
                                    </b-col>
                                </b-row>
                            </b-list-group-item>
                            <b-list-group-item v-if="member.cemetery">
                                <b>Pochovaný v</b> : {{ member.cemetery.name }}
                            </b-list-group-item>
                            <b-list-group-item v-if="member.unit">
                                <b>Vojenský útvar</b> : {{ member.unit.name }}
                            </b-list-group-item>
                        </b-list-group>

                        <b-card-body>
                            <p class="card-text">{{ member.biography }}</p>
                            <button @click="showMember(member)" class="btn btn-action">Zobraziť</button>
                        </b-card-body>

                    </b-card>
                </div>
            </div>
        </div>
        <b-row class="mt-3" align-h="end">
            <b-col cols="auto">
                <button @click="deleteMembers()" class="btn btn-action">Zmazať vybrané položky</button>
            </b-col>
            <b-col cols="auto">
                <button v-b-modal.add-member class="btn btn-action">Nový rodinný príslušník</button>
            </b-col>
        </b-row>
        <b-modal
            id="add-member"
            hide-footer
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
                <div class="row">
                    <div class="col">
                        <label for="member-cemetery">
                            Miesto posledného odpočinku
                        </label>
                        <select v-model="form.cemetery" name="member-cemetery" id="member-cemetery">
                            <option value="">Nevybratý cintorín</option>
                            <option
                                v-bind:value="cemetery.id"
                                v-for="cemetery in cemeteries"
                                :key="cemetery.id"
                            >
                                {{ cemetery.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="member-unit">
                            Vojenská jednotka
                        </label>
                        <select v-model="form.unit" name="member-unit" id="member-unit">
                            <option value="">Nevybratá vojenská jednotka</option>
                            <option
                                v-bind:value="unit.id"
                                v-for="unit in units"
                                :key="unit.id"
                            >
                                {{ unit.name }}
                            </option>
                        </select>
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
                    <input type="file" name="member-gallery" id="member-gallery" multiple @change="uploadFiles($event.target.files)">
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
        <b-modal
            size="xl"
            ref="member-modal"
            hide-footer
        >
            <b-carousel
                v-if="member.gallery"
                background="#ababab"
                indicators
                controls
                fade
            >
                <b-carousel-slide
                    v-for="slide in this.gallery.images"
                    :key="slide.id"
                >
                    <template #img>
                        <img
                            class="d-block img-fluid slide-img"
                            :src="'/api/userContent/' + slide.path"
                            alt="image slot"
                        >
                    </template>
                </b-carousel-slide>
            </b-carousel>

            <b-card-body>
                <h1>{{ this.member.name }}</h1>
            </b-card-body>

            <b-row>
                <b-col cols="4">
                    <b-list-group flush>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Dátum narodenia</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ formatDate(this.member.date_of_birth) }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item>
                            <b-row>
                                <b-col>
                                    <p><b>Dátum úmrtia</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ formatDate(this.member.date_of_death) }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item v-if="this.member.cemetery">
                            <b-row>
                                <b-col>
                                    <p><b>Pochovaný v</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ this.member.cemetery.name }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                        <b-list-group-item v-if="this.member.unit">
                            <b-row>
                                <b-col>
                                    <p><b>Vojenský útvar</b> :</p>
                                </b-col>
                                <b-col cols="auto" class="text-end">
                                    <p>{{ this.member.unit.name }}</p>
                                </b-col>
                            </b-row>
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
                <b-col>
                    <p>{{ this.member.biography }}</p>
                </b-col>
            </b-row>
        </b-modal>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {

        data() {
            return {
                form: {
                    id: '',
                    firstname: '',
                    lastname: '',
                    date_of_birth: '1840-01-01',
                    date_of_death: '1914-07-28',
                    biography: '',
                    cemetery: '',
                    unit: '',
                    gallery: []
                },

                member: '',
                family: '',
                units: '',
                cemeteries: '',
                errors: '',
                gallery: '',
                status: '',
                selected: []
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getFamily();
            this.getUnits();
            this.getCemeteries();
        },

        methods: {
            getFamily: function() {
                axios.get('/api/get_family').then((response) => {
                    this.family = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },

            getUnits: function() {
                axios.get('/api/get_units').then((response) => {
                    this.units = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },

            getCemeteries: function() {
                axios.get('/api/get_cemeteries').then((response) => {
                    this.cemeteries = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            postMember: function() {
                var form = this.createForm();

                axios.post('/api/post_member', form).then((response) => {
                    alert('Rodinný príslušník bol pridaný na posúdenie!\nProsím oznámte historikovi pridanie nového rodinného príslušníka.');
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                    this.showModal();
                });
            },

            deleteMembers: function() {
                axios.delete('/api/delete_members', { data: this.selected }).then((response) => {
                    alert('Úspešne vymazaných ' + response.data + ' rodinných príslušníkov!');
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },
            
            showModal: function() {
                this.$refs['error-modal'].show();
            },

            showMember: function(value) {
                this.member = value;
                this.gallery = JSON.parse(this.member.gallery);
                this.$refs['member-modal'].show();
            },

            uploadFiles: function(files) {
                Array.from(files).forEach((file) => {
                    this.form.gallery.push(file);
                });
            },

            createForm: function() {
                var formData = new FormData();

                formData.append('id', this.form.id);
                formData.append('firstname', this.form.firstname);
                formData.append('lastname', this.form.lastname);
                formData.append('date_of_birth', this.form.date_of_birth);
                formData.append('date_of_death', this.form.date_of_death);
                formData.append('cemetery', this.form.cemetery);
                formData.append('unit', this.form.unit);
                formData.append('biography', this.form.biography);

                for ( var i = 0; i < this.form.gallery.length; i++ ) {
                    formData.append('gallery[' + i + ']', this.form.gallery[i]);
                }

                return formData;
            },
        }
    }

</script>