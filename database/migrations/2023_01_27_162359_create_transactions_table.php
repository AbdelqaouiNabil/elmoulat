<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cheque');
            $table->unsignedBigInteger('id_releverbancaire');
            $table->date('date_Operation');
            $table->date('date_Valeur');
            $table->string('typePayment');
            $table->string('libelle');
            // $table->float('situation');
            $table->float('credit')->nullable();
            $table->float('debit')->nullable();
            $table->foreign('id_cheque')->references('id')->on('cheques');
            $table->foreign('id_releverbancaire')->references('id')->on('relever_bancaires');
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
        Schema::dropIfExists('transactions');
    }
}
