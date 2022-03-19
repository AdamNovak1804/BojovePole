<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('figures', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->enum('reliablity', ['0', '1', '2', '3', '4', '5']);
            $table->string('name', 45);
            $table->enum('sex', ['male', 'female']);
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->enum('type', ['politician', 'army_staff', 'actor', 'artist']);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('figures');
    }
}
