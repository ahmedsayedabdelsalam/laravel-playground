<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feature;
use Faker\Generator as Faker;

$factory->define(Feature::class, function (Faker $faker) {
    return [
        'type' => $faker->numberBetween(1, 3)
    ];
});
