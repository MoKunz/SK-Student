<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignMediaNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_news', function (Blueprint $table) {
            $table->foreign('media_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('news_id')
                ->references('id')->on('news')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_news', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'news_id']);
        });
    }
}
