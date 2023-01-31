<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bureau_id');
            $table->foreign('bureau_id')->references('id')->on('Bureaus'); 
            $table->string('nom');
            $table->string('prenom');
            $table->integer('phone');
            $table->date('datedubet');
            $table->string('contrat');
            $table->string('designiation');
            $table->float('salaire');
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
        Schema::dropIfExists('employes');
    }
}
