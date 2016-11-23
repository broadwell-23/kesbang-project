<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kecamatan')->unique()->unsigned();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans')->onUpdate('cascade')->ondelete('cascade');
            $table->string('nama');
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
        Schema::dropIfExists('todat');
    }
}
