<template>
    <form method="POST" @submit.prevent="submit">
        <label for="cemetery-name">
            Názov cintorínu
        </label>
        <input v-model="form.name" type="text" name="cemetery-name" id="cemetery-name" placeholder="Vojenský cintorín Veľkrop">
        <label for="cemetery-description">
            Opis cintorínu
        </label>
        <textarea v-model="form.description" name="cemetery-description" id="cemetery-description" rows="10" placeholder="Sem napíšte opis cintorínu..." />
        <button class="btn btn-action mt-3">Pridať</button>
    </form>
</template>

<script>

    export default {
        data() {
            return {
                form: {
                    name: '',
                    description: '',
                    latlng: '',
                    gallery: ''
                }
            }
        },

        props: {
            position: ''
        },

        methods: {
            submit: function() {
                this.form.latlng = this.position;

                axios.post('/api/post_cemetery', this.form).then(() => {
                    this.form.name = '';
                    this.form.description = '';
                    
                    alert('Cintorín bol úspešne pridaný na posúdenie!');
                }).catch((error) => {
                    this.$emit('cemeteryErrors', error.response.data.errors);
                })
            }
        }
    }

</script>