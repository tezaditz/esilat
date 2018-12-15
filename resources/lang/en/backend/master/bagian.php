<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Bagian',

    'bagian' => [
        'index' => [
            'title'    => 'List bagian (:total)',
            'is_empty' => 'Tidak ada bagian yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Bagian berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Bagian berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Bagian berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'nama_bagian'     => 'Bagian',
        'kode'            => 'Kode',
    ],
];
