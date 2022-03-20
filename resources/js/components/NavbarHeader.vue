<style scoped>

    .navbar-custom
    {
        background-color: #EDE0A6;
        box-shadow: 0px 2px 3px #999;
        height: 110px;
    }

    .nav-link-custom {
        padding: 0 10px 0 10px !important;
    }

    h3 {
        border-bottom: 4px solid transparent;
    }

    .active h3 {
        border-bottom: 4px solid #540202;
    }

</style>

<template>
    <nav class="navbar navbar-expand-lg navbar-custom navbar-light fixed-top">
        <div class="container">
            <router-link to="/domov" class="navbar-brand">
                <img :src="require('../../../public/img/logo1.png').default" alt="Logotyp pre webstranku" width="auto" height="80">
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/uvod" class="nav-link nav-link-custom" active-class="active">
                            <h3>Úvod</h3>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/mapa" class="nav-link nav-link-custom" active-class="active">
                            <h3>Mapa</h3>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/data" class="nav-link nav-link-custom" active-class="active">
                            <h3>Dáta</h3>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/prihlasenie" class="nav-link nav-link-custom" active-class="active">
                            <h3>Účet</h3>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
