<style scoped>

    .link-center
    {
        align-self: center;
        text-align: center;
        display: block;
        color: #540202;
    }

    .login-row
    {
        height: calc(100vh - 110px);
        margin-top: 110px;
    }

    .login-col
    {
        height: calc(100vh - 110px);
    }

</style>

<template>
    <div>
        <navbar-header />
        <b-row class="g-0 login-row" align-v="center">
            <b-col>
                <b-row class="g-0">
                    <b-col offset="2" cols="8">
                        <h2>Prečo je dobré mať vytvorený účet?</h2>
                        <p>Po vytvorení účtu novo registrovaný používateľ získava možnosť pridať vlastný obsah, ako aj komunikovať s historikom.</p>
                        <p></p>
                    </b-col>
                </b-row>
            </b-col>
            <b-col lg="6" md="12">
                <b-row class="g-0">
                    <h1 class="text-center">Prihlásiť sa</h1>
                    <b-col offset-xl="4" xl="4" offset-lg="3" lg="6" offset-md="3" md="6" offset="2" cols="8">
                        <router-link to="/registracia" class="link-center bt-3">
                            Nemáte účet?
                        </router-link>
                        <form method="POST" @submit.prevent="postForm()">
                            <div class="form-group">
                                <input v-model="form.email" name="email" type="text" placeholder="Zadajte prihlasovací Email">
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" name="password" type="password" placeholder="Zadajte heslo">
                            </div>
                            <button type="submit" class="btn btn-action mt-3">Prihlásiť sa</button>
                        </form>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
        <b-modal
            ref="error-modal"
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
                    email: '',
                    password: ''
                },
                errors: []
            }
        },

        methods: {
            postForm: function() {
                axios.post('/api/login', this.form).then(() => {
                    this.$router.push({
                        name: 'Účet'
                    }).catch((error) => {
                        console.log(error.response)
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                    this.showModal();
                })
            },

            showModal: function() {
                this.$refs['error-modal'].show();
            },
        }
    }

</script>
