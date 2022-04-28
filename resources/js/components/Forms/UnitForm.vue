<template>
    <form method="POST" @submit.prevent="submit">
        <label for="unit-name">
            Názov vojenskej jednotky
        </label>
        <input v-model="form.name" type="text" name="unit-name" id="unit-name" placeholder="14. Honvédsky peší pluk">
        <label for="unit-type">
            Typ vojenskej jednotky
        </label>
        <select v-model="form.type" name="unit-type" id="unit-type">
            <option value="" disabled>Vybrať typ vojenskej jednotky</option>
            <option v-for="type in types" :key="type.id" :value="type.value">{{ type.text }}</option>
        </select>
        <label for="unit-country">
            Krajina pôvodu vojenskej jednotky
        </label>
        <select v-model="form.country" name="unit-country" id="unit-country">
            <option value="" disabled>Vybrať krajinu pôvodu</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
        </select>
        <label for="unit-location">
            Základňa vojenskej jednotky
        </label>
        <input v-model="form.location" type="text" name="unit-location" id="unit-location" placeholder="Nitra">
        <label for="unit-description">
            Opis a história vojenskej jednotky
        </label>
        <textarea v-model="form.description" name="unit-description" id="unit-description" rows="10" placeholder="Sem napíšte opis a históriu vojenskej jednotky..." />
        <button class="btn btn-action mt-3">Pridať</button>
    </form>
</template>

<script>

    export default {
        mounted() {
            this.getCountries();
        },

        data() {
            return {
                form: {
                    name: '',
                    type: '',
                    location: '',
                    country: '',
                    description: '',
                    latlng: '',
                    gallery: ''
                },

                types: [
                    { id: 1, text: 'Peší pluk', value: 'a' },
                    { id: 2, text: 'Honvédsky peší pluk', value: 'b' },
                    { id: 3, text: 'Prápor poľných strelcov', value: 'c' },
                    { id: 4, text: 'Poľný delostrelecký pluk', value: 'd' },
                    { id: 5, text: 'Ťažký poľný delostrelecký pluk', value: 'e' }
                ],

                countries: ''
            }
        },

        props: {
            position: ''
        },

        methods: {
            getCountries: function() {
                axios.get('/api/get_countries').then(response => {
                    this.countries = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },

            submit: function() {
                this.form.latlng = this.position;

                axios.post('/api/post_unit', this.form).then(() => {
                    this.form.name = '';
                    this.form.type = '';
                    this.form.country = '';
                    this.form.location = '';
                    this.form.description = '';
                    this.form.gallery = '';

                    alert('Vojenská jednotka bola úspešne pridaná na posúdenie!')
                }).catch((error) => {
                    this.$emit('unitErrors', error.response.data.errors);
                })
            }
        }
    }

</script>