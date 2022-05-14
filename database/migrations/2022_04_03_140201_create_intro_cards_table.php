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
                'heading' => 'Kto vlastne sme?',
                'description' => 'Sme skupina mladých ľudí, ktorých aktívne zaujíma história Slovenska a konkrétne aj historické obdobie prvej svetovej vojny.',
                'slides' => '{"slides": [{"path": "data-country.png"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'O čo nám ide?',
                'description' => 'Snažíme sa zachovať historickú pamäť Slovákov, ktorí sa prvej svetovej vojny zúčastnili, a to najmä s vašou pomocou, prostredníctvom príbehov, ktoré vám vaši starí otcovia rozprávali. Taktiež sa snažíme agregovať všetky zaujímavé informácie o konkrétnych udalostiach, ktoré sa na Slovensku v tomto období udiali, ako napr. bitky.',
                'slides' => '{"slides": [{"path": "generic-unit.png"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Ako sa to všetko vlastne začalo?',
                'description' => '',
                'slides' => '{"slides": [{"path": "generic-unit.png"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Smerom ku konfliktu.',
                'description' => '',
                'slides' => '{"slides": [{"path": "generic-unit.png"}]}',
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
