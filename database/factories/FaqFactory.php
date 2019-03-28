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
$factory->define(\App\Models\Faq::class, function (Faker $faker) {
    return ['type' => \App\Models\Faq::DEFAULT_TYPE] + factory(\App\Models\Post::class)->raw();
});
