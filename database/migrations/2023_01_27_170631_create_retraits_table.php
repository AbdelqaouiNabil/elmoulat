<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retraits', function (Blueprint $table) {
            $table->id();
            $table->date('dateRet');

            $table->string('montant');
            $table->string('type_of_sold')->nullable();
            $table->unsignedBigInteger('id_caisse');
            $table->foreign('id_caisse')->references('id')->on('caisses');
            $table->unsignedBigInteger('id_reglement')->nullable();
            $table->foreign('id_reglement')->references('id')->on('reglements');
            $table->unsignedBigInteger('id_depense')->nullable();
            $table->foreign('id_depense')->references('id')->on('depenses');
            $table->unsignedBigInteger('id_facture')->nullable();
            $table->foreign('id_facture')->references('id')->on('factures');
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
        Schema::dropIfExists('retraits');
    }
}
