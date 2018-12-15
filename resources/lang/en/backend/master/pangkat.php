<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Pangkat',

    'pangkat' => [
        'index' => [
            'title'    => 'List pangkat (:total)',
            'is_empty' => 'Tidak ada pangkat yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Pangkat berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pangkat berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pangkat berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'pangkat'         => 'Pangkat',
        'golongan'        => 'Golongan',
    ],
];
