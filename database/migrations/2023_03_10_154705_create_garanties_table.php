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
        Schema::create('garanties', function (Blueprint $table) {
            $table->id();
            $table->date('datebebut');
            $table->date('datefin');
            $table->unsignedBigInteger('id_project');
            $table->foreign('id_project')->references('id')->on('projets');
            $table->unsignedBigInteger('id_vente');
            $table->foreign('id_vente')->references('id')->on('ventes');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garanties');
    }
};
