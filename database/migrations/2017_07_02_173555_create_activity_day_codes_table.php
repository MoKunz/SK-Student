<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityDayCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_day_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voter_id');
            $table->string('reference');
            $table->string('otp');
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
        Schema::dropIfExists('activity_day_codes');
    }
}
