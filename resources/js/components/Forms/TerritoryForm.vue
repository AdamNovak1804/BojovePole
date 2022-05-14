<template>
    <form method="POST" enctype="multipart/form-data" @submit.prevent="submit">
        <label for="start">
            Dátum začatia situácie
        </label>
        <input v-model="form.start_date" class="date-input" type="date" name="start" id="start" @change="update_end()">
        <label for="end">
            Dátum konca situácie
        </label>
        <input v-model="form.end_date" class="date-input" type="date" name="end" id="end">
        <label for="country">
            Územie krajiny
        </label>
        <select v-model="form.country" name="country" id="country">
            <option value="" disabled>Vybrať krajinu</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
        </select>
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
                    start_date: '1914-07-28',
                    end_date: '1914-07-28',
                    country: ''
                },

                countries: ''
            }
        },

        props: {
            polygon: ''
        },

        methods: {
            getCountries: function() {
                axios.get('/api/get_countries').then(response => {
                    this.countries = response.data;
                }).catch((error) => {
                    console.log(error);
                })
            },

            submit: function() {
                var formData = new FormData();

                formData.append('start_date', this.form.start_date);
                formData.append('end_date', this.form.end_date);
                formData.append('country', this.form.country);
                formData.append('color', this.polygon.color);

                if ( this.polygon.vertices ) {
                    for ( var i = 0; i < this.polygon.vertices.length; i++ ) {
                        formData.append('map[' + i + ']', 
                            [ this.polygon.vertices[i].lat, this.polygon.vertices[i].lng ]
                        );
                    }
                }
                else {
                    formData.append('map', '');
                }

                axios.post('/api/post_territory', formData).then(() => {
                    this.form.start_date = '1914-07-28';
                    this.form.end_date = '1914-07-28';
                    this.form.country = '';

                    alert('Frontová línia bola úspešne pridaná na posúdenie!')
                }).catch((error) => {
                    this.$emit('territoryErrors', error.response.data.errors);
                })
            },

            update_end: function() {
                this.form.end_date = this.form.start_date;
            }
        }
    }

</script>
