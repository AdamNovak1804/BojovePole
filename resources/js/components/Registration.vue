<style scoped>

    .registration-row
    {
        margin-top: 110px;
        height: calc(100vh - 110px);
    }

</style>

<template>
    <div>
        <navbar-header />
        <div class="container">
            <b-row class="g-0 registration-row" align-v="center">
                <b-col>
                    <div>
                        <h1 class="text-center">Registrovať sa</h1>
                        <p class="text-center">Položky označené * sú povinné</p>
                    </div>
                    <b-row class="g-0">
                        <b-col offset="2" cols="8" offset-md="3" md="6" offset-lg="4" lg="4">
                            <form method="POST" @submit.prevent="postForm">
                                <b-row align-v="center">
                                    <b-col class="text-end" cols="2">
                                        <label for="registration-name" class="control-label">*</label>
                                    </b-col>
                                    <b-col cols="8">
                                        <input v-model="form.name" type="text" name="registration-name" id="registration-name" placeholder="Používateľské meno">
                                    </b-col>
                                </b-row>
                                <b-row align-v="center">
                                    <b-col class="text-end" cols="2">
                                        <label for="registration-email" class="control-label">*</label>
                                    </b-col>
                                    <b-col cols="8">
                                        <input v-model="form.email" type="text" name="registration-email" id="registration-email" placeholder="Prihlasovací Email">
                                    </b-col>
                                </b-row>
                                <b-row align-v="center">
                                    <b-col class="text-end" cols="2">
                                        <label for="registration-password" class="control-label">*</label>
                                    </b-col>
                                    <b-col cols="8">
                                        <input v-model="form.password" type="password" name="registration-password" id="registration-password" placeholder="Heslo">
                                    </b-col>
                                </b-row>
                                <b-row align-v="center">
                                    <b-col class="text-end" cols="2">
                                        <label for="registration-password-confirmation" class="control-label">*</label>
                                    </b-col>
                                    <b-col cols="8">
                                        <input v-model="form.password_confirmation" type="password" name="registration-password-confirmation" id="registration-password-confirmation" placeholder="Potvrdenie hesla">
                                    </b-col>
                                </b-row>
                                <b-row class="pt-2 pb-2" align-v="center">
                                    <b-col class="text-end" cols="2">
                                        <label for="registration-terms" class="control-label">*</label>
                                    </b-col>
                                    <b-col cols="8">
                                        <b-row align-v="center">
                                            <b-col cols="2">
                                                <input type="checkbox" id="registration-terms" name="registration-terms" value="accept">
                                            </b-col>
                                            <b-col cols="8">
                                                <label for="registration-terms">Súhlasím s obchodnými podmienkami</label>
                                            </b-col>
                                        </b-row>
                                    </b-col>
                                </b-row>
                                <b-row class="pt-2 pb-2" align-v="center">
                                    <b-col offset="2" cols="8">
                                        <b-row align-v="center">
                                            <b-col cols="2">
                                                <input type="checkbox" id="registration-subscribe" name="registration-subscribe" value="newsletter">
                                            </b-col>
                                            <b-col cols="8">
                                                <label for="registration-subscribe">Chcem odoberať newsletter</label>
                                            </b-col>
                                        </b-row>
                                    </b-col>
                                </b-row>
                                <b-row class="pt-2">
                                    <b-col offset="2" cols="8">
                                        <button type="submit" class="btn btn-action">Registrovať sa</button>
                                    </b-col>
                                </b-row>
                            </form>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
        </div>
        <b-modal
            ref="registration-error-modal"
            hide-footer
        >
            <error-list 
                :errors="errors"
            />
        </b-modal>
        <navbar-footer />
    </div>
</template>

<script>

    export default {
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '' // this has to be named like this
                },
                errors: []
            }
        },

        methods: {
            postForm() {
                axios.post('/api/register', this.form).then(() => {
                    alert('Boli ste úspešne zaregistrovaný!');
                    this.$router.push({
                        name: 'Prihlásenie'
                    }).catch((error) => {
                        console.log(error.response);
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                    this.$refs['registration-error-modal'].show();
                });
            }
        }
    }

</script>
