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

            $table->date('dateR');
            $table->string('methode');
            $table->double('montant');
            $table->string('numero_cheque')->nullable();
            $table->integer('ref_virement')->nullable();
            $table->integer('ref_mad')->nullable();
            $table->unsignedBigInteger('id_contrat')->nullable();
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
