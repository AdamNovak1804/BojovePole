<template>
    <form method="POST" @submit.prevent="submit">
        <label for="cemetery-name">
            Názov cintorínu
        </label>
        <input v-model="form.name" type="text" name="cemetery-name" id="cemetery-name" placeholder="Vojenský cintorín Veľkrop">
        <label for="cemetery-file-upload">
            Priložiť obrázky ako prílohu
        </label>
        <div class="dropbox">
            <input 
                type="file"
                name="cemetery-file-upload"
                id="cemetery-file-upload"
                multiple
                @change="uploadFiles($event.target.files)"
            >
            <p>Súbory je možné vložiť do vyznačenej oblasti</p>
        </div>
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
                var formData = new FormData();

                formData.append('name', this.form.name);
                formData.append('description', this.form.description);

                if ( !!this.position ) {
                    formData.append('latlng[0]', this.position.lat);
                    formData.append('latlng[1]', this.position.lng);
                }

                for ( var i = 0; i < this.form.gallery.length; i++ ) {
                    formData.append('gallery[' + i + ']', this.form.gallery[i]);
                }

                axios.post('/api/post_cemetery', formData, {
                    headers : {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(() => {
                    this.form.name = '';
                    this.form.description = '';
                    
                    alert('Cintorín bol úspešne pridaný na posúdenie!');
                }).catch((error) => {
                    this.$emit('cemeteryErrors', error.response.data.errors);
                })
            },

            uploadFiles: function(files) {
                this.form.gallery = files;
            }
        }
    }

</script>