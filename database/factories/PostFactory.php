<?php

use Illuminate\Support\Str;
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
/**
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define(\App\Models\Post::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title'       => $title,
        'content'     => $faker->text(400),
        'description' => $faker->text(100),
        'slug'        => Str::slug($title),
        'created_by'  => 0,
        'updated_by'  => 0,
    ];
});
