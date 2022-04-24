<style scoped>

    .main
    {
        margin-top: 110px;
        min-height: calc(100vh - 110px);
        background-color: #FFF;
    }

    ::v-deep textarea
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

    ::v-deep select
    {
        border: 2px solid #540202;
        border-radius: 5px;
        background-color: #EDE0A6;
        padding: 8px 5px 8px 5px;
        width: 100%;
    }

    ::v-deep label
    {
        margin-top: 8px;
        padding: 5px 0px 5px 0px;
    }

    ::v-deep .submit-btn
    {
        width: 100%;
    }

    ::v-deep .dropbox
    {
        outline: 2px dashed #540202;
        outline-offset: -5px;
        background-color: #EDE0A6;
        position: relative;
        cursor: pointer;
    }

    ::v-deep input[type="file"]
    {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        cursor: pointer;
    }

    ::v-deep .dropbox p
    {
        margin: 0;
        text-align: center;
        padding: 30px 5px 30px 5px;
    }

    ::v-deep option:disabled
    {
        color: #998067;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6 offset-md-6 offset-lg-6 mt-3 mb-2 text-center">
                        <h2>Pridanie nového objektu</h2>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12 col-lg-6 col-md-6">
                        <add-map 
                            v-on:changeMarker="updateLatLng"
                        />
                    </div>
                    <div class="col-12 col-lg-6 col-md-6">
                        <form>
                            <div class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <label for="type">
                                    Pridať nový objekt do mapy
                                </label>
                                <select id="type" v-model="type" @change="onChange($event)">
                                    <option :value="0" disabled>Vybrať zo zoznamu</option>
                                    <option v-for="choice in choices" :key="choice.id" :value="choice.id">{{ choice.text }}</option>
                                </select>
                            </div>
                            <div v-if="type === 1" class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <unit-form
                                    v-on:unitErrors="displayErrors"
                                    :position="position"
                                />
                            </div>
                            <div v-else-if="type === 2" class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <battle-form
                                    v-on:battleErrors="displayErrors"
                                    :position="position"
                                />
                            </div>
                            <div v-else-if="type === 3" class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <cemetery-form
                                    v-on:cemeteryErrors="displayErrors"
                                    :position="position"
                                />
                            </div>
                            <div v-else-if="type === 4" class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <landmark-form
                                    v-on:landmarkErrors="displayErrors"
                                    :position="position"
                                />
                            </div>
                        </form>
                    </div>
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
        </div>
        <navbar-footer></navbar-footer>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                type: 0,
                position: '',
                errors: [],

                choices: [
                    { id: 1, text: 'Vojenský útvar' },
                    { id: 2, text: 'Bitka' },
                    { id: 3, text: 'Cintorín' },
                    { id: 4, text: 'Pamiatka' },
                    { id: 5, text: 'Frontová línia' }
                ]
            }
        },

        methods: {
            onChange(event) {
                this.type = parseInt(event.target.value);
                this.errors = [];
            },

            updateLatLng: function(value) {
                this.position = value;
            },

            displayErrors: function(value) {
                this.errors = value;
                this.showModal();
            },
            showModal: function() {
                this.$refs['error-modal'].show();
            }
        },

    }

</script>
