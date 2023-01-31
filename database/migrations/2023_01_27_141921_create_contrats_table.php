<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('datedubet');
            $table->date('datefin');
            $table->float('montant');
            $table->float('avance');
            $table->unsignedBigInteger('id_ouvrier');
            $table->foreign('id_ouvrier')->references('id')->on('ouvriers'); 
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
        Schema::dropIfExists('contrats');
    }
}
