<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemeteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cemeteries', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->enum('reliability', ['0', '1', '2', '3', '4', '5']);
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->decimal('longtitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->json('gallery')->nullable();
            $table->timestamps();
        });

        DB::table('cemeteries')->insert([
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Cintorín Veľkrop',
                'description' => 'Cintorín mala v medzivojnovom období na starosti žandárska stanica Malá Poľana, neskôr stanica Stropkov. Pozemok pre cintorín daroval bývalý vlastník štátu. Podľa katastrálneho listu by sa na cintoríne malo nachádzať 127 hrobov. Z celkového počtu by malo byť 72 hromadných šácht a 55 jednotlivých hrobov. Tento údaj súhlasí s počtom hrobov na archívnom náčrte. Tento cintorín vznikal postupne po skončení bojov v období prvej svetovej vojny. Je výsledkom niekoľkých etáp exhumovania hrobov z okolia a čistenia bývalého bojiska. Počet pozostatkov je naozaj extrémny. Samotná zložka o cintoríne poskytuje iba zlomky informácii.',
                'longtitude' => 21.6155716,
                'latitude' => 49.226546,
                'gallery' => '{"images": [{"path": "kvh-beskydy-velkrop-0.jpg"}, {"path": "kvh-beskydy-velkrop-1.jpg"}, {"path": "kvh-beskydy-velkrop-2.jpg"}, {"path": "kvh-beskydy-velkrop-3.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Cintorín Chotča',
                'description' => 'Vojnový cintorín sa nachádza v centre obce Chotča  pri štátnej ceste po pravej strane v smere od Stropkova do Medzilaboriec. Tento cintorín patrí medzi architektonicky najzaujímavejšie riešené lokality tohto typu v okrese Stropkov. Cintorín vznikol po vzdialení sa frontu a je výsledkom exhumácií v okolí obce Chotča. Vzhľadom na jeho architektúru je isté, že práce vykonávalo špeciálne pohrebné komando. Podľa nákresu, ktoré vypracovalo spomínané komando, na vojnovom cintoríne bolo pôvodne 30 jednotlivých hrobov a šesť masových hrobov.

                V medzivojnovom období starostlivosť o vojnový cintorín zabezpečovala Žandárska stanica Stropkov. Archívna zložka vypracovaná touto žandárskou stanicou je pomerne chaotická a najmä číselné značenie hrobov je metúce. Podľa evidenčných protokolov je možné po mene identifikovať 29 z 30 obetí pochovaných v jednotlivých hroboch. Tieto jednotlivé hroby sú označené číslami od 1 do 30. V evidenčných listoch je taktiež zachytených všetkých šesť šácht. Tie sú číslované taktiež číslicami od 1 do 6. V masovej šachte č. 1 je pochovaných 29 neznámych rakúsko-uhorských vojakov. V šachte č. 2 je 40 neznámych rakúsko-uhorských vojakov a v šachte č. 3 je 25 neznámych rakúsko-uhorských vojakov.  V šachtách č. 4, 5 a 6 sú pochovaní neznámi ruskí vojaci. V šachte č. 4 je 50 a v  šachte č. 5 je 100 padlých vojakov. Zaujímavé je, že podľa evidenčného listu v šachte č. 6 je iba 5 padlých vojakov.
                
                Dňa 8. júla 1922 po exhumáciách na vojnovom cintoríne pribudli ďalšie dva spoločné hroby a jeden jednotlivý hrob. V jednotlivom hrobe označenom ako č. 31 je pochovaný podporučík Dr. András Polya, ktorý padol 15. februára 1915. V spoločnom hrobe č. 32 sú 4 neznámi vojaci a v hrobe č. 33 je 10 neznámych vojakov. Na vojnovom cintoríne v medzivojnovom období boli pochovaní ešte štyria vojaci, z evidenčných protokolov však nie je jasné či do masových šácht č. 1 a 2, alebo jednotlivých hrobov 1 a 2. Po sčítaní údajov z evidenčných listov, na vojnovom cintoríne je pochovaných 298 padlých vojakov. Katastrálny list uvádza 299 obetí.',
                'longtitude' => 21.6664623,
                'latitude' => 49.2303096,
                'gallery' => '{"images": [{"path": "chotca-0.jpg"}, {"path": "chotca-1.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Cintorín v Majeri',
                'description' => 'Najväčší vojenský cintorín vznikol pri majerskej nemocnici. Začiatky pochovávania sa viažu k roku 1915, pochovávanie trvalo  ešte aj v roku 1918. Podľa zachovanej presnej písomnej dokumentácie (meno vojaka, číslo hrobu, pôvod, deň úmrtia atď.)  sa v cintoríne nachádza 1.380 pochovaných vojakov. Boli to muži z krajín Poľska, Rakúska, Maďarska, Slovenska, Rumunska, Srbska a ďalších zemí.

                V roku 1917 bol postavený jeho hlavný pomník, kedy cintorín existoval už na veľkej ploche s jednotným usporiadaním a oplotením. Pomník navrhol, realizoval a daroval Karol Horn (1883 Kremnica - 1967 Bopfingen, Nemecko), sochár a kamenár, potomok rodu Hornovcov, ktorí svoj kamenársky podnik založili v meste v roku 1796.
                
                Na pomníku sa nachádzal v maďarskom jazyku nasledujúci nápis: „Tento pomník v lete  roku 1917 navrhol, realizoval a daroval barónovi Lajosovi Kürthymu, býv. ministerskému zmocnencovi pre Štátny úrad opatery vojnových invalidov v  Banskej Bystrici Karol Fridrich Horn sochár a kamenár. Na pamiatku hrdinov, ktorí padli vo svetovej vojne zúriacej v rokoch 1914-1918.“',
                'longtitude' => 19.1759103,
                'latitude' => 48.7415473,
                'gallery' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Cintorín v Becherove',
                'description' => 'Na vojnovom cintoríne je v 72 hroboch pochovaných celkom 111 vojakov, z toho 57 hrobov je jednotlivých a zvyšné sú spoločné.

                Väčšina vojakov pochovaných na tomto cintoríne je neznáma. Podľa mena je možné identifikovať 11 rakúsko-uhorských vojakov, väčšinou príslušníkov rakúsko-uhorského 47. pešieho pluku. Známe je tiež meno jedného ruského vojaka. Na ostatných hroboch je možné určiť len štátnu príslušnosť pochovaných vojakov.
                
                Vojnový cintorín bol v roku 2013 rekonštruovaný podľa dobového náčrtu a následne posvätený. Vojnový cintorín je voľne prístupný pre všetkých, ktorí chcú vzdať úctu padlým.',
                'longtitude' => 21.31903,
                'latitude' => 49.4206629,
                'gallery' => '{"images": [{"path": "becherov-cintorin-0.jpg"}, {"path": "becherov-cintorin-1.jpg"}]}',
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
        Schema::dropIfExists('cemeteries');
    }
}
