<style scoped>

    .card-container {
        padding-top: 130px;
    }

</style>

<template>
    <div class="container card-container">
        <div class="card">
            <img src="" alt="">
            <div class="container">
                <h2>Vojenské útvary</h2>
            </div>
        </div>
        <div class="card">
            <img src="" alt="">
            <div class="container">
                <h2>Bitky</h2>
            </div>
        </div>
        <div class="card">
            <img src="" alt="">
            <div class="container">
                <h2>Cintoríny</h2>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        mounted()
        {
            axios.get('/api/battles').then(response => {
                console.log(response.data);
            }).catch(error => {
                console.log(error);
            });
        }
    }

</script>

