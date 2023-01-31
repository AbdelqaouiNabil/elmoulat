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
            $table->date('date');
        
            $table->float('montant');
            $table->unsignedBigInteger('id_caisse');
            $table->foreign('id_caisse')->references('id')->on('caisses'); 
            $table->unsignedBigInteger('id_reglement');
            $table->foreign('id_reglement')->references('id')->on('reglements'); 
            $table->unsignedBigInteger('id_depense');
            $table->foreign('id_depense')->references('id')->on('depenses'); 
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
