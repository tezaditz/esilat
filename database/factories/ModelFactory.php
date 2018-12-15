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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'username'       => $faker->username,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name'         => 'administrator',
        'display_name' => 'Administrator',
        'description'  => $faker->paragraph(1),
    ];
});

$factory->define(\App\Models\Backend\Master\Hotel::class, function (Faker\Generator $faker) {
    return [
        'nama_hotel'      => $faker->streetName,
        'npwp'            => $faker->swiftBicNumber,
        'nama_bank'       => $faker->creditCardType,
        'no_rekening'     => $faker->swiftBicNumber,
        'ktp'             => $faker->swiftBicNumber,
        'nama_perusahaan' => $faker->company,
    ];
});

$factory->define(\App\Models\Backend\Master\Provinsi::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->state,
    ];
});

$factory->define(\App\Models\Backend\Master\MetodeBayar::class, function (Faker\Generator $faker) {
    return [
        'kode'         => $faker->postcode,
        'metode_bayar' => $faker->state,
    ];
});

$factory->define(\App\Models\Backend\Master\Jabatan::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(\App\Models\Backend\Master\Bagian::class, function (Faker\Generator $faker) {
    return [
        'nama_bagian' => $faker->name,
        'kode'        => $faker->postcode,
    ];
});

$factory->define(\App\Models\Pengajuan\Kegiatan::class, function (Faker\Generator $faker) {
    return [
        'bagian_id'       => $faker->randomElement($array = array('1', '2', '3', '4', '5')),
        'tahun_anggaran'  => '2017',
        'tgl_pengajuan'   => $faker->dateTimeBetween($startDate = '-3 week', $endDate = 'now')->format('Y-m-d'),
        'no_mak'          => $faker->isbn13,
        'nama_kegiatan'   => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'tgl_awal'        => $faker->dateTimeBetween($startDate = '-1 week', $endDate = 'now')->format('Y-m-d'),
        'tgl_akhir'       => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
        'total_realisasi' => $faker->numberBetween($min = 1000000, $max = 99000000),
        'status_id'       => $faker->randomElement($array = array('1', '2', '3', '4', '5')),
    ];
});

$factory->define(\App\Models\Backend\Master\Pangkat::class, function (Faker\Generator $faker) {
    return [
        'pangkat'   => $faker->name,
        'golongan'  => $faker->postcode,
    ];
});

$factory->define(\App\Models\Backend\Master\Status::class, function (Faker\Generator $faker) {
    return [
        'kode_status'      => $faker->swiftBicNumber,
        'keterangan'       => $faker->name,
        'posisi_dokumen'   => $faker->company,
        'modul'            => $faker->postcode,
        'kode_realisasi'   => $faker->swiftBicNumber,
    ];
});

$factory->define(\App\Models\Backend\Master\Jenistransaksi::class, function (Faker\Generator $faker) {
    return [
        'jenis_transaksi'      => $faker->name,
        'tipe'                 => $faker->buildingNumber,
    ];
});

$factory->define(\App\Models\Backend\Master\Eselon::class, function (Faker\Generator $faker) {
    return [
        'title'      => $faker->name,
    ];
});

$factory->define(\App\Models\Backend\Pengajuan\DokumenPerkantoran::class, function (Faker\Generator $faker) {
    return [
        'nama_dokumen'   => $faker->company,
        'ada'            => $faker->randomElement($array = array('1', '2')),
        'perkantoran_id' => '1',
    ];
});