<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostInfo;
use App\Post;
use Faker\Generator as Faker;

$factory->define(PostInfo::class, function (Faker $faker) {
    $posts = Post::all();
    return [
        'post_id' => $faker->unique()->numberBetween(1, count($posts)),
        'description' => $faker->paragraph(3),
        'slug' => $faker->slug(),
    ];
});
