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
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project');
            $table->foreign('id_project')->references('id')->on('projets');
            $table->string('type');
            $table->string('situation')->default('disponible');
            $table->string('image','500')->nullable();
            $table->string('etage');
            $table->integer('numero');
            $table->double('prix');
            $table->double('espace');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('biens');
    }
};
