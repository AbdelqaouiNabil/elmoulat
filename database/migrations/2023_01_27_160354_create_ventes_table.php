<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bien');          
            $table->unsignedBigInteger('id_privente')->nullable();    
            $table->unsignedBigInteger('id_client');    
            $table->string('titre');
            $table->date('dateV');
            $table->string('montant');
            $table->string('montantReal');
            $table->string('reste');
            $table->string('paye')->default('0');
            $table->string('contrat');
            $table->foreign('id_bien')->references('id')->on('biens');
            $table->foreign('id_privente')->references('id')->on('priventes');
            $table->foreign('id_client')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
