<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/04/2017
 * Time: 10:24 AM
 */
return [
    'module' => 'Metode Bayar',

    'metode_bayar' => [
        'index' => [
            'title'    => 'List metode bayar (:total)',
            'is_empty' => 'Tidak ada metode bayar yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Metode Bayar berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Metode Bayar berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Metode Bayar berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'   => 'Dibuat',
        'kode'         => 'Kode',
        'metode_bayar' => 'Metode Bayar',
        'status'       => 'Status',
        'active'       => 'Active',
        'inactive'     => 'Inactive',
        'not_found'    => 'There are no records.',
        'publish_at'   => 'Publish at',
        'order'        => 'Order',
    ],
];