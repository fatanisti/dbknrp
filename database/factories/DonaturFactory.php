<?php

use Faker\Generator as Faker;

$factory->define(App\Donatur::class, function (Faker $faker) {
    return [
        'dona_id' => generateDonaId(),
        'dona_tgl_regis' => now(),
        'dona_nama' => $faker->name,
        'dona_tempat_lahir' => $faker->city,
        'dona_tgl_lahir' => $faker->dateTimeThisCentury($max = 'now', $timezone = null),
        'dona_alamat' => $faker->streetAddress,
        'dona_rt' => $faker->randomDigitNotNull,
        'dona_rw' => $faker->randomDigitNotNull,
        'dona_kodepos' => $faker->postcode,
        'dona_kota_kab' => $faker->randomElement(['Kab. Bandung', 'Kab. Bekasi', 'Kab. Sumedang', 'Kab. Tasikmalaya', 'Kota Cimahi']),
        'dona_provinsi' => 'Jawa Barat',
        'dona_negara' => 'Indonesia',
        'dona_no_telp' => $faker->phoneNumber,
        'dona_no_hp' => $faker->phoneNumber,
        'dona_email' => $faker->unique()->safeEmail,
        'dona_akun_facebook' => $faker->userName,
        'dona_akun_instagram' => $faker->userName,
        'dona_profesi' => $faker->company,
        'dona_catatan' => $faker->word,
        'fund_id' => $faker->numberBetween($min = 4, $max = 7),
    ];
});

function generateDonaId() {
    $number = mt_rand(10000000, 99999999); // better than rand()

    // call the same function if the barcode exists already
    if (donaIdExists($number)) {
        return generateDonaId();
    }

    // otherwise, it's valid and can be used
    return $number;
}

function donaIdExists($number) {
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
    return App\Donatur::whereDonaId($number)->exists();
}