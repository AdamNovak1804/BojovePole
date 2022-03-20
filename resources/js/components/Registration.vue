<style scoped>

    .registration-form {
        margin-top: 30%;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="main">
            <div class="justify-center">
                <div class="registration-form p-4">
                    <h1 class="text-center">Registrovať sa</h1>
                    <p class="text-center">Položky označené * sú povinné</p>
                    <form method="POST" @submit.prevent="postForm">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="name" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input v-model="form.name" name="name" type="text" id="name" placeholder="Používateľské meno">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="email" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input v-model="form.email" name="email" type="text" id="email" placeholder="Prihlasovací Email">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="password" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input v-model="form.password" name="password" type="password" id="password" placeholder="Heslo">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="password_confirmation" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input v-model="form.password_confirmation" name="password_confirmation" type="password" id="password_confirmation" placeholder="Potvrdenie hesla">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="terms" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <div class="row align-items-center pt-2 pb-2">
                                        <div class="col-2">
                                            <input type="checkbox" id="terms" name="terms" value="accept">
                                        </div>
                                        <div class="col-8">
                                            <label for="terms">Súhlasím s obchodnými podmienkami</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="row align-items-center pt-2 pb-2">
                                        <div class="col-2">
                                            <input type="checkbox" id="subscribe" name="subscribe" value="newsletter">
                                        </div>
                                        <div class="col-8">
                                            <label for="subscribe">Chcem odoberať newsletter</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pb-2">
                                <div class="col-8 offset-2">
                                    <button type="submit" class="btn btn-action">Registrovať sa</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    console.log('User registered');
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }

</script>
