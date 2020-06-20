<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Checkout;
use App\User;
use Faker\Generator as Faker;

$factory->define(Checkout::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first() ?? factory(User::class)->create();
        },
        'book_id' => function () {
            return Book::inRandomOrder()->first() ?? factory(Book::class)->create();
        },
        'borrowed_at' => $faker->dateTimeThisYear(),
        'name' => $faker->name
    ];
});
