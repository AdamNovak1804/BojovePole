<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToBattles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('battles', function (Blueprint $table) {
            $table->date('start');
            $table->date('end');
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
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }
}
