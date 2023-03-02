<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cin_Ouv');
            $table->date('datedebut');
            $table->date('datefin');
            $table->double('montant');
            $table->double('avance');
            $table->unsignedBigInteger('id_ouvrier');
            $table->foreign('id_ouvrier')->references('id')->on('ouvriers');
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->references('id')->on('projets');
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
        Schema::dropIfExists('contrats');
    }
}
