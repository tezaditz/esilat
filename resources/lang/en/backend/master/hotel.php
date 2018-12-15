<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Hotel',

    'hotel' => [
        'index' => [
            'title'    => 'List hotel (:total)',
            'is_empty' => 'Tidak ada hotel yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Hotel berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Hotel berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Hotel berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'nama_hotel'      => 'Hotel',
        'npwp'            => 'NPWP',
        'nama_bank'       => 'Bank',
        'no_rekening'     => 'Rekening',
        'ktp'             => 'KTP Pimpinan',
        'nama_perusahaan' => 'Perusahaan',
        'status'          => 'Status',
        'active'          => 'Active',
        'inactive'        => 'Inactive',
        'not_found'       => 'There are no records.',
        'publish_at'      => 'Publish at',
        'order'           => 'Order',
    ],
];
