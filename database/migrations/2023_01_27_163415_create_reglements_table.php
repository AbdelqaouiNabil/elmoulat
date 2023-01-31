<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglements', function (Blueprint $table) {
            $table->id();
           
            $table->date('date');
            $table->string('methode');
            $table->float('montant');
            $table->integer('numero_cheque');
            $table->unsignedBigInteger('id_transaction');
            $table->foreign('id_transaction')->references('id')->on('transactions');
            $table->unsignedBigInteger('id_facture');
            $table->foreign('id_facture')->references('id')->on('factures');
            $table->unsignedBigInteger('id_contrat');
            $table->foreign('id_contrat')->references('id')->on('contrats');
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
        Schema::dropIfExists('reglements');
    }
}
