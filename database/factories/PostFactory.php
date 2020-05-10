<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'userID' => rand(1, 1000),
        'title' => Str::random(7),
        'excerpt' => Str::random(10),
        'content' => Str::random(30),
        'image' => Str::random(5) . '.jpg',
    ];
});
