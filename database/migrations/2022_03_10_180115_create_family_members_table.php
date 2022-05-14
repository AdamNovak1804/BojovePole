<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible');
            $table->enum('reliability', ['0', '1', '2', '3', '4', '5']);
            $table->string('name', 45);
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->unsignedBigInteger('cemetery')->nullable();
            $table->foreign('cemetery')->nullable()->references('id')->on('cemeteries')->nullOnDelete();
            $table->unsignedBigInteger('unit')->nullable();
            $table->foreign('unit')->nullable()->references('id')->on('units')->nullOnDelete();
            $table->text('biography')->nullable();
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
        Schema::dropIfExists('family_members');
    }
}
