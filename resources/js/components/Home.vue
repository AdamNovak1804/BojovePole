<style scoped>

    ::v-deep .navbar-custom
    {
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), transparent) !important;
        backdrop-filter: blur(2px);
        box-shadow: none !important;
    }

    .center-cropped
    {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: -1;
        object-fit: cover;
        background-position: center center;
        background-repeat: no-repeat;
        filter: brightness(150%) blur(2px);
    }

    .center-container
    {
        display: table;
        width: 100%;
        height: 100vh;
    }

    .center-div
    {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
    }

</style>

<template>
    <div>
        <navbar-header />
        <div class="hello"/>

        <div class="center-container">
            <div class="center-div">
                <div class="row justify-content-center g-0">
                    <div class="col-auto">
                        <h1>Po stopách naších predkov</h1>
                    </div>
                </div>
                <div class="row justify-content-center g-0">
                    <div class="col-8 col-md-6 col-lg-4">
                        <p>
                            Spoznajte príbehy bežných Slovákov, priamych účastníkov 1. sv. vojny. zdieľajte vlastné rodinné príbehy, prezrite si udalosti, ako sa odohrávali v reálnom čase...
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center g-0">
                    <div class="col-8 col-md-6 col-lg-2">
                        <router-link to="/uvod"><button class="btn btn-action">Prejsť na úvod</button></router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <img class="center-cropped" :src="'/images/background.jpg'">

        <navbar-footer />
    </div>
</template>

<script>

    export default {

    }

</script>

