<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Feature;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => fn () => User::inRandomOrder()->first() ?? factory(User::class)->create(),
        'feature_id' => fn () => Feature::inRandomOrder()->first() ?? factory(Feature::class)->create(),
        'body' => $faker->paragraph()
    ];
});
