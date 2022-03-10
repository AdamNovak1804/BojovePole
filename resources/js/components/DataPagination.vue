<template>

</template>

<script>

export default {

    mounted()
    {
        axios.get('/api/family_members').then(response => {
            console.log(response.data);
        }).catch(error => {
            console.log(error);
        });
    }
}

</script>
