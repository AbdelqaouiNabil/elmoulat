<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('consistance');
            $table->string('titre_finance');
            $table->float('superfice');
            $table->string('adress');
            $table->string('ville');
            $table->string('autorisation');
            $table->date('datedebut');
            $table->date('datefin');
            $table->unsignedBigInteger('id_caisse');
            $table->foreign('id_caisse')->references('id')->on('caisses'); 
            $table->unsignedBigInteger('id_bureau');
            $table->foreign('id_bureau')->references('id')->on('bureaus'); 
         
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
        Schema::dropIfExists('projets');
    }
}
