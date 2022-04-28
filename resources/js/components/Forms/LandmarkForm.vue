<template>
    <form method="POST" @submit.prevent="submit">
        <label for="landmark-name">
            Názov pamätníka
        </label>
        <input v-model="form.name" type="text" name="landmark-name" id="landmark-name" placeholder="Pomník padlým vojakom v obci Veľký Šariš">
        <label for="landmark-description">
            Opis pamätníka
        </label>
        <textarea v-model="form.description" name="landmark-description" id="landmark-description" rows="10" placeholder="Sem napíšte opis pamätníka..." />
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

                axios.post('/api/post_landmark', this.form).then(() => {
                    this.form.name = '';
                    this.form.description = '';
                    
                    alert('Pamätník bol úspešne pridaný na posúdenie!')
                }).catch((error) => {
                    this.$emit('landmarkErrors', error.response.data.errors);
                })
            }
        }
    }

</script>