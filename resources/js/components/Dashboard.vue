<style scoped>

    .btn-group
    {
        border-radius: 0;
    }

    .nav-btn
    {
        border-radius: 0;
        background-color: darkslategrey;
    }

</style>

<template>
    <div>
        <navbar-header></navbar-header>
        <div class="container" style="margin-top: 110px">
            <h1>Môj účet</h1>
            <div class="row">
                <div class="col-4">
                    <b-button-group vertical class="btn-group">
                        <b-button class="nav-btn">Správy a žiadosti</b-button>
                        <b-button class="nav-btn">Rodinní príslušníci</b-button>
                        <b-button class="nav-btn">Ďalšie nastavenia</b-button>
                    </b-button-group>
                </div>
                <div class="col-8">

                </div>
            </div>
            <button @click.prevent="logOut">Odhlásiť sa</button>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                user: ''
            }
        },

        mounted() {
            axios.get('api/user').then((response) => {
                this.user = response.data
            })
        },

        methods: {
            logOut() {
                axios.post('api/logout').then(() => {
                    this.$router.push({
                        name: 'Login'
                    }).catch((error) => {
                        console.log(error.response)
                    })
                })
            }
        }
    }

</script>
