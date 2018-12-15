<?php

return [
    'module' => 'Pimpinan',

    'pimpinan' => [
        'index' => [
            'title'    => 'List pimpinan',
            'is_empty' => 'Tidak ada pimpinan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'pimpinan berhasil dibuat!',
                'info' => 'Tidak ada pimpinan yg dibuat',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pimpinan berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pimpinan berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at' => 'Dibuat',
        'bagian_id'  => 'Bagian',
        'nip'        => 'NIP',
        'nama'        => 'Nama',
        'jabatan'    => 'Jabatan',
    ],
];