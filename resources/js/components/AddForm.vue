<style scoped>

    .main
    {
        margin-top: 110px;
        min-height: calc(100vh - 110px);
        background-color: #FFF;
    }

    input[type="date"]
    {
        width: 100%;
    }

    textarea
    {
        width: 100%;
    }

    select
    {
        border: 2px solid #540202;
        border-radius: 5px;
        background-color: #EDE0A6;
        padding: 8px 5px 8px 5px;
        margin: 8px 0;
        width: 100%;
    }

    label
    {
        padding: 5px 0px 5px 0px;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6 offset-md-6 offset-lg-6 mt-3 mb-2 text-center">
                        <h2>Pridanie nového objektu</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6">
                        Tu bude mapa
                    </div>
                    <div class="col-12 col-lg-6 col-md-6">
                        <form action="">
                            <div class="form-group col-lg-6 col-md-6 col-12 offset-md-3 offset-lg-3">
                                <label for="type">
                                    Pridať nový objekt do mapy
                                </label>
                                <br>
                                <select id="type" v-model="type" @change="onChange($event)">
                                    <option :value="'0'" disabled>Vybrať zo zoznamu</option>
                                    <option :value="'1'">Rodinný príslušník</option>
                                    <option :value="'2'">Bitka</option>
                                    <option :value="'3'">Cintorín</option>
                                    <option :value="'4'">Pamiatka</option>
                                    <option :value="'5'">Frontová línia</option>
                                </select>
                            </div>
                            <div v-if="type === '1'" class="form-group col-lg-6 col-md-6 col-12 offset-md-3 offset-lg-3">
                                <label for="name">
                                    Meno rodinného príslušníka
                                </label>
                                <br>
                                <input type="text" name="name" id="name" placeholder="Jozef Novák">
                                <label for="date_of_birth">
                                    Dátum narodenia rodinného príslušníka
                                </label>
                                <br>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="1840-01-01">
                                <label for="date_of_birth">
                                    Dátum úmrtia rodinného príslušníka
                                </label>
                                <br>
                                <input type="date" name="date_of_death" id="date_of_death" value="1840-01-01">
                                <label for="biography">
                                    Biografia
                                </label>
                                <br>
                                <textarea name="biography" id="biography" rows="10"></textarea>
                                <label for="gallery">
                                    Pridať fotografie
                                </label>
                                <br>
                                <input type="file" multiple>
                            </div>
                            <div v-else-if="type === '2'" class="form-group col-md-6 col-12">
                                <h1>bitky</h1>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <navbar-footer></navbar-footer>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                type: '0',
            }
        },

        methods: {
            onChange(event) {
                this.type = event.target.value;
            }
        }

    }

</script>
