<template>
    <form action="POST" @submit.prevent="">
        <b-modal
            size="xl"
            ref="family-member-edit-view"
            hide-footer
        >
            <h1 class="text-center">Návrh o pridanie rodinného príslušníka</h1>
            <b-row no-gutters class="mt-3">
                <b-col col lg="3">
                    <div>
                        <label class="label-form" for="family-member-edit-name">
                            Meno rodinného príslušníka
                        </label>
                        <input v-model="form.name" type="text" name="family-member-edit-name" id="family-member-edit-name">
                        <label class="label-form" for="family-member-edit-date-of-birth">
                            Dátum narodenia
                        </label>
                        <input class="date-input" v-model="form.date_of_birth" type="date" name="family-member-edit-date-of-birth" id="family-member-edit-date-of-birth">
                        <label class="label-form" for="family-member-edit-date-of-death">
                            Dátum úmrtia
                        </label>
                        <input class="date-input" v-model="form.date_of_death" type="date" name="family-member-edit-date-of-death" id="family-member-edit-date-of-death">
                        <label class="label-form" for="family-member-edit-cemetery">
                            Pochovaný v cintoríne
                        </label>
                        <select class="options" v-model="form.cemetery" name="family-member-edit-cemetery" id="family-member-edit-cemetery">
                            <option value="" disabled>Vybrať cintorín</option>
                            <option
                                v-for="cemetery in cemeteries"
                                v-bind:value="cemetery.id"
                                :key="cemetery.id"
                            >
                                {{ cemetery.name }}
                            </option>
                        </select>
                        <label class="label-form" for="family-member-edit-unit">
                            Vojenský útvar
                        </label>
                        <select class="options" v-model="form.unit" name="family-member-edit-unit" id="family-member-edit-unit">
                            <option value="" disabled>Vybrať vojenský útvar</option>
                            <option
                                v-for="unit in units"
                                v-bind:value="unit.id"
                                :key="unit.id"
                            >
                                {{ unit.name }}
                            </option>
                        </select>
                    </div>
                </b-col>
                <b-col>
                    <label class="label-form" for="family-member-edit-biography">
                        Osobná biografia rodinného príslušníka
                    </label>
                    <textarea 
                        v-model="form.biography"
                        class="textarea"
                        name="family-member-edit-biography"
                        id="family-member-edit-biography"
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
                    name: '',
                    date_of_birth: '',
                    date_of_death: '',
                    unit: '',
                    cemetery: '',
                    biography: '',
                    reliability: '',
                    to_delete: [],
                    to_upload: []
                },

                gallery: '',
                units: '',
                cemeteries: '',
                errors: ''
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.getCemeteries();
            this.getUnits();
        },

        props: {
            member: ''
        },

        methods: {
            getCemeteries: function() {
                axios.get('/api/get_cemeteries').then((response) => {
                    this.cemeteries = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            getUnits: function() {
                axios.get('/api/get_units').then((response) => {
                    this.units = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },

            formatDate: function(value) {
                return moment(value).format('DD.MM.YYYY')
            },

            showModal: function() {
                this.form.id = this.member.id;
                this.form.name = this.member.name;
                this.form.date_of_birth = this.member.date_of_birth;
                this.form.date_of_death = this.member.date_of_death;

                if (this.member.unit) {
                    this.form.unit = parseInt(this.member.unit.id);
                }

                if (this.member.cemetery) {
                    this.form.cemetery = parseInt(this.member.cemetery.id);
                }

                this.form.biography = this.member.biography;

                if ( !!this.member.gallery ) {
                    this.gallery = JSON.parse(this.member.gallery);
                }
                else {
                    this.gallery = { images: '' };
                }

                this.$refs['family-member-edit-view'].show();
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
                formData.append('date_of_birth', this.form.date_of_birth);
                formData.append('date_of_death', this.form.date_of_death);
                formData.append('unit', this.form.unit);
                formData.append('cemetery', this.form.cemetery);
                formData.append('biography', this.form.biography);

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

                axios.post('/api/update_family_member', form).then(() => {
                    alert('Zmeny boli úspešne uložené!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            uploadRequest: function() {
                this.form.visible = 1;
                var form = this.createForm();

                axios.post('/api/update_family_member', form).then(() => {
                    alert('Objekt bol úspešne zverejnený!');
                }).catch((error) => {
                    this.displayErrors(error.response.data.errors);
                });
            },

            deleteRequest: function() {
                axios.delete('/api/delete_family_member', { data: this.form }).then(() => {
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

            reliabilityChange: function(value) {
                this.form.reliability = value;
            }
        }
    }

</script>