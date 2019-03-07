<?php

use Faker\Generator as Faker;
use App\Author;

$factory->define(Author::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'age' => $faker->numberBetween($min = 18, $max = 90),
        'email' => $faker->unique()->safeEmail,
    ];
});
