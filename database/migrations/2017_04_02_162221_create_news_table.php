<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            // id
            $table->increments('id');
            // author
            $table->unsignedInteger('user_id')->nullable();
            // category
            $table->unsignedInteger('category_id')->nullable();
            // headline
            $table->string('name');
            // slug
            $table->string('slug');
            // contents
            $table->mediumText('content');
            // time
            $table->timestamps();
            // foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
