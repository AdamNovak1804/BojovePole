<template>
    <div>
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
        <input type="date" name="date_of_death" id="date_of_death" value="1914-07-28">
        <label for="biography">
            Biografia
        </label>
        <br>
        <textarea name="biography" id="biography" rows="10" placeholder="Sem napíšte biografiu..."></textarea>
        <label for="gallery">
            Pridať fotografie
        </label>
        <div class="dropbox">
            <input type="file" name="gallery" id="gallery" multiple>
            <p>Súbory je možné vložiť do vyznačenej oblasti</p>
        </div>
        <button class="btn btn-action mt-3" type="submit">Pridať</button>
    </div>
</template>

<script>

    export default {

    }

</script>
