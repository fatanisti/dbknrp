<?php

use Faker\Generator as Faker;

$factory->define(App\Riwayat::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'tanggal' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'jml' => $faker->randomNumber,
        'jenis' => $faker->randomElement(['Cash', 'Transfer']),
        'bank' => $faker->randomElement(['BNI', 'BCA', 'Mandiri', 'CIMB Syariah', 'BRI']),
        'dona_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});