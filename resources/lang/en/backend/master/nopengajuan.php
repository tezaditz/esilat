<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/08/2017
 * Time: 07:08 PM
 */
return [
    'module' => 'No Pengajuan',

    'no_pengajuan' => [
        'index' => [
            'title'    => 'List no pengajuan (:total)',
            'is_empty' => 'Tidak ada no pengajuan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'No Pengajuan berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'No Pengajuan berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'No Pengajuan berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'   => 'Dibuat',
        'no_pengajuan' => 'Nomor',
        'jenis'        => 'Jenis',
        'kode'         => 'Kode Transaksi',
        'status'       => 'Status',
        'active'       => 'Active',
        'inactive'     => 'Inactive',
        'not_found'    => 'There are no records.',
        'publish_at'   => 'Publish at',
        'order'        => 'Order',
    ],
];