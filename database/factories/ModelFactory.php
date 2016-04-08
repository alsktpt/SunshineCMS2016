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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function ($faker) {
    $users_id = \App\User::lists('id')->toArray();
    return [
        'title' => $faker->sentence(mt_rand(3, 10)),
        'content' => $faker->paragraph,
        'user_id' => $faker->randomElement($users_id);
        'last_user_id' => $faker->randomElement($user_id);
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
    ];
});

$factory->define(App\Activity::class, function ($faker) {
    return [
        'name' => $faker->sentence(mt_rand(3, 10)),
        'address' => $faker->sentence(mt_rand(2, 6)),
        'start_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
    ];
});
