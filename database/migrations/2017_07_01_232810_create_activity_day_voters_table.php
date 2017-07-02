<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityDayVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_day_voters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->smallInteger('grade')->default(0);
            $table->string('phone_number');
            $table->ipAddress('ip_address');
            $table->text('user_agent');
            $table->unsignedInteger('club_id')->default(null)->nullable();
            $table->foreign('club_id')->references('id')->on('activity_day_clubs');
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
        Schema::dropIfExists('activity_day_voters');
    }
}
