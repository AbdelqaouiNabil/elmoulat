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
            $table->date('date');
            $table->string('type');
            $table->float('setiation');
            $table->float('credit');
            $table->float('debit');
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
