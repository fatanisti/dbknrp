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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'username' => $faker->userName,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
        'domisili' => $faker->randomElement(['Kab. Bandung', 'Kab. Bogor', 'Kab. Sumedang', 'Kota Cimahi']),
        'no_hp' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
        'role' => $faker->randomElement(['1','2','3','4']),
        // 'role' => '5',
    ];
});
