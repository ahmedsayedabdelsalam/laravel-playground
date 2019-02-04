<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'is_free' => rand(0, 1),
        'diffeculty' => ['easy', 'medium', 'diffecult'][rand(0, 2)],
        'type' => ['tech', 'science', 'math'][rand(0, 2)],
    ];
});
