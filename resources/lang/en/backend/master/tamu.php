<?php

return [
    'module' => 'Tamu',

    'tamu' => [
        'index' => [
            'title'    => 'List Tamu (:total)',
            'is_empty' => 'Tidak ada tamu yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'info'    => 'kesalahan terjadi, mungkin tidak ada akun yg dipilih.',
                'success' => 'Tamu berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Tamu berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Tamu berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'    => 'Dibuat',
        'nama'          => 'Nama',
        'nip'           => 'Nip',
        'instansi'      => 'Instansi',
        'jabatan'       => 'Jabatan',
        
    ],
];
