<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bien');
            $table->foreign('id_bien')->references('id')->on('biens');
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('clients');
            $table->date('datedebut');
            $table->date('datefin');
            $table->double('montant');
            $table->double('avance');
            $table->string('contrat_pdf');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('priventes');
    }
};
