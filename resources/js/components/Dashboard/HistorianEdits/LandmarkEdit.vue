<template>
    <form action="POST" @submit.prevent="">
        <b-modal
            size="xl"
            ref="landmark-edit-view"
            hide-footer
            @shown="reloadSize()"
        >
            <h1 class="text-center">Návrh o pridaní cintorína</h1>
            <add-map 
                ref="landmark-edit-map"
                v-on:changeMarker="updateLatLng"
            />
            <b-row no-gutters class="mt-3">
                <b-col col lg="3">
                    <div>
                        <label class="label-form" for="landmark-edit-name">
                            Názov cintorína
                        </label>
                        <input v-model="form.name" type="text" name="landmark-edit-name" id="landmark-edit-name">
                    </div>
                </b-col>
                <b-col>
                    <label class="label-form" for="landmark-edit-description">
                        Opis a história cintorína
                    </label>
                    <textarea 
                        v-model="form.description"
                        class="textarea"
                        name="landmark-edit-description"
                        id="landmark-edit-description"
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
                                    v-for="image in form.gallery.images"
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
                    description: '',
                    reliability: '',
                    position: '',
                    gallery: '',
                    to_delete: [],
                    to_upload: []
                },

                errors: '',
            }
        },

        mounted() {
            console.log('Component mounted.');
        },

        props: {
            landmark: ''
        },

        methods: {
            showModal: function() {
                this.form.id = this.landmark.id;
                this.form.name = this.landmark.name;
                this.form.description = this.landmark.description;
                this.form.position = [ 
                    this.landmark.longtitude, 
                    this.landmark.latitude
                ];

                if ( !!this.landmark.gallery ) {
                    this.form.gallery = JSON.parse(this.landmark.gallery);
                }
                else {
                    this.form.gallery = { images: '' };
                }

                this.$refs['landmark-edit-view'].show();
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

                axios.post('/api/update_landmark', form).then(() => {
                    alert('Zmeny boli úspešne uložené!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            uploadRequest: function() {
                this.form.visible = 1;
                var form = this.createForm();

                axios.post('/api/update_landmark', form).then(() => {
                    alert('Objekt bol úspešne zverejnený!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            deleteRequest: function() {
                axios.delete('/api/delete_landmark', { data: this.form }).then(() => {
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

                var index = this.form.gallery.images.findIndex(x => x.path === image.path);
                this.form.gallery.images.splice(index, 1);
            },

            updateLatLng: function(value) {
                this.form.position = value;
            },

            reloadSize: function() {
                this.$refs['landmark-edit-map'].refreshSize();
            },

            reliabilityChange: function(value) {
                this.form.reliability = value;
            }
        }
    }

</script>