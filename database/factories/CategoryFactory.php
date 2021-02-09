<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->sentence(2);
    $slug = Str::of($title)->slug('-');
    return [
        'title' => $title,
        'slug' => $slug,
    ];
});
