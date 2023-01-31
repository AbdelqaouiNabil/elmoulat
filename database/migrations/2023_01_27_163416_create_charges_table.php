<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fournisseur_id');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs'); 
            $table->unsignedBigInteger('projet_id');
            $table->foreign('projet_id')->references('id')->on('projets'); 
            $table->string('name');
            $table->string('type');
            $table->string('bon');
            $table->float('prix_ht');
            $table->float('tva');
            $table->float('QT');
            $table->float('prix_TTC');
            $table->float('MTTTC');
            $table->enum('situation',['payed','notPayed'])->default('notPayed');
           
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
        Schema::dropIfExists('charges');
    }
}
