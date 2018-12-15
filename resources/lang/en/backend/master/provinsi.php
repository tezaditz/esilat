<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 02:53 PM
 */
return [
    'module' => 'Provinsi',

    'provinsi' => [
        'index' => [
            'title'    => 'List provinsi (:total)',
            'is_empty' => 'Tidak ada provinsi yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Provinsi berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Provinsi berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Provinsi berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
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