<?php

use Faker\Generator as Faker;

$factory->define(App\Riwayat::class, function (Faker $faker) {
    return [
        'riwa_id' => uniqid(),
        'riwa_tanggal' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'riwa_jml' => $faker->randomNumber,
        'riwa_jenis' => $faker->randomElement(['Cash', 'Transfer']),
        'riwa_bank' => $faker->randomElement(['BNI', 'BCA', 'Mandiri', 'CIMB Syariah', 'BRI']),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});