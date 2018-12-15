<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Jabatan',

    'jabatan' => [
        'index' => [
            'title'    => 'List jabatan (:total)',
            'is_empty' => 'Tidak ada jabatan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'jabatan berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'jabatan berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'jabatan berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'name'      => 'Nama',
    ],
];
