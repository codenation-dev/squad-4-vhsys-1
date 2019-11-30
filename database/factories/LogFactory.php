<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Log::class, function (Faker $faker) {
    return [
        'level' => $faker->randomElement(['error', 'warning', 'debug']),
        'log' => $faker->text,
        'events' => $faker->randomNumber(2),
        'user_created' => $faker->numberBetween(1, 9)
    ];
});
