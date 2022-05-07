<template>
    <b-row class="mt-3">
        <b-col cols="2">
            <label class="label-form" for="edit-save-button">
                Zmeny sa uložia
            </label>
            <button @click="saveRequest()" name="edit-save-button" id="edit-save-button" class="btn btn-action">Uložiť zmeny</button>
        </b-col>
        <b-col cols="2">
            <label class="label-form" for="edit-delete-button">
                Záznam bude vymazaný
            </label>
            <button @click="deleteRequest()" name="edit-delete-button" id="edit-delete-button" class="btn btn-action">Zamietnuť</button>
        </b-col>
        <b-col cols="4" class="ml-auto">
            <label class="label-form" for="edit-reliability-select">
                Vybrať stupeň dôveryhodnosti informácií
            </label>
            <select class="options-inverted" v-model="selected" name="edit-reliability-select" id="edit-reliability-select">
                <option value="" disabled>Vybrať</option>
                <option 
                    v-for="reliability in reliabilities"
                    :key="reliability.id"
                    v-bind:value="reliability.enum"
                >
                    {{ reliability.text }}
                </option>
            </select>
        </b-col>
        <b-col cols="4" class="ml-auto">
            <label class="label-form" for="edit-submit-button">
                Žiadosť bude zverejnená na mape
            </label>
            <button @click="uploadRequest()" class="btn btn-action" name="edit-submit-button" id="edit-submit-button">Zverejniť</button>
        </b-col>
    </b-row>
</template>

<script>

    export default {
        data() {
            return {
                reliabilities: [
                    { enum: '1', text: '1 - Informácie nebolo možné overiť' },
                    { enum: '2', text: '2 - Väčšinu informácií nebolo možné overiť' },
                    { enum: '3', text: '3 - Dôveryhodnosť informácií je neutrálna' },
                    { enum: '4', text: '4 - Väčšinu informácií je možné overiť'},
                    { enum: '5', text: '5 - Informácie bolo možné overiť' }
                ]
            }
        },

        computed: {
            selected: {
                get() { return '' },
                set(v) { this.$emit('reliabilityChange', v) }
            }
        },

        methods: {
            saveRequest: function() {
                this.$emit('saveRequest');
            },

            deleteRequest: function() {
                this.$emit('deleteRequest');
            },

            uploadRequest: function() {
                this.$emit('uploadRequest');
            }
        }
    }

</script>