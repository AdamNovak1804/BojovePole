<template>
    <form action="POST" @submit.prevent="">
        <b-modal
            size="xl"
            ref="unit-edit-view"
            hide-footer
            @shown="reloadSize()"
        >
            <h1 class="text-center">Návrh o pridaní vojenského útvaru</h1>
            <add-map 
                ref="unit-edit-map"
                v-on:changeMarker="updateLatLng"
            />
            <b-row
                no-gutters
                class="mt-3"
            >
                <b-col
                    col lg="3"
                >
                    <div>
                        <label class="label-form" for="unit-edit-name">
                            Názov vojenského útvaru
                        </label>
                        <input v-model="form.name" type="text" name="unit-edit-name" id="unit-edit-name">
                        <label class="label-form" for="unit-edit-type">
                            Typ jednotky
                        </label>
                        <select class="options" v-model="form.type" name="unit-edit-type" id="unit-edit-type">
                            <option
                                v-for="type in types"
                                v-bind:value="type.value"
                                :key="type.id"
                            >
                                {{ type.text }}
                            </option>
                        </select>
                        <label class="label-form" for="unit-edit-country">
                            Krajina pôvodu
                        </label>
                        <select class="options" v-model="form.country" name="unit-edit-country" id="unit-edit-country">
                            <option
                                v-for="country in countries"
                                v-bind:value="country.id"
                                :key="country.id"
                            >
                                {{ country.name }}
                            </option>
                        </select>
                        <label class="label-form" for="unit-edit-location">
                            Základňa vojenskej jednotky
                        </label>
                        <input v-model="form.location" type="text" name="unit-edit-location" id="unit-edit-location">
                    </div>
                </b-col>
                <b-col>
                    <label class="label-form" for="unit-edit-description">
                        Opis a bojové nasadenie vojenskej jednotky
                    </label>
                    <textarea 
                        v-model="form.description"
                        class="textarea"
                        name="unit-edit-description"
                        id="unit-edit-description"
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

    export default {
        data() {
            return {
                form: {
                    visible: 0,
                    name: '',
                    type: '',
                    location: '',
                    country: '',
                    description: '',
                    reliability: '',
                    position: '',
                    to_delete: [],
                    to_upload: []
                },

                gallery: '',
                countries: '',
                errors: '',

                types: [
                    { id: 1, text: 'Peší pluk', value: 'a' },
                    { id: 2, text: 'Honvédsky peší pluk', value: 'b' },
                    { id: 3, text: 'Prápor poľných strelcov', value: 'c' },
                    { id: 4, text: 'Poľný delostrelecký pluk', value: 'd' },
                    { id: 5, text: 'Ťažký poľný delostrelecký pluk', value: 'e' }
                ]
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getCountries();
        },

        props: {
            unit: ''
        },

        methods: {
            getCountries: function() {
                axios.get('/api/get_countries').then((response) => {
                    this.countries = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            showModal: function() {
                this.form.id = this.unit.id;
                this.form.name = this.unit.name;
                this.form.country = parseInt(this.unit.country.id);
                this.form.type = this.unit.type;
                this.form.location = this.unit.location;
                this.form.description = this.unit.description;
                this.form.position = [ 
                    this.unit.longtitude, 
                    this.unit.latitude
                ];

                if ( !!this.unit.gallery ) {
                    this.gallery = JSON.parse(this.unit.gallery);
                }
                else {
                    this.gallery = { images: '' };
                }

                this.$refs['unit-edit-view'].show();
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
                formData.append('name', this.form.name);
                formData.append('type', this.form.type);
                formData.append('country', this.form.country);
                formData.append('location', this.form.location);
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

                axios.post('/api/update_unit', form).then(() => {
                    alert('Zmeny boli úspešne uložené!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            uploadRequest: function() {
                this.form.visible = 1;
                var form = this.createForm();

                axios.post('/api/update_unit', form).then(() => {
                    alert('Objekt bol úspešne zverejnený!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            deleteRequest: function() {
                axios.delete('/api/delete_unit', { data: this.form }).then(() => {
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
                this.$refs['unit-edit-map'].refreshSize();
            },

            reliabilityChange: function(value) {
                this.form.reliability = value;
            }
        }
    }

</script>