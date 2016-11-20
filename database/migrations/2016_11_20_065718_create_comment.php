<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_post')->unsigned();
            $table->unique('id_post');
            $table->foreign('id_post')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_pages')->unsigned();
            $table->unique('id_pages');
            $table->foreign('id_pages')->references('id')->on('pages')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->string('judul');
            $table->longText('deskripsi');
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
        Schema::dropIfExists('comments');
    }
}
