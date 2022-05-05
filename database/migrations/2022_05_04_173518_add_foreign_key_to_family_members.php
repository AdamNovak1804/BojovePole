<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToFamilyMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->unsignedBigInteger('cemetery')->nullable();
            $table->foreign('cemetery')->nullable()->references('id')->on('cemeteries');
            $table->unsignedBigInteger('unit')->nullable();
            $table->foreign('unit')->nullable()->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->dropForeign(['cemetery']);
            $table->dropColumn('cemetery');
            $table->dropForeign(['unit']);
            $table->dropColumn('unit');
        });
    }
}
