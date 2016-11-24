<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kecamatan')->unsigned();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans')->onUpdate('cascade')->ondelete('cascade');
            $table->string('nama');
            $table->char('jk',1);
            $table->string('tempat');
            $table->date('tl');
            $table->string('kebangsaan');
            $table->string('no_paspor');
            $table->date('masa_paspor');
            $table->string('no_kitas');
            $table->date('masa_kitas');
            $table->string('sponsor');
            $table->longText('keterangan');
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
        Schema::dropIfExists('asings');
    }
}
