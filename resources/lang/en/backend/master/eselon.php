<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Eselon',

    'eselon' => [
        'index' => [
            'title'    => 'List eselon (:total)',
            'is_empty' => 'Tidak ada eselon yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Eselon berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Eselon berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Eeselon berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'title'      => 'Title',
        'kode' => 'kode_satker',
        'nama' => 'nama_satker',
        'nama_singkat' => 'nama_singkat',
    ],
];
