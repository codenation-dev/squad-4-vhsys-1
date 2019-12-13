<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Exclusion::class, function (Faker $faker) {
    $users = \App\User::pluck('id')->toArray();

    return [
        'value' => "{\"data\":{\"id\":9,\"level\":\"Bug\",\"log\":\"Dolorem aliquid iste nulla consequatur aliquam ex dolore. Non explicabo quidem cupiditate consequatur non hic velit.\",\"events\":70,\"ambience\":\"Homologacao\",\"status\":\"Resolvido\",\"title\":\"Mr.\",\"user_created\":1,\"user_updated\":null,\"deleted_at\":null,\"created_at\":\"2019-12-12 02:38:39\",\"updated_at\":\"2019-12-12 02:38:39\"},\"code\":200}",
        'type' => $faker->randomElement(['User', 'Log']),
        'id_user' => $faker->randomElement($users)
    ];
});
