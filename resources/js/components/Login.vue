<style scoped>

    .sidenav {
        height: 100%;
        background-color: #000;
        overflow-x: hidden;
        padding-top: 20px;
    }

    @media screen and (max-height: 450px) {
        ::v-deep .sidenav {padding-top: 15px;}
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
            z-index: 1;
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
                    <router-link to="/ucet/registracia" class="link-center">
                        Nemáte účet?
                    </router-link>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Zadajte prihlasovací Email">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Zadajte heslo">
                        </div>
                        <button type="submit" class="btn btn-action mt-4">Prihlásiť sa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

}

</script>
