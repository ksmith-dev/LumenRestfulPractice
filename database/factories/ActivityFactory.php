<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Activity;

$factory->define(Activity::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'code' => $faker->languageCode,
        'icon' => $faker->url,
        'description' => $faker->text('200')
    ];
});