<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtnis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etnis', function (Blueprint $table) {
            $table->integer('id_kecamatan')->unique()->unsigned();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans')->onUpdate('cascade')->ondelete('cascade');
            $table->integer('melayu');
            $table->integer('jawa');
            $table->integer('cina');
            $table->integer('batak');
            $table->integer('minang');
            $table->integer('nias');
            $table->integer('bugis');
            $table->integer('lainnya');
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
        Schema::dropIfExists('etnis');
    }
}
