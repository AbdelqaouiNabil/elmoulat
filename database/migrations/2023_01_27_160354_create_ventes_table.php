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
            $table->unsignedBigInteger('project_id');          
            $table->unsignedBigInteger('client_id');    
            $table->string('titre');
            $table->date('dateV');
            $table->string('montant');
            $table->string('montantReal');
            $table->string('reste');
            $table->string('paye')->default('0');
            $table->string('contrat');
            $table->foreign('project_id')->references('id')->on('projets');
            $table->foreign('client_id')->references('id')->on('clients');
            
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
        Schema::dropIfExists('ventes');
    }
}
