<style scoped>

    .card-container
    {
        margin-top: 150px;
        margin-bottom: 40px;
    }

    .card-body
    {
        background-color: #EDE0A6;
    }

    .card-title
    {
        font-weight: 900;
    }

    .card-text
    {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }

</style>

<template>
    <div>
        <navbar-header />
        <div class="container card-container">
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-6">
                    <b-card
                        title="Vojenské útvary"
                        img-src="img/vojenske_utvary.png"
                        img-alt="Vojenská jednotka Rakúsko-Uhorskej armády"
                        img-top
                        tag="article"
                    >
                        <b-card-text>
                            Kompletný zoznam jednotiek, ktoré participovali v bojoch na severovýchode Slovenska počas prvej svetovej vojny.
                        </b-card-text>
                        <b-button @click="goTo('/data/utvary')" class="btn-action mt-2">Zobraziť</b-button>
                    </b-card>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <b-card
                        title="Bitky"
                        img-src="img/medzilaborce.png"
                        img-alt="Poškodená železničná stanica obce Medzilaborce, 1915 | Zdroj: KVH Beskydy"
                        img-top
                        tag="article"
                    >
                        <b-card-text class="card-text">
                            Kompletný zoznam bitiek, ktoré sa udiali počas vojenskej kampane v rokoch 1914 až 1915.
                        </b-card-text>
                        <b-button @click="goTo('/data/boje')" class="btn-action mt-2">Zobraziť</b-button>
                    </b-card>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <b-card
                        title="Cintoríny"
                        img-src="img/cintorin.png"
                        img-alt="Vojnový cintorín z okolia Medzilaboriec tesne po jeho založení | Zdroj: KVH Beskydy"
                        img-top
                        tag="article"
                    >
                        <b-card-text class="card-text">
                            Zoznam cintorínov padlých vojakov v prvej svetovej vojne na území Slovenska.
                        </b-card-text>
                        <b-button @click="goTo('/data/cintoriny')" class="btn-action mt-2">Zobraziť</b-button>
                    </b-card>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <b-card
                        title="Pamiatky"
                        img-src="img/landmarks_background.jpg"
                        img-alt="Pamiatka vojnových obetí prvej svetovej vojny v obci Malacky | Zdroj: Mesto Malacky"
                        img-top
                        tag="article"
                    >
                        <b-card-text class="card-text">
                            Zoznam pamiatok a pomníkov padlých vojakov v prvej svetovej vojne na území Slovenska.
                        </b-card-text>
                        <b-button @click="goTo('/data/pamiatky')" class="btn-action mt-2">Zobraziť</b-button>
                    </b-card>
                </div>
                <div class="col-12 col-lg-4 col-md-6">
                    <b-card
                        title="Krajiny"
                        img-src="img/countries_background.png"
                        img-alt="Príslušníčky 'Ženského bataliónu smrti' ruskej armády, 1917 | Zdroj: Orrin Wightman 1917, kolorizácia Klimbim colorization"
                        img-top
                        tag="article"
                    >
                        <b-card-text class="card-text">
                            Zoznam krajín, ktoré sa účastnili na vojenských operáciách počas prvej svetovej vojny na Slovensku.
                        </b-card-text>
                        <b-button @click="goTo('/data/krajiny')" class="btn-action mt-2">Zobraziť</b-button>
                    </b-card>
                </div>
            </div>
        </div>
        <navbar-footer />
    </div>
</template>

<script>

    export default {
        methods: {
            goTo: function(route) {
                this.$router.push(route);
            }
        }
    }

</script>

