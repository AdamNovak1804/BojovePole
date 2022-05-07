<style scoped>

    .container
    {
        margin-top: 150px;
    }

    ::v-deep .card-title
    {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
    }

</style>

<template>
    <div>
        <navbar-header />
        <div class="container">
            <router-view />
        </div>
        <navbar-footer />
    </div>
</template>

<script>

    export default {

    }

</script>
