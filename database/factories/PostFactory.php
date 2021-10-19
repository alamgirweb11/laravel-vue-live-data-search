<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
           'title' => $faker->unique()->sentence,
           'description' => $faker->realText($maxNbChars = 250),
           'image' => $faker->imageUrl($width = 640, $height = 480),
           'status' => rand(0,1),
    ];
});
