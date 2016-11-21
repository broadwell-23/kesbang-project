<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postCategorys', function (Blueprint $table) {
            $table->integer('id_categorys')->unsigned();
            $table->foreign('id_categorys')
                  ->references('id')
                  ->on('categorys')
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
        Schema::dropIfExists('postCategorys');
    }
}
