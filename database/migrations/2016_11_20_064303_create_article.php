<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('deksripsi');
            $table->longText('SEOtitle');
            $table->longText('SEOdesc');
            $table->string('foto');

            $table->integer('id_categorys')->unsigned();
            $table->unique('id_categorys');
            $table->foreign('id_categorys')
                  ->references('id')
                  ->on('categorys')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('author')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique('author');
            $table->foreign('author')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('posts');
    }
}
