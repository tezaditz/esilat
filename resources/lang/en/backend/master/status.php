<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Status',

    'status' => [
        'index' => [
            'title'    => 'List status (:total)',
            'is_empty' => 'Tidak ada status yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Status berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Status berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Status berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'            => 'Dibuat',
        'kode_status'           => 'Kode status',
        'keterangan'            => 'Keterangan',
        'posisi_dokumen'        => 'Posisi dokumen',
        'modul'                 => 'Modul',
        'kode_realisasi'        => 'Kode realisasi',
    ],
];
