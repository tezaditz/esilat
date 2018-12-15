<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Pengadaan',

    'pengadaan' => [
        'index' => [
            'title'    => 'List pengadaan (:total)',
            'is_empty' => 'Tidak ada pengadaan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Pengadaan berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pengadaan berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pengadaan berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [

            'rkakl_id'         => 'Rkakl',
            'no_mak_sys'       => 'No mak',
            'uraian'    => 'uraian',
            'vol'     => 'Vol',
            'sat'   => 'Satuan',
            'hargasat'   => 'H. Satuan',
            'jumlah'    => 'Jumlah',
    ],
];
