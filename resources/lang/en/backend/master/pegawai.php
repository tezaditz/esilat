<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 08/31/2017
 * Time: 04:00 PM
 */
return [
    'module' => 'Pegawai',

    'pegawai' => [
        'index' => [
            'title'    => 'List pegawai (:total)',
            'is_empty' => 'Tidak ada pegawai yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'info'    => 'kesalahan terjadi, mungkin tidak ada akun yg dipilih.',
                'success' => 'Pegawai berhasil dibuat!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pegawai berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Pegawai berhasil dihapus!',
            ],
        ],
    ],

    'tables' => [
        'created_at'      => 'Dibuat',
        'pangkat_id'         => 'Pangkat',
        'jabatan_id'        => 'Jabatan',
        'bagian_id'         => 'Bagian',
        'nama'        => 'Nama',
        'nip'         => 'Nip',
        'tgl_lahir'        => 'Tgl lahir',
        'tempat_lahir'         => 'Tempat',
        'alamat'        => 'Alamat',
    ],
];
