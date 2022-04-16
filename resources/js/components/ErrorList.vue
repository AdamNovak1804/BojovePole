<style scoped>

    .error-box
    {
        width: 100%;
    }

    .error-box ul
    {
        margin: 0;
        padding: 0;
    }

    .error-box li
    {
        border-radius: 15px;
        list-style: none;
        padding: 5px 5px 5px 10px;
        background-color: #540202;
        color: white;
        user-select: none;
    }

    .error-box b
    {
        color: white;
    }

</style>

<template>
    <div class="error-box">
        <ul v-for="(errorlist, index) in errors" :key="index">
            <li class="error-msg mb-2" v-for="error in errorlist" :key="error.id">
                <b>! </b>{{ error }}
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        props: {
            errors: []
        }
    }

</script>