<style scoped>

    @media screen and (max-width: 450px) {

        ::v-deep h1 {
            font-size: 48px;
        }
    }

    ::v-deep .main {
        display: flex;
        justify-content: center;
        align-content: center;
        background-color: #FFF;
        height: 100%;
    }

    ::v-deep .btn-action {
        color: #EDE0A6;
        background-color: #540202 !important;
        width: 100%;
    }

</style>

<template>
    <router-view></router-view>
</template>

<script>

export default {

}

</script>
