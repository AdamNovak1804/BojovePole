<style scoped>

    .registration-form {
        margin-top: 30%;
    }

</style>

<template>
    <div>
        <div class="main">
            <div class="justify-center">
                <div class="registration-form p-4">
                    <h1 class="text-center">Registrovať sa</h1>
                    <p class="text-center">Položky označené * sú povinné</p>
                    <form method="POST">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="username" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="username" placeholder="Používateľské meno">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="email" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" id="email" placeholder="Prihlasovací Email">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="password" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input type="password" id="password" placeholder="Heslo">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="confirmpassword" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <input type="password" id="confirmpassword" placeholder="Potvrdenie hesla">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2 text-end">
                                    <label for="terms" class="control-label">*</label>
                                </div>
                                <div class="col-8">
                                    <div class="row align-items-center pt-2 pb-2">
                                        <div class="col-2">
                                            <input type="checkbox" id="terms" name="terms" value="accept">
                                        </div>
                                        <div class="col-8">
                                            <label for="terms">Súhlasím s obchodnými podmienkami</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="row align-items-center pt-2 pb-2">
                                        <div class="col-2">
                                            <input type="checkbox" id="subscribe" name="subscribe" value="newsletter">
                                        </div>
                                        <div class="col-8">
                                            <label for="subscribe">Chcem odoberať newsletter</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pb-2">
                                <div class="col-8 offset-2">
                                    <button type="submit" class="btn btn-action">Registrovať sa</button>
                                </div>
                            </div>
                        </div>
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
