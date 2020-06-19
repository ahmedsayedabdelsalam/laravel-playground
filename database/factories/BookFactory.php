<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'author' => $faker->name
    ];
});

$factory->state(Book::class, 'withoutAuthor', function (Faker $faker) {
    return [
        'author' => null
    ];
});
