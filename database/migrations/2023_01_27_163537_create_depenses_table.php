<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->references('id')->on('projets');
            $table->unsignedBigInteger('id_ouvrier')->nullable();
            $table->foreign('id_ouvrier')->references('id')->on('ouvriers');
            $table->date('dateDep');
            $table->string('description')->nullable();
            $table->string('Aqui');
            $table->string('type');
            $table->double('montant');
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
        Schema::dropIfExists('depenses');
    }
}
