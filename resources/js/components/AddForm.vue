<style scoped>

    .main
    {
        margin-top: 110px;
        min-height: calc(100vh - 110px);
        background-color: #FFF;
    }

    ::v-deep input[type="date"]
    {
        border: 2px solid #540202;
        border-radius: 5px;
        background-color: #EDE0A6;
        padding: 5px;
        width: 100%;
    }

    ::v-deep textarea
    {
        outline: none;
        border: 2px solid #540202;
        border-radius: 5px;
        padding: 10px;
        background-color: #EDE0A6;
        resize: none;
        width: 100%;
    }

    ::v-deep select
    {
        border: 2px solid #540202;
        border-radius: 5px;
        background-color: #EDE0A6;
        padding: 8px 5px 8px 5px;
        width: 100%;
    }

    ::v-deep label
    {
        margin-top: 8px;
        padding: 5px 0px 5px 0px;
    }

    ::v-deep .submit-btn
    {
        width: 100%;
    }

    ::v-deep .dropbox
    {
        outline: 2px dashed #540202;
        outline-offset: -5px;
        background-color: #EDE0A6;
        position: relative;
        cursor: pointer;
    }

    ::v-deep input[type="file"]
    {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        cursor: pointer;
    }

    ::v-deep .dropbox p
    {
        margin: 0;
        text-align: center;
        padding: 30px 5px 30px 5px;
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
                        <div v-if="map === true">
                            <add-map></add-map>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6">
                        <form action="/hello" class="mb-5">
                            <div class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <label for="type">
                                    Pridať nový objekt do mapy
                                </label>
                                <br>
                                <select id="type" v-model="type" @change="onChange($event)">
                                    <option :value="0" disabled>Vybrať zo zoznamu</option>
                                    <option :value="1">Rodinný príslušník</option>
                                    <option :value="2">Bitka</option>
                                    <option :value="3">Cintorín</option>
                                    <option :value="4">Pamiatka</option>
                                    <option :value="5">Frontová línia</option>
                                </select>
                            </div>
                            <div v-if="type === 1" class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <family-member></family-member>
                            </div>
                            <div v-else-if="type === 2" class="form-group col-lg-8 col-md-8 col-12 offset-md-2 offset-lg-2">
                                <battle-form></battle-form>
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
                type: 0,
                map: false,
            }
        },

        methods: {
            onChange(event) {
                this.type = parseInt(event.target.value);
                if (this.type == 1) {
                    this.map = false;
                }
                else {
                    this.map = true;
                }
            }
        },

    }

</script>
