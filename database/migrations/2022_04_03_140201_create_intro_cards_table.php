<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intro_cards', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 45);
            $table->text('description');
            $table->json('slides');
            $table->timestamps();
        });

        DB::table('intro_cards')->insert([
            [
                'heading' => 'O čo nám ide?',
                'description' => 'Snažíme sa zachovať historickú pamäť Slovákov, ktorí sa prvej svetovej vojny zúčastnili, a to najmä s vašou pomocou, prostredníctvom príbehov, ktoré vám vaši starí otcovia rozprávali. Taktiež sa snažíme agregovať všetky zaujímavé informácie o konkrétnych udalostiach, ktoré sa na Slovensku v tomto období udiali, ako napr. bitky.',
                'slides' => '{"slides": [{"path": "data-unit.png"}, {"path": "data-cemetery.png"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Ako sa to všetko vlastne začalo?',
                'description' => '28. júna 1914 študent a srbský nacionalista Gavrilo Princip spáchal atentát na rakúskeho arcivojvodu Františka Ferdinanda d‘ Este s jeho ženou Žofiou. Rakúsko-Uhorská monarchia na atentát reagovala vyslaním ultimáta Srbskému kráľovstvu, ktoré by Srbsko zbavilo väčšiny suverenity. Srbsko toto ultimátum odmietlo, čo vyústilo do vyhlásenia vojny Rakúsko-Uhorskom. Toto vyhlásenie vojny viedlo k zreťazenej eskalácii do ktorej sa na strane Srbska postavilo Rusko a Francúzsko a na strane Rakúsko-Uhorska Nemecko.',
                'slides' => '{"slides": [{"path": "intro-card-0.jpg"}, {"path": "intro-card-1.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Smerom ku konfliktu.',
                'description' => 'Pre pochopenie konfliktu, je nutné uvedomiť si geopolitickú situáciu konca 19. storočia v Európe. V tomto čase vrcholila doba Európskeho imperializmu, kde si vedúce mocnosti Európy ako Veľká Británia, Francúzsko, Rusko a Nemecko rozdelili vplyv vo svete a kolonizovali územia mimo Európu.  Nemecku, ktoré bolo priemyselnou veľmocou, sa z koloniálneho „koláča“ ušlo najmenej a pre svoje vlastné imperiálne záujmy potrebovalo rozšíriť svoj vplyv.',
                'slides' => '{"slides": [{"path": "intro-card-2.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Veľká vojna a Slovensko',
                'description' => 'Veľká vojna sa dotkla Slovenska priamo aj nepriamo. Ako súčasť Uhorskej časti Rakúsko-Uhorskej monarchie slúžilo v silách monarchie veľké množstvo Slovákov. Okrem toho samotným územím Slovenska v rokoch 1914 až prvej polovice roka 1915 prechádzala frontová línia, kedy Ruská armáda bojovala proti jednotkám Trojspolku.',
                'slides' => '{"slides": [{"path": "generic-unit.png"}, {"path": "data-battle.png"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Čo ponúkame?',
                'description' => 'Webová stránka ponúka používateľom možnosť prezerať pridané príspevky, ako aj zadávať vlastné žiadosti príspevkov, poprípade priradiť vlastných rodinných príslušníkov k cintorínom alebo vojenský útvarom, v ktorých rodinní príslušníci počas vojny slúžili. Taktiež existuje možnosť komunikovať s historikom, ktorí tieto informácie overuje.',
                'slides' => '{"slides": [{"path": "Implementacia-mapa-stranka.png"}, {"path": "Implementacia-data-stranka.png"}, {"path": "Implementacia-novy-prislusnik-okno.png"}, {"path": "Implementacia-plne-zobrazenie-objektu-okno.png"}]}',
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
        Schema::dropIfExists('intro_cards');
    }
}
