<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnthologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anthologies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('creater_id')->index();
            $table->integer('collection_id');
            $table->boolean('protected')->default(false);
            $table->boolean('privated')->default(true);
            $table->timestamps();
        });

        Schema::create('anthology_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('anthology_id')->unsigned()->index();
            $table->foreign('anthology_id')->references('id')->on('anthologies')->onDelete('cascade');
            //
        });

        Schema::create('anthology_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anthology_id')->unsigned()->index();
            $table->foreign('anthology_id')->references('id')->on('anthologies')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anthologies');
        Schema::drop('anthology_article');
        Schema::drop('anthology_user');
    }
}
