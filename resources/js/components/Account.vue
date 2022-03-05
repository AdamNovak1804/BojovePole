<style scoped>

    ::v-deep .sidenav {
        height: 100%;
        background-color: #000;
        overflow-x: hidden;
        padding-top: 20px;
    }

    ::v-deep .main {
        display: flex;
        justify-content: center;
        align-content: center;
        background-color: #FFF;
        height: 100%;
    }

    @media screen and (max-height: 450px) {
        ::v-deep .sidenav {padding-top: 15px;}
    }

    @media screen and (max-width: 450px) {
        ::v-deep .login-form{
            margin-top: 40%;
        }

        ::v-deep .register-form {
            margin-top: 10%;
        }
    }

    @media screen and (min-width: 768px) {
        ::v-deep .main {
            margin-left: 50%;
        }

        ::v-deep .sidenav {
            width: 50%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
        }

        ::v-deep .login-form {
            margin-top: 80%;
        }

        ::v-deep .register-form {
            margin-top: 20%;
        }
    }

    ::v-deep .login-main-text {
        margin-top: 20%;
        padding: 60px;
        color: #fff;
    }

    ::v-deep .login-main-text h2 {
        font-weight: 300;
    }

    ::v-deep .btn-login {
        color: #EDE0A6;
        background-color: #540202 !important;
        width: 100%;
    }

    ::v-deep .link-center {
        margin-bottom: 20px;
        align-self: center;
        text-align: center;
        display: block;
        color: #540202;
    }

    ::v-deep input[type=text], ::v-deep input[type=password], ::v-deep input[type=text]:focus, ::v-deep input[type=password]:focus {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        outline: none;
        border-bottom: 2px solid #540202;
    }

    ::v-deep form {
        width: 60%;
        margin: 0 auto;
    }

</style>

<template>
    <router-view></router-view>
</template>

<script>

export default {

}

</script>
