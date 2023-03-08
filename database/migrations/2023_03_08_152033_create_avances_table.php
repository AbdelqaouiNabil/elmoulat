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
        Schema::create('avances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('methode');
            $table->double('montant');
            $table->string('numero_cheque')->nullable();
            $table->string('ref_virement')->nullable();
            $table->string('ref_med')->nullable();
            $table->unsignedBigInteger('id_retrait')->nullable(); 
            $table->foreign('id_retrait')->references('id')->on('retraits');
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
        Schema::dropIfExists('avances');
    }
};
