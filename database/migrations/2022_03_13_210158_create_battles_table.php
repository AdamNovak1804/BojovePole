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
            $table->string('title', 45);
            $table->enum('outcome', ['side1_victory', 'stalemate', 'side2_victory']);
            $table->text('description')->nullable();
            $table->decimal('longtitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->json('gallery')->nullable();
            $table->timestamps();
        });
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
