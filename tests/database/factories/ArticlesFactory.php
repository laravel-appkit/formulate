<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use AppKit\Formulate\Tests\Models\Article;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'category' => $faker->randomElement(['a', 'b', 'c', 'd', 'e']),
        'published' => $faker->boolean,
        'featured' => $faker->randomElement(['yes', 'no']),
    ];
});
