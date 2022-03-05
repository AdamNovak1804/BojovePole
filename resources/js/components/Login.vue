<template>
    <div>
        <div class="sidenav">
            <div class="login-main-text">
                <h2>Prečo je dobré<br> mať vytvorený účet?</h2>
                <p>Po vytvorení účtu novo registrovaný používateľ získa možnosť pridať vlastný obsah, ako aj komunikovať s ostatnými používateľmi.</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <h1 class="text-center">Prihlásiť sa</h1>
                    <router-link to="/registracia" class="link-center">
                        Nemáte účet?
                    </router-link>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Zadajte prihlasovací Email">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Zadajte heslo">
                        </div>
                        <button type="submit" class="btn btn-login mt-4">Prihlásiť sa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

}

</script>
