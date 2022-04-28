<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('battles', function (Blueprint $table) {
            $table->unsignedBigInteger('side1');
            $table->foreign('side1')->references('id')->on('countries');
            $table->unsignedBigInteger('side2');
            $table->foreign('side2')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('battles', function (Blueprint $table) {
            $table->dropForeign(['side1']);
            $table->dropColumn('side1');
            $table->dropForeign(['side2']);
            $table->dropColumn('side2');
        });
    }
}
