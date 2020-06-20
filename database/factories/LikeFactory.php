<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feature;
use App\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'feature_id' => function() {
            return Feature::inRandomOrder()->first() ?? factory(Feature::class)->create();
        }
    ];
});
