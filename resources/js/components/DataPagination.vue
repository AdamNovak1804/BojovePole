<template>

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
