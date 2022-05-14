<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landmarks', function (Blueprint $table) {
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

        DB::table('landmarks')->insert([
            [
                'visible' => 1,
                'reliability' => 4,
                'name' => 'Pamätník vo Vysokej pri Morave',
                'description' => 'Pamätník sa nachádza pri rímskokatolíckom kostole sv. Ondreja a bol postavený v roku 1930.',
                'longtitude' => 16.9080608,
                'latitude' => 48.3309571,
                'gallery' => '{"images": [{"path": "vysokaprimorave1.jpg"}, {"path": "vysokaprimorave2.jpg"}, {"path": "vysokaprimorave3.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Monument v Majeri',
                'description' => 'Jednoduchý, centrálny, elementárny objekt v podobe pretiahnutého pravouhlého monumentu je pre okoloidúcich signálom, že miesto má väčší význam, ako by sa na prvý pohľad v heterogénnom, dlhé roky zanedbanom a nevhodnými zásahmi zdevastovanom území zdalo. Nie je to však iba “socha”. Je zrejmé, že v pozadí sú architekti. Pamätník je objektom, miestom do ktorého môžeme vstúpiť. Schodiskom vystúpiť na hornú vyhliadkovú plošinu a z nadhľadu si uvedomiť priestorové a historické súvislosti, ktoré fyzicky zanikli, alebo sú z horizontu pešiaka nevnímateľné. Zároveň obsahuje aj uzatvárateľnú "svätyňu", kde sú bezpečne uchované a chránené najcennejšie zachované fragmenty z pôvodného cintorína. Pri slávnostných príležitostiach je to otvorené pietne miesto pre uloženie vencov a uctenie si pochovaných obetí.',
                'longtitude' => 19.1773697,
                'latitude' => 48.7405221,
                'gallery' => '{"images": [{"path": "majer-monument-0.jpg"}, {"path": "majer-monument-1.jpg"}, {"path": "majer-monument-2.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 5,
                'name' => 'Pamätník v Záhorskej Vsi',
                'description' => 'Pomník padlých v Záhorskej Vsi je z roku 1927. Postavila ho firma Dvořáka z Břeclavi, ktorej signatúra je na podstavci. Na pomníku sa nachádza niekoľko vytesaných nápisov. V čase obnovy pomníka v roku 1946 bola naň pravdepodobne umiestnená aj tabuľa obetí 2. svetovej vojny z obce. Aby mohla byť osadená, bol pomník zvýšený o kubus vo výške novej tabule. Miesto dnešného umiestnenia pomníka nie je pôvodné. Pomník postavili pri kríži v časti Zákostelí, kde stával do roku 1938 starý kostol, ktorý zbúrali. Pomník bol potom premiestnený na exponovanejšie miesto na Hlavnej ulici.',
                'longtitude' => 16.8454228,
                'latitude' => 48.380714,
                'gallery' => '{"images": [{"path": "zahorskaves2.jpg"}, {"path": "zahorskaves1.jpg"}, {"path": "zahorskaves3.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 4,
                'name' => 'Pamätník v Zohore',
                'description' => 'Pomník bol zhotovený v roku 1924.na podnet Jednoty katolíckych žien.
                Po 95 rokoch od jeho postavenia, v roku 2019, sa uskutočnila jeho obnova.
                Pomník postavil pán Ferdinand Dvořák, ktorý sa narodil 14. 7. 1875 vo Viedni. Býval v Starej Břeclavi. Podľa údajov z Almanachu mesta Břeclav z r. 1931, mal kamenársku dieľňu zapísanú na adrese Nádražní 28. Bol aj kamenárskym majstrom.',
                'longtitude' => 16.9796797,
                'latitude' => 48.3132842,
                'gallery' => '{"images": [{"path": "zohor1.jpg"}, {"path": "zohor2.jpg"}]}',
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
        Schema::dropIfExists('landmarks');
    }
}
