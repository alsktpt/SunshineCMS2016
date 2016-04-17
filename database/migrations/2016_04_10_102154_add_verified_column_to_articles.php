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
            $table->boolean('verified')->default(true);
        });
        Schema::table('anthology_article', function($table) {
            $table->boolean('verified')->default(false);
            $table->integer('verified_user');
            $table->timestamps();
        });
        Schema::table('anthology_user', function($table) {
            $table->boolean('verified')->default(false);
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
        Schema::table('anthology_article', function($table) {
            $table->dropColumn('verified');
            $table->dropColumn('verified_user');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
        Schema::table('anthology_user', function($table) {
            $table->dropColumn('verified');
        }); 
    }
}
