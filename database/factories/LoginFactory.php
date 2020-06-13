<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Login;
use App\User;
use Faker\Generator as Faker;

$factory->define(Login::class, function (Faker $faker) {
    return [
        'user_id' => fn () => User::inRandomOrder()->first() ?? factory(User::class)->create(),
        'created_at' => $date = $faker->dateTimeThisYear(),
        'updated_at' => $date
    ];
});
