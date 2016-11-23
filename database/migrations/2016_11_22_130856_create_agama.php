<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agamas', function (Blueprint $table) {
            $table->integer('id_kecamatan')->unique()->unsigned();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans')->onUpdate('cascade')->ondelete('cascade');
            $table->integer('islam');
            $table->integer('katolik');
            $table->integer('kristen');
            $table->integer('hindu');
            $table->integer('budha');
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
        Schema::dropIfExists('agamas');
    }
}
