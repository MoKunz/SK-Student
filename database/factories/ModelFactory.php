<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'api_token' => str_random(60)
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    $name = $faker->sentence;
    $date = $faker->dateTimeThisYear;
    return [
        'user_id' => random_int(1,5),
        'name' => $name,
        'slug' => str_slug($name),
        'content' => $faker->paragraph(random_int(5,50)),
        'created_at' => $date,
        'updated_at' => $date
    ];
});

$factory->define(App\ActivityDayClub::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define(App\ActivityDayVoter::class, function (Faker\Generator $faker) {
    return [
        'student_id' => random_int(52000, 56000),
        'club_id' => random_int(1, 50),
        'grade' => random_int(1, 3),
        'phone_number' => '08' . (string)random_int(11111111, 99999999),
        'ip_address' => $faker->ipv4,
        'user_agent' => $faker->userAgent
    ];
});