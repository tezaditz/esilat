<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:23 AM
 */
return [
    'module' => 'Nominatif',

    'submodule' => [
        'nominatif' => 'Nominatif',
    ],

    'nominatif' => [
        'index' => [
            'title'    => 'List nominatif',
            'is_empty' => 'Tidak ada Nominatif yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Nominatif berhasil dibuat!',
                'info'    => 'Terjadi kesalahan.',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Nominatif berhasil dihapus!',
            ],
        ],
        'destroyPerjadin' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Semua data Nominatif perjadi berhasil dihapus!',
            ],
        ],
        'destroyFdpesertapusat' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Semua data Nominatif Full day Peserta Pusat berhasil dihapus!',
            ],
        ],
        'destroyFdpesertalocal' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Semua data Nominatif Full day Peserta Local berhasil dihapus!',
            ],
        ],
        'destroyFbpesertapusat' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Semua data Nominatif Full board Peserta pusat berhasil dihapus!',
            ],
        ],
        'destroyFbpesertadaerah' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Semua data Nominatif Full board Peserta daerah berhasil dihapus!',
            ],
        ],
        'nav' => [
            'perjadin'  => 'Perjadin',
            'fullday'   => 'Fullday / RDK',
            'fullboard' => 'Full Board',
        ],
        'tables' => [
            'created_at'    => 'Dibuat',
            'nama_peserta'  => 'Nama Peserta',
            'nip'           => 'Nip',
            'gol'           => 'Gol',
            'instansi'      => 'Instansi',
            'tgl_berangkat' => 'Tgl. berangkat',
            'uang_harian'   => 'Uang harian',
            'tiket_pesawat' => 'TIket pesawat',
            'transport'     => 'Transport',
            'penginapan'    => 'Penginapan',
        ],
    ],
];