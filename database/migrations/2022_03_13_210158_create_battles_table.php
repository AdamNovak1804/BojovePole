<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battles', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->enum('reliability', ['0', '1', '2', '3', '4', '5']);
            $table->string('title', 45);
            $table->date('start');
            $table->date('end');
            $table->unsignedBigInteger('side1');
            $table->foreign('side1')->references('id')->on('countries');
            $table->unsignedBigInteger('side2');
            $table->foreign('side2')->references('id')->on('countries');
            $table->enum('outcome', ['side1_victory', 'stalemate', 'side2_victory']);
            $table->text('description')->nullable();
            $table->decimal('longtitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->json('gallery')->nullable();
            $table->timestamps();
        });

        DB::table('battles')->insert([
            [
                'visible' => 1,
                'reliability' => 5,
                'title' => 'Ruská ofenzíva v Duklianskom priesmyku',
                'start' => '1915-01-27',
                'end' => '1915-02-01',
                'side1' => 2,
                'side2' => 1,
                'outcome' => 'side1_victory',
                'description' => 'Z postavení okolo Duklianskeho priesmyku vyrazili do útoku jednotky ruského XII. armádneho zboru generálporučíka L.V.Leša. V priebehu 28. – 29. januára 1915 prekonali rakúsko-uhorskú obranu a prenikli na južnú stranu Karpát. Svoj hlavný úder smerovali popri hlavnej ceste na Svidník a podporné údery viedli aj po vedľajších komunikáciách. Jeden z týchto ruských podporných úderov bol vedený z Bodružale cez Miroľu a Pstrinú na Staškovce a Makovce. Rakúsko-uhorské velenie do tohto priestoru vyslalo svoju mobilnú zálohu, ktorou bol 7. husársky pluk. (Husarenregiment Wilhelm II. Deutscher Kaiser und König von Preussen Nr.7. Doplňovací obvod – Budapešť a okolie. Národnostné zloženie pluku v roku 1914: 98% Maďari, 2% ostatné národnosti monarchie. Na prelome januára a februára 1915 bol 7. husársky pluk 1. jazdeckej divízie podriadený VII. armádnemu zboru 3. armády).',
                'longtitude' => 21.6318883,
                'latitude' => 49.3360395,
                'gallery' => '{"images": [{"path": "bitka-dukliansky-priesmyk-0.jpg"}]}',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'visible' => 1,
                'reliability' => 4,
                'title' => 'Rakúsko-Uhorský útok v Karpatoch',
                'start' => '1915-01-23',
                'end' => '1915-01-27',
                'side1' => 1,
                'side2' => 2,
                'outcome' => 'stalemate',
                'description' => 'Tento útok mal za účel vytlačiť ruské jednotky z územia severných Karpát, ktoré ruské vojská obsadili v Novembri roku 1914. 23. januára 1915 prešli do útoku rakúsko-uhorské vojská, ktoré sa pokúšali v ťažkých bojoch a za zložitých klimatických podmienok karpatskej zimy prelomiť ruskú obranu v Duklianskom priesmyku. Jednotky VII. armádneho zboru generál jazdectva Arcikniežaťa Jozefa von Habsburg však nezaznamenali úspech a už 27. januára 1915 museli čeliť ruskej ofenzíve.',
                'longtitude' => 21.5932613,
                'latitude' => 49.3196885,
                'gallery' => null,
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
        Schema::dropIfExists('battles');
    }
}
