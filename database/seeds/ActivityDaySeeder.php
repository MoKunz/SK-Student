<?php

use Illuminate\Database\Seeder;

class ActivityDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ActivityDayClub::class, 50)->create();
        factory(App\ActivityDayVoter::class, 100)->create();
    }
}
