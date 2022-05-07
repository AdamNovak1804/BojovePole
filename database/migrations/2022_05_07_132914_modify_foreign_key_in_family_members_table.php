<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyForeignKeyInFamilyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->dropForeign(['cemetery']);
            $table->foreign('cemetery')->nullable()->references('id')->on('cemeteries')->nullOnDelete();
            $table->dropForeign(['unit']);
            $table->foreign('unit')->nullable()->references('id')->on('units')->nullOnDelete();
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
            $table->foreign('cemetery')->nullable()->references('id')->on('cemeteries');
            $table->dropForeign(['unit']);
            $table->foreign('unit')->nullable()->references('id')->on('units');
        });
    }
}
