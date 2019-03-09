<?php

use Faker\Generator as Faker;
use App\Book;
use App\Author;

$factory->define(Book::class, function (Faker $faker) {

    $author = factory(Author::class)->create();

    return [
        'title' => $faker->sentence($nbWords = 6, $variablesNbWords = true),
        'author_id' => $author->id,
    ];
});
