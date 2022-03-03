<style scoped>

    .main-head{
        height: 150px;
    }

    .sidenav {
        height: 100%;
        background-color: #000;
        overflow-x: hidden;
        padding-top: 20px;
    }

    .main {
        display: flex;
        justify-content: center;
        align-content: center;
        background-color: #FFF;
        height: 100%;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
    }

    @media screen and (max-width: 450px) {
        .login-form{
            margin-top: 10%;
        }

        .register-form{
            margin-top: 10%;
        }
    }

    @media screen and (min-width: 768px){
        .main{
            margin-left: 50%;
        }

        .sidenav{
            width: 50%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
        }

        .login-form{
            margin-top: 80%;
        }

        .register-form{
            margin-top: 20%;
        }
    }

    .login-main-text{
        margin-top: 20%;
        padding: 60px;
        color: #fff;
    }

    .login-main-text h2{
        font-weight: 300;
    }

    .btn-login {
        color: #EDE0A6;
        background-color: #540202 !important;
        width: 100%;
    }

    .link-center {
        margin-bottom: 20px;
        align-self: center;
        text-align: center;
        display: block;
        color: #540202;
    }

    ::placeholder {
        color: #998067;
    }

    input[type=text], input[type=password], input[type=text]:focus, input[type=password]:focus {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        border-bottom: 2px solid #540202;
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
                    <router-link to="/registracia" class="link-center">
                        Nemáte účet?
                    </router-link>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Zadajte prihlasovací Email">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Zadajte heslo">
                        </div>
                        <button type="submit" class="btn btn-login">Prihlásiť sa</button>
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
