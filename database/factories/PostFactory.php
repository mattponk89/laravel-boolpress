<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $categories = Category::all();
    $users = User::all();
    return [
        'category_id' => $faker->numberBetween(1, $categories->count()),
        'title' => $faker->sentence(4),
        'user_id' => $faker->numberBetween(1, $users->count()),
    ];
});
