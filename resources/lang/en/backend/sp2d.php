<?php

return [
    'module' => 'SPM SP2D',

    'SP2D' => [
        'index' => [
            'title'    => 'List SPM & SP2D',
            'is_empty' => 'Tidak ada SPM dan SP2D yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Detail Kegiatan berhasil di Update!',
                'info'    => 'Tidak ada data data yang di input.'
            ],
        ],
        'tables' => [
            'nomor_sp2d'    => 'Nomor SP2D',
            'tgl_selesai'   => 'Tgl Selesai SP2D',
            'tgl'           => 'Tgl SP2D',
            'nilai'         => 'Nilai SP2D',
            'nomor_invoice' => 'Nomor Invoice',
            'tgl_invoice'   => 'Tgl Invoice',
            'jenis_spm'     => 'Jenis SPM',
            'jenis_sp2d'    => 'Jenis SP2D',
            'deskripsi'     => 'Deskripsi'
        ],

        'uploads' => [
            'sp2d'          => 'Upload SP2D',
            'spm'           => 'Upload SPM' ,
            'excel_sp2d'    => 'Upload Excel SP2D',
            'excel_spm'     => 'Upload Excel SPM',
        ],
    ],
];