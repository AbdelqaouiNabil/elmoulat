<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvriers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('datenais');
            $table->string('cin')->nullable();
            $table->string('n_cin');
            $table->date('datedubet');
            $table->string('observation');
            $table->integer('notation');
            
            
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
        Schema::dropIfExists('ouvriers');
    }
}
