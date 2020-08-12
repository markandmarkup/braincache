<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $visibilityOptions = ['public', 'private'];

    return [
        'title' => $faker->text($maxNbChars = 100),
        'last_edit_date' => now(),
        'no_of_saves' => $faker->numberBetween($min = 0, $max = 9000000),
        'body' => $faker->paragraphs($nb = 3, $asText = true),
        'visibility' => $visibilityOptions[array_rand($visibilityOptions, 1)]
    ];
});
