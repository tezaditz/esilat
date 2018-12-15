<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/05/2017
 * Time: 01:16 PM
 */
return [
    'module' => 'RKAKL',

    'rkakl' => [
        'index' => [
            'title'    => 'List rkakl',
            'is_empty' => 'Tidak ada rkakl yg diunggah.',
        ],
        'store' => [
            'messages' => [
                'success' => 'RKAKL berhasil dibuat!',
                'info' => 'Tidak ada RKAKL yg dibuat',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'RKAKL berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'RKAKL berhasil dihapus!',
            ],
        'rpd' => [
            'title'    => 'List rkakl',
            'is_empty' => 'Tidak ada rpk yg diunggah.',
                ],
        ],
    ],

    'tables' => [
        'created_at' => 'Dibuat',
        'kode'       => 'Kode',
        'uraian'     => 'Uraian',
        'vol'        => 'Vol',
        'sat'        => 'Sat',
        'hargasat'   => 'H. Satuan',
        'jumlah'     => 'Jumlah',
        'sdana'      => 'S. Dana',
        'tahun'      => 'Tahun',
        'status'     => 'Status',
        'active'     => 'Active',
        'inactive'   => 'Inactive',
        'not_found'  => 'There are no records.',
        'publish_at' => 'Publish at',
        'order'      => 'Order',
    ],
];