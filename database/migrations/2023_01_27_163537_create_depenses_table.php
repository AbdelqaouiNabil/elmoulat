<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project');
            $table->foreign('id_project')->references('id')->on('projets');
            $table->unsignedBigInteger('id_ouvrier')->nullable();
            $table->foreign('id_ouvrier')->references('id')->on('ouvriers');
            $table->unsignedBigInteger('id_facture')->nullable();
            $table->foreign('id_facture')->references('id')->on('factures');
            $table->date('dateDep');
            $table->string('description')->nullable();
            $table->string('situation');
            $table->string('type_depense');
            $table->string('methode');
            $table->string('numero_cheque')->nullable();
            $table->string('ref_verement')->nullable();
            $table->double('montant');
        
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
        Schema::dropIfExists('depenses');
    }
}
