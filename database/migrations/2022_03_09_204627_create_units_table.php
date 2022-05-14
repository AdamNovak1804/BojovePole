<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->enum('reliability', ['0', '1', '2', '3', '4', '5']);
            $table->string('name', 45);
            $table->enum('type', ['a', 'b', 'c', 'd', 'e']);
            $table->string('location', 45)->nullable();
            $table->unsignedBigInteger('country');
            $table->foreign('country')->references('id')->on('countries');
            $table->text('description')->nullable();
            $table->decimal('longtitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->json('gallery')->nullable();
            $table->timestamps();
        });

        DB::table('units')->insert([
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Peší pluk č. 71',
                'type' => 'a',
                'location' => 'Trenčín',
                'country' => 1,
                'description' => 'Na haličskom úseku východného frontu bol 71. peší pluk bol zaradený do zostavy 27. pešej brigády 14. pešej divízie V. zboru a začlenený do operačnej zostavy rakúsko-uhorskej 1. armády. Do bojovej činnosti zasiahol pluk prvýkrát 23. aug. 1914 v rámci rakúsko-uhorskej ofenzívy, ktorej cieľom bolo prekvapiť ešte nie celkom sústredené ruské vojská. Koncom augusta 1914 pluk bojoval pri Polichne, Krasniku, Rudniku a Ľubline, pričom stratil asi polovicu mužstva a viac ako polovicu veliteľského zboru. Musel byť stiahnutý z prvého sledu armády a doplnený prvými pochodovými prápormi ( tzv. maršbataliónmi ). Na jeseň 1914 sa pluk zúčastnil ústupových bojov za rieku San, v zime 1914 – 1915 ťažkých bojov proti ruskej armáde v Karpatoch. Koncom januára 1915 bol pluk stiahnutý za frontovú líniu na odpočinok a doplnenie. Od jari 1915 do októbra 1916 viedol pluk vyčerpávajúce pohyblivé i zákopové boje v Haliči, za ktoré mu tri razy udelená najvyššia pochvala od hlavného veliteľa, arcikniežaťa Fridricha.',
                'longtitude' => 18.0522571317391,
                'latitude' => 48.8937865,
                'gallery' => '{"images": [{"path": "71-pesi-pluk-0.jpg"}, {"path": "71-pesi-pluk-1.jpg"}, {"path": "71-pesi-pluk-2.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Peší pluk č. 67',
                'type' => 'a',
                'location' => 'Prešov',
                'country' => 1,
                'description' => 'V názve spomínaný 67. peší pluk, zvaný tiež prešovský, mal štáb vo Viedni, obvodné doplňovacie veliteľstvo v Prešove a jeho 4. prápor bol dislokovaný v Prešove. Tento pluk podliehal 54. pešej brigáde v Prešove a 27. pešej divízii v Košiciach. 67. peší pluk bol doplňovaný mužmi z územia Šarišskej, Spišskej a Liptovskej župy. 27. pešia divízia, ktorej 67. peší pluk podliehal takmer celú prvú svetovú vojnu, bojovala na východnom fronte a až v marci 1918 bola divízia prevelená na taliansky front.

                Z matriky 67. pluku vyplýva, že pluk sa zúčastnil intenzívnych bojov od konca februára 1915, čo sa kryje so začiatkom ofenzívy druhej nemeckej armády. Prakticky celý marec 1915 zomierali vojaci 67. prešovského pluku v okolí obce Wola Michowa (gmina Komancza, okres Sanok). V matrike 67. pluku sa spomínajú ešte obce Sedlo, Žebrak a kota Maguryczne. V týchto miestach pluk krvácal do polovice marca. V druhej polovici marca 1915 začala ruská protiofenzíva, na ktorú doplatil prešovský pluk brániaci kótu 906, východne od obce Mikow. Najtvrdšie útoky tu pluk odrážal 21.až 22. marca 1915. Z celého pluku po týchto bojoch ostalo asi 300 mužov.',
                'longtitude' => 21.2204013,
                'latitude' => 49.0048035,
                'gallery' => '{"images": [{"path": "67-pesi-pluk-0.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 3,
                'name' => 'Peší pluk č. 12',
                'type' => 'a',
                'location' => 'Komárno',
                'country' => 1,
                'description' => 'Vojenský útvar sa zúčastnil bojov v Halíčskej fronte ako súčasť 66. pešej brigády 33 pešej divízie 5. armádneho zboru.',
                'longtitude' => 18.1265208,
                'latitude' => 47.7565657,
                'gallery' => '{"images": [{"path": "12-pesi-pluk-0.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 3,
                'name' => 'Honvédsky peší pluk č. 14',
                'type' => 'b',
                'location' => 'Nitra',
                'country' => 1,
                'description' => 'Zložený bol z 85 percent zo slovenských vojakov. Služobným jazykom v honvédskych plukoch bola maďarčina. Na front bol vypravený po trase Levice - Nitra z jeho domovských dislokácií a železnicou cez Leopoldov - Žilinu - Tarnow do Lancutu. Ohňovým vojnovým krstom prešiel už 24. augusta 1914 ako súčasť 37. divízie čeliac ruskej ofenzíve pri Andrzejowe. 14. honvédsky pluk, si získal prívlastok elitnej jednotky. Začiatkom septembra so striedavými úspechmi bojuje v priestore Tarnawka - Olszanka odkiaľ koncom mesiaca ustupuje k ústiu rieky Nida.
                Prvý februárový týždeň sa ocitá na južnom brehu rieky San medzi Ruskiem a Zatwarnicou. Postupne sa prebíjal na sever. Z ruského frontu bol stiahnutý začiatkom mája. Po preskupení a doplnení sa po trase Nyíregyházu-Budapešť-Bratislavu-Gänsendorf-Přerov-Krakov-Tarnow na Czarnu dostal späť na front. V júni 1915 veľký počet vojakov padol počas bojov pluku, pre vyčerpanosť a zblúdenie do zajatia. 
           
           
           
                 V lete 1916 čelí pluk ofenzíve ruských vojsk ešte pred začiatkom Brusilovovej ofenzívy. 28. júla podnikajú Rusi silný útok na pozície pluku, pričom väčšina II. a III. práporu padla do zajatia. 8.-11. septembra je pluk nahradený. Nasleduje  pochod na Vojmice a odtiaľ na Wladimir Wolynski a jedenásteho  nastupujú na vlak  aby vyplnili medzeru na východnom fronte vzniknutú vstupom Rumunska do vojny. Po trase Wladimir Wolynski-Jaroslau-Sátoaljaújhely-Čop-Carei, sú vyložení v Deji 14. septembra a peším pochodom smerujú na Osorhel. Po týždennom pochode sa dostali na líniu frontu Ideciu de Jos - Sattelberg kóta 756 - Mocsáros. V Rumunsku bojuje pluk až do augusta 1918.
                 V druhej polovici augusta 1918 je prevelený na taliansky front cez Brašov-Simeria-Arad-Szeged-Szabadka-Baja-Dombóvár-Kaposvár-Gyékényes-Laibach-Udine do Pordenone, tam je vyložený a peším pochodom sa dostáva  do Mansue. Tu absolvuje výcvik pre potreby nového frontu. Avšak už v polovici septembra nastupuje na železničnú prepravu po trase  Casarsa-Gemona-Pontafel-Rosenheim-Ulm a/d Donau-Bietigheim-Erstein, tam bol vyložený  a peším pochodom pokračuje na Westhausen a Kerzfeld, Uttenheim, kde prebehol výcvik podľa plánov.
                 Pluk je premiestnený na Heiligenstein-Goxweiler a Walf, kde pokračuje výcvik a vybavovanie zvláštnym vojenským výstrojom. Prvý novembrový týždeň nasleduje pochod na Dambach-Blienschweiler-Epfig-Andlau-Bernhartsweiler-Reisfeld-St. Moritz-Hochwart-St. Peterholz-Thannweiler; tam stavia zadné línie pre Nemcov.
           
           
           
                 V deň vyhlásenia prímeria jedenásteho novembra prebehla v pluku menšia rebélia v Dambachu. Už dvanásteho začínajjú vojaci nitranského honvédskeho pluku peší pochod smerom domov cez Hochdorf-Unter Jesingen-Eningen-Lonzingen-Schelkingen-Ulm. Na tento pochod spomínal aj môj starý otec. Veliteľom jeho čaty bol neskôr známy bratislavský mäsiar Manderla a ten sa rozhodol, že ak už prežili vojnu nemali by sa dať zabiť v preplnených vlakoch v bežných železničných nešťastiach. Manderlova jednotka prešla pozdĺž Dunaja do Nitry takmer tisíc kilometrov. Ostatok pluku sa od 24 novembra prepravil železnicou z Ulmu cez Mníchov-Salzburg-Viedeň-Bratislavu do Nitry, tam prebehla 28. demobilizácia a  mužstvo sa rozišlo  do nového štátu - Československej republiky.',
                'longtitude' => 18.091043,
                'latitude' => 48.3227003,
                'gallery' => '{"images": [{"path": "14-honved-pesi-pluk-0.jpg"}, {"path": "14-honved-pesi-pluk-1.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
