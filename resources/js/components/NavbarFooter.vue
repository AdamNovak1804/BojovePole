<style scoped>

    input[type=email], input[type=email]:focus {
        background-color: #507B58;
    }

    ::placeholder
    {
        color: #EDE0A6;
    }

</style>

<template>
    <footer>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-6 col-lg-2 text-center text-lg-start">
                    <h3 class="mb-4 mt-4">Ponuka</h3>
                    <p>
                        <router-link to="/uvod" class="text-decoration-none footer-link">
                            Úvod
                        </router-link>
                    </p>
                    <p>
                        <router-link to="/mapa" class="text-decoration-none footer-link">
                            Mapa
                        </router-link>
                    </p>
                    <p>
                        <router-link to="/data" class="text-decoration-none footer-link">
                            Dáta
                        </router-link>
                    </p>
                    <p>
                        <router-link to="/ucet" class="text-decoration-none footer-link">
                            Účet
                        </router-link>
                    </p>
                </div>
                <div class="col-6 col-lg-2 text-center text-lg-start">
                    <h3 class="mb-4 mt-4">Informácie</h3>
                    <p><a href="#" class="text-decoration-none footer-link">O nás</a></p>
                    <p><a href="#" class="text-decoration-none footer-link">Kontaktné údaje</a></p>
                    <p><a href="#" class="text-decoration-none footer-link">Podmienky používania</a></p>
                    <p><a href="#" class="text-decoration-none footer-link">Zásady ochrany osobných údajov</a></p>
                </div>
                <div class="col-12 col-lg-4 text-center">
                    <h3 class="mb-4 mt-4">Sociálne siete</h3>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="m-2">
                            <img :src="require('../../../public/img/facebook.png').default" width="50px" height="50px" alt="Facebook Logo">
                        </a>
                        <a href="#" class="m-2">
                            <img :src="require('../../../public/img/twitter.png').default" width="50px" height="50px" alt="Twitter Logo">
                        </a>
                        <a href="#" class="m-2">
                            <img :src="require('../../../public/img/reddit.png').default" width="50px" height="50px" alt="Reddit Logo">
                        </a>
                    </div>
                </div>
                <div class="col-sm">
                    <h3 class="mb-4 mt-4 text-center">Odoberať newsletter</h3>
                    <form>
                        <div class="col-6 offset-3">
                            <label for="email-input">E-mailová adresa</label>
                            <input type="email" id="email-input" placeholder="Zadajte E-mail">
                            <button type="submit" class="btn btn-action mt-2">Prihlásiť sa na odber</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <p class="text-center footer-copyright mb-4">© 2021 Adam Novák</p>
            </div>
        </div>
    </footer>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.')
        }
    }

</script>
