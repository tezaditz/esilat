<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 02:53 PM
 */
return [
    'module' => 'Kabupaten & Kota',

    'kabkota' => [
        'index' => [
            'title'    => 'List Kabupaten & Kota (:total)',
            'is_empty' => 'Tidak ada Kabupaten & Kota yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Kabupaten / Kota berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Kabupaten / Kota berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Kabupaten / Kota berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'provinsi_id'     => 'Provinsi',
        'nama_kab'        => 'Nama Kabupaten / Kota',
    ],
];