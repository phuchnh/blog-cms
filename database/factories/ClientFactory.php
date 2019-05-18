<?php

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
$factory->define(\App\Models\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'url' => $faker->imageUrl()
    ];
});
