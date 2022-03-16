<style scoped>

    .card-container {
        padding-top: 130px;
    }

    .card-info {
        background-color: #EDE0A6;
        padding: 5px;
    }

    .card {
        display: inline-block;
    }

    h2 {
        font-weight: bold;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="container card-container">
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-6">
                    <router-link to="/data/utvary">
                        <div class="card">
                            <img src="img/vojenske_utvary.png" alt="Vojenská jednotka Rakúsko-Uhorskej armády" class="card-img-top">
                            <div class="container card-info">
                                <h2 class="text-center">Vojenské útvary</h2>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <router-link to="/data/boje">
                        <div class="card">
                            <img src="img/vojenske_utvary.png" alt="Vojenská jednotka Rakúsko-Uhorskej armády" class="card-img-top">
                            <div class="container card-info">
                                <h2 class="text-center">Bitky</h2>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <router-link to="/data/cintoriny">
                        <div class="card">
                            <img src="img/vojenske_utvary.png" alt="Vojenská jednotka Rakúsko-Uhorskej armády" class="card-img-top">
                            <div class="container card-info">
                                <h2 class="text-center">Cintoríny</h2>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <router-link to="/data/pamiatky">
                        <div class="card">
                            <img src="img/vojenske_utvary.png" alt="Vojenská jednotka Rakúsko-Uhorskej armády" class="card-img-top">
                            <div class="container card-info">
                                <h2 class="text-center">Pamiatky</h2>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <router-link to="/data/krajiny">
                        <div class="card">
                            <img src="img/vojenske_utvary.png" alt="Vojenská jednotka Rakúsko-Uhorskej armády" class="card-img-top">
                            <div class="container card-info">
                                <h2 class="text-center">Krajiny</h2>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

    }

</script>

