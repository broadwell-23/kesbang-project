<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PengurusForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urus_forums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_forum')->unique()->unsigned();
            $table->foreign('id_forum')->references('id')->on('forums')->onUpdate('cascade')->ondelete('cascade');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto');
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
        Schema::dropIfExists('urus_forums');
    }
}
