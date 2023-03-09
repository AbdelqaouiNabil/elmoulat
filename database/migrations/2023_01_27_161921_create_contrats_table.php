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
            $table->string('titre');
            $table->date('datedebut');
            $table->date('datefin');
            $table->double('montant');
            $table->double('avance')->nullable();
            $table->string('montant_reste');
            $table->string('type_contrat');
            $table->string('name_entreprise')->nullable();
            $table->string('ice_entreprise')->nullable();
            $table->unsignedBigInteger('id_ouvrier')->nullable();
            $table->foreign('id_ouvrier')->references('id')->on('ouvriers');
            $table->unsignedBigInteger('id_fournisseur')->nullable();
            $table->foreign('id_fournisseur')->references('id')->on('fournisseurs');
            $table->unsignedBigInteger('id_projet')->nullable();
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
