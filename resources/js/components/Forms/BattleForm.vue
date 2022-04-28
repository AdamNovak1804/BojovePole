<template>
    <form method="POST" enctype="multipart/form-data" @submit.prevent="submit">
        <label for="title">
            Názov bitky
        </label>
        <input v-model="form.title" type="text" name="title" id="title" placeholder="Bitka pri Zborove">
        <label for="start">
            Dátum začatia bitky
        </label>
        <input v-model="form.start" class="date-input" type="date" name="start" id="start" @change="update_end()">
        <label for="end">
            Dátum konca bitky
        </label>
        <input v-model="form.end" class="date-input" type="date" name="end" id="end">
        <label for="side1">
            Útočník
        </label>
        <select v-model="form.side1" name="side1" id="side1">
            <option value="" disabled>Vybrať útočníka bitky</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
        </select>
        <label for="side2">
            Obranca
        </label>
        <select v-model="form.side2" name="side2" id="side2">
            <option value="" disabled>Vybrať obrancu bitky</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
        </select>
        <label for="outcome">
            Výsledok
        </label>
        <select v-model="form.outcome" name="outcome" id="outcome">
            <option value="" disabled>Vybrať výsledok bitky</option>
            <option v-for="outcome in outcomes" :key="outcome.id" :value="outcome.value">{{ outcome.text }}</option>
        </select>
        <label for="battle-file-upload">
            Priložiť obrázky ako prílohu
        </label>
        <div class="dropbox">
            <input 
                type="file"
                name="battle-file-upload"
                id="battle-file-upload"
                multiple
                @change="uploadFiles($event.target.files)"
            >
            <p>Súbory je možné vložiť do vyznačenej oblasti</p>
        </div>
        <label for="description">
            Opis
        </label>
        <textarea v-model="form.description" name="description" id="description" rows="10" placeholder="Sem napíšte priebeh boja..." />
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
                    title: '',
                    start: '1914-07-28',
                    end: '1914-07-28',
                    side1: '',
                    side2: '',
                    outcome: '',
                    description: '',
                    gallery: ''
                },

                countries: '',

                outcomes: [
                    { id: 1, text: 'Víťazstvo útočníka', value: 'side1_victory' },
                    { id: 2, text: 'Patová situácia', value: 'stalemate' },
                    { id: 3, text: 'Víťazstvo obrancu', value: 'side2_victory' }
                ]
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
                })
            },

            submit: function() {
                var formData = new FormData();

                formData.append('title', this.form.title);
                formData.append('start', this.form.start);
                formData.append('end', this.form.end);
                formData.append('side1', this.form.side1);
                formData.append('side2', this.form.side2);
                formData.append('outcome', this.form.outcome);
                formData.append('description', this.form.description);

                if ( !!this.position ) {
                    formData.append('latlng[0]', this.position.lat);
                    formData.append('latlng[1]', this.position.lng);
                }

                for ( var i = 0; i < this.form.gallery.length; i++ ) {
                    formData.append('gallery[' + i + ']', this.form.gallery[i]);
                }

                axios.post('/api/post_battle', formData, { 
                    headers : {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(() => {
                    this.form.title = '';
                    this.form.start = '1914-07-28';
                    this.form.end = '1914-07-28';
                    this.form.side1 = '';
                    this.form.side2 = '';
                    this.form.outcome = '';
                    this.form.description = '';
                    this.form.gallery = '';

                    alert('Bitka bola úspešne pridaná na posúdenie!')
                }).catch((error) => {
                    this.$emit('battleErrors', error.response.data.errors);
                })
            },

            update_end: function() {
                this.form.end = this.form.start;
            },

            uploadFiles: function(files) {
                this.form.gallery = files;
            }
        }
    }

</script>
