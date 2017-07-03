<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityDayPopcornsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_day_popcorns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voter_id');
            $table->foreign('voter_id')->references('id')->on('activity_day_voters');
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
        Schema::dropIfExists('activity_day_popcorns');
    }
}
