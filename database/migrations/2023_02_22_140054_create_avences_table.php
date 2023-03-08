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
        Schema::create('avences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client')->nullable(); 
            $table->foreign('id_client')->references('id')->on('clients');
            $table->unsignedBigInteger('id_vente')->nullable(); 
            $table->foreign('id_vente')->references('id')->on('ventes');
            $table->date('dateA');
            $table->string('montant');
            $table->string('type');
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
        Schema::dropIfExists('avences');
    }
};
