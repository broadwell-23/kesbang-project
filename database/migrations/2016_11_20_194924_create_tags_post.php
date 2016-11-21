<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagsPosts', function (Blueprint $table) {
            $table->integer('id_tags')->unsigned();
            $table->foreign('id_tags')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_posts')->unsigned();
            $table->foreign('id_posts')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tagsPosts');
    }
}
