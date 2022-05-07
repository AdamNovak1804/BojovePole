<template>
    <form action="POST" @submit.prevent="">
        <b-modal
            size="xl"
            ref="battle-edit-view"
            hide-footer
            @shown="reloadSize()"
        >
            <h1 class="text-center">Návrh o pridanie bitky</h1>
            <add-map
                ref="battle-edit-map"
                v-on:changeMarker="updateLatLng"
            />
            <b-row no-gutters class="mt-3">
                <b-col col lg="3">
                    <div>
                        <label class="label-form" for="battle-edit-title">
                            Názov bitky
                        </label>
                        <input v-model="form.title" type="text" name="battle-edit-title" id="battle-edit-title">
                        <label class="label-form" for="battle-edit-start">
                            Začiatok
                        </label>
                        <input class="date-input" v-model="form.start" type="date" name="battle-edit-start" id="battle-edit-start">
                        <label class="label-form" for="battle-edit-end">
                            Koniec
                        </label>
                        <input class="date-input" v-model="form.end" type="date" name="battle-edit-end" id="battle-edit-end">
                        <label class="label-form" for="battle-edit-side1">
                            Útočník
                        </label>
                        <select class="options" v-model="form.side1" name="battle-edit-side1" id="battle-edit-side1">
                            <option
                                v-for="country in countries"
                                v-bind:value="country.id"
                                :key="country.id"
                            >
                                {{ country.name }}
                            </option>
                        </select>
                        <label class="label-form" for="battle-edit-side2">
                            Obranca
                        </label>
                        <select class="options" v-model="form.side2" name="battle-edit-side2" id="battle-edit-side2">
                            <option
                                v-for="country in countries"
                                v-bind:value="country.id"
                                :key="country.id"
                            >
                                {{ country.name }}
                            </option>
                        </select>
                        <label class="label-form" for="battle-edit-outcome">
                            Výsledok
                        </label>
                        <select class="options" v-model="form.outcome" name="battle-edit-outcome" id="battle-edit-outcome">
                            <option
                                v-for="out in outcomes"
                                v-bind:value="out.enum"
                                :key="out.id"
                            >
                                {{ out.text }}
                            </option>
                        </select>
                    </div>
                </b-col>
                <b-col>
                    <label class="label-form" for="battle-edit-description">
                        Opis a priebeh bitky
                    </label>
                    <textarea 
                        v-model="form.description"
                        class="textarea"
                        name="battle-edit-description"
                        id="battle-edit-description"
                        rows="10"
                    />
                    <b-row>
                        <b-col md="8">
                            <label class="label-form" for="edit-images-add">
                                Nahrať nové obrázky
                            </label>
                            <div class="dropbox">
                                <input 
                                    type="file"
                                    name="member-gallery"
                                    id="member-gallery"
                                    multiple
                                    @change="uploadFiles($event.target.files)"
                                >
                                <p>Súbory je možné vložiť do vyznačenej oblasti</p>
                            </div>
                        </b-col>
                        <b-col md="4">
                            <label class="label-form" for="edit-images">
                                Priložené obrázky
                            </label>
                            <ul class="list" name="edit-images" id="edit-images">
                                <li
                                    v-for="image in gallery.images"
                                    :key="image.id" 
                                >
                                    <div class="d-flex justify-content-between img-link">
                                        <a :href="'/api/userContent/' + image.path" target="_blank">{{ image.path }}</a>
                                        <button @click="removeImage(image)" class="img-link-delete" />
                                    </div>
                                </li>
                            </ul>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
            <edit-footer
                v-on:saveRequest="saveRequest"
                v-on:deleteRequest="deleteRequest"
                v-on:uploadRequest="uploadRequest"
                v-on:reliabilityChange="reliabilityChange"
            />
        </b-modal>
        <b-modal
            ref="error-modal"
            hide-footer
        >
            <error-list 
                :errors="errors"
            />
        </b-modal>
    </form>
</template>

<script>
    import moment from 'moment';

    export default {
        data() {
            return {
                form: {
                    visible: 0,
                    title: '',
                    start: '',
                    end: '',
                    side1: '',
                    side2: '',
                    outcome: '',
                    description: '',
                    reliability: '',
                    position: '',
                    to_delete: [],
                    to_upload: []
                },

                gallery: '',
                countries: '',
                errors: '',

                outcomes: [
                    { enum: 'side1_victory', text: 'Víťazstvo útočníka' },
                    { enum: 'stalemate', text: 'Patová situácia' },
                    { enum: 'side2_vicotry', text: 'Víťazstvo obrancu' }
                ]
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getCountries();
        },

        props: {
            battle: ''
        },

        methods: {
            getCountries: function() {
                axios.get('/api/get_countries').then((response) => {
                    this.countries = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            showModal: function() {
                this.form.id = this.battle.id;
                this.form.title = this.battle.title;
                this.form.start = this.battle.start;
                this.form.end = this.battle.end;
                this.form.side1 = parseInt(this.battle.side1.id);
                this.form.side2 = parseInt(this.battle.side2.id);
                this.form.outcome = this.battle.outcome;
                this.form.description = this.battle.description;
                this.form.position = [ 
                    this.battle.longtitude, 
                    this.battle.latitude
                ];

                if ( !!this.battle.gallery ) {
                    this.gallery = JSON.parse(this.battle.gallery);
                }
                else {
                    this.gallery = { images: '' };
                }

                this.$refs['battle-edit-view'].show();
            },

            uploadFiles: function(files) {
                Array.from(files).forEach((file) => {
                    this.form.to_upload.push(file);
                });
            },

            createForm: function() {
                var formData = new FormData();

                formData.append('id', this.form.id);
                formData.append('visible', this.form.visible);
                formData.append('reliability', this.form.reliability);
                formData.append('title', this.form.title);
                formData.append('start', this.form.start);
                formData.append('end', this.form.end);
                formData.append('side1', this.form.side1);
                formData.append('side2', this.form.side2);
                formData.append('outcome', this.form.outcome);
                formData.append('description', this.form.description);
                formData.append('latlng[0]', this.form.position[0]);
                formData.append('latlng[1]', this.form.position[1]);

                for ( var i = 0; i < this.form.to_delete.length; i++ ) {
                    formData.append('to_delete[' + i + ']', this.form.to_delete[i]);
                }

                for ( var i = 0; i < this.form.to_upload.length; i++ ) {
                    formData.append('to_upload[' + i + ']', this.form.to_upload[i]);
                }

                return formData;
            },

            saveRequest: function() {
                var form = this.createForm();

                axios.post('/api/update_battle', form).then(() => {
                    alert('Zmeny boli úspešne uložené!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            uploadRequest: function() {
                this.form.visible = 1;
                var form = this.createForm();

                axios.post('/api/update_battle', form).then(() => {
                    alert('Objekt bol úspešne zverejnený!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            deleteRequest: function() {
                axios.delete('/api/delete_battle', { data: this.form }).then(() => {
                    alert('Žiadosť bola úspešne odstránená!');
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            displayErrors: function(value) {
                this.errors = value;
                this.$refs['error-modal'].show();
            },

            removeImage: function(image) {
                this.form.to_delete.push(image.path);

                var index = this.gallery.images.findIndex(x => x.path === image.path);
                this.gallery.images.splice(index, 1);
            },

            updateLatLng: function(value) {
                this.form.position = value;
            },

            reloadSize: function() {
                this.$refs['battle-edit-map'].refreshSize();
            },

            reliabilityChange: function(value) {
                this.form.reliability = value;
            }
        }
    }

</script>