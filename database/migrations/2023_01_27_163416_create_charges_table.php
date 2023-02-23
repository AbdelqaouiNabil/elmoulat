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
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->references('id')->on('projets');
            $table->unsignedBigInteger('id_reglement')->nullable();
            $table->foreign('id_reglement')->references('id')->on('reglements');
            $table->string('name');
            $table->string('type');
            $table->string('bon');
            $table->double('prix_ht');
            $table->float('tva');
            $table->double('QT');
            $table->double('prix_TTC');
            $table->double('MTTTC');
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
