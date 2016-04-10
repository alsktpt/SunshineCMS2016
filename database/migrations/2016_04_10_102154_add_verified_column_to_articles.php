<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifiedColumnToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('verified')->nullable()->default(true);
        });
        Schema::table('article_anthology', function($table) {
            $table->boolean('verified')->nullable()->default(false);
        });
        Schema::table('activities', function($table) {
            $table->boolean('verified')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('verified');
        });
        Schema::table('article_anthology', function($table) {
            $table->dropColumn('verified');
        });
        Schema::table('activities', function($table) {
            $table->dropColumn('verified');
        });
    }
}
