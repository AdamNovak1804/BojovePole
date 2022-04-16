<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameReliablityInCemeteries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            $table->renameColumn('reliablity', 'reliability');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cemeteries', function (Blueprint $table) {
            $table->renameColumn('reliability', 'reliablity');
        });
    }
}
