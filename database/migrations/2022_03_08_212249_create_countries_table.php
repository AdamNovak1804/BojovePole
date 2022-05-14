<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->json('gallery')->nullable();
            $table->timestamps();
        });

        DB::table('countries')->insert([
            [
                'name' => 'Rakúsko-Uhorsko',
                'description' => null,
                'gallery' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rusko',
                'description' => null,
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
        Schema::dropIfExists('countries');
    }
}
