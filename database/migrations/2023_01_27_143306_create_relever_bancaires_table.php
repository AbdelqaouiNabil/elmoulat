<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleverBancairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relever_bancaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compte_id');
            $table->date('date');
            $table->string('operation_ref');
            $table->float('debit');
            $table->float('credit');
            $table->foreign('compte_id')->references('id')->on('comptes');
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
        Schema::dropIfExists('relever_bancaires');
    }
}
