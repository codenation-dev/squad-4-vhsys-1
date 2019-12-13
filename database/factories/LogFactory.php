<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Log::class, function (Faker $faker) {
    $users = \App\User::pluck('id')->toArray();

    return [
        'level' => $faker->randomElement(['Error', 'Warning', 'Bug']),
        'log' => $faker->text,
        'events' => $faker->randomNumber(2),
        'ambience' => $faker->randomElement(['Homologação', 'Produção', 'Desenvolvimento']),
        'status' => $faker->randomElement(['Ativo', 'Pendente', 'Resolvido']),
        'title' => $faker->title,
        'user_created' => $faker->randomElement($users)
    ];
});
