<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeaponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->enum('reliablity', ['0', '1', '2', '3', '4', '5']);
            $table->string('name', 45);
            $table->enum('type', ['rifle', 'pistol', 'machine_gun', 'meele', 'grenade', 'artilley', 'armoured_car', 'tank', 'plane']);
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
        Schema::dropIfExists('weapons');
    }
}
