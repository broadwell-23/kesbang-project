<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavbar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('link');
            $table->integer('id_category')->unsigned();
            $table->unique('id_category');
            $table->foreign('id_category')->references('id')->on('categorys')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_pages')->unsigned();
            $table->unique('id_pages');
            $table->foreign('id_pages')->references('id')->on('pages')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('navbars');
    }
}
