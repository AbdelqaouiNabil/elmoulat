<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chequiers', function (Blueprint $table) {
            $table->id();
            $table->date('dateDeMiseEnDisposition');
            $table->integer('numeroDeDebut');
            $table->integer('numeroDeFin');
            $table->integer('nombreDeCheque');
            $table->unsignedBigInteger('id_compte');
            $table->foreign('id_compte')->references('id')->on('comptes'); 
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
        Schema::dropIfExists('chequiers');
    }
}
