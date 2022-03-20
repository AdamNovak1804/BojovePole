<style scoped>

    @media screen and (max-width: 450px)
    {
        h1
        {
            font-size: 48px;
        }
    }

    .main
    {
        display: flex;
        justify-content: center;
        align-content: center;
        background-color: #FFF;
        height: 100%;
    }

    .sidenav {
        height: 100%;
        background-color: #000;
        overflow-x: hidden;
        padding-top: 20px;
    }

    @media screen and (max-height: 450px) {
        ::v-deep .sidenav {
            padding-top: 15px;
        }
    }

    @media screen and (min-width: 768px) {

        .main {
            margin-left: 50%;
        }

        .login-form {
            margin-top: 80%;
        }

        .sidenav {
            width: 50%;
            position: fixed;
            z-index: -1;
            top: 0;
            left: 0;
        }
    }

    @media screen and (max-width: 450px) {

        .login-form{
            margin-top: 40%;
        }
    }

    .login-main-text {
        margin-top: 20%;
        padding: 60px;
    }

    .link-center {
        margin-bottom: 20px;
        align-self: center;
        text-align: center;
        display: block;
        color: #540202;
    }

    form {
        width: 60%;
        margin: 0 auto;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="sidenav">
            <div class="login-main-text">
                <h2>Prečo je dobré<br> mať vytvorený účet?</h2>
                <p>Po vytvorení účtu novo registrovaný používateľ získa možnosť pridať vlastný obsah, ako aj komunikovať s ostatnými používateľmi.</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <h1 class="text-center">Prihlásiť sa</h1>
                    <router-link to="/registracia" class="link-center">
                        Nemáte účet?
                    </router-link>
                    <form method="POST" @submit.prevent="postForm">
                        <div class="form-group">
                            <input v-model="form.email" name="email" type="text" placeholder="Zadajte prihlasovací Email">
                        </div>
                        <div class="form-group">
                            <input v-model="form.password" name="password" type="password" placeholder="Zadajte heslo">
                        </div>
                        <button type="submit" class="btn btn-action mt-4">Prihlásiť sa</button>
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
                    email: '',
                    password: ''
                },
                errors: []
            }
        },

        methods: {
            postForm() {
                axios.post('/api/login', this.form).then(() => {
                    this.$router.push({
                        name: 'Ucet'
                    }).catch((error) => {
                        console.log(error.response)
                    })
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }

</script>
