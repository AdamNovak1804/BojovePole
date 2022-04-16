<style scoped>

    .family-list
    {
        border-radius: 15px;
        background-color: #EDE0A6;
        padding: 15px;
        width: 100%;
        box-shadow: 0px 2px 3px #999;
    }

</style>

<template>
    <div>
        <div class="family-list">
            <b-card
                v-for="member in family"
                :key="member.id"
                no-body
                img-top
                tag="article"
            >
                <b-card-body>
                    <h4 class="card-title">{{ member.name }}</h4>
                </b-card-body>

                <b-card-body>
                    {{ member.biography }}
                </b-card-body>
            </b-card>
        </div>
        <div class="row">
            <div class="col">
                <button>Zmazať vybrané položky</button>
            </div>
            <div class="col">
                <button>Nový rodinný príslušník</button>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                family: ''
            }
        },

        mounted() {
            this.getFamily();
        },

        methods: {
            getFamily: function() {
                axios.get('/api/get_family').then(response => {
                    console.log(response.data);
                    this.family = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            }
        }
    }

</script>