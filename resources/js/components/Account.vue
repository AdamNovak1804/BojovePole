<style scoped>

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

    ::v-deep input[type=text], ::v-deep input[type=password], ::v-deep input[type=text]:focus, ::v-deep input[type=password]:focus {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        outline: none;
        border-bottom: 2px solid #540202;
    }

</style>

<template>
    <router-view></router-view>
</template>

<script>

export default {

}

</script>
