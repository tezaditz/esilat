<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:23 AM
 */
return [
    'module' => 'Perkantoran',

    'submodule' => [
        'perkantoran' => 'Layanan Perkantoran',
        'draft_perkantoran' => 'Draft Layanan Perkantoran',
        'detail_pengajuan' => 'Detail Pengajuan',
        'dok_kelengkapan' => 'Dokumen Kelengkapan',
    ],

    'perkantoran' => [
        'index' => [
            'title'    => 'List Layanan Perkantoran (:total)',
            'is_empty' => 'Tidak ada Layanan Perkantoran yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Layanan Perkantoran berhasil dibuat!',
            ],
        ],
        'sent' => [
            'messages' => [
                'success' => 'Layanan Perkantoran berhasil dikirim!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada layanan perkantoran yg dihapus.',
                'success' => 'Layanan perkantoran berhasil dihapus!',
            ],
        ],
        'selesai' => [
            'messages' => [
                'success' => 'Pertanggungjawaban Layanan Perkantoran Selesai!',
            ],
        ],
        'tables' => [
            'created_at'      => 'Dibuat',
            'no_pengajuan'    => 'No. Pengajuan',
            'tgl_pengajuan'   => 'Tgl. AJU',
            'no_mak'          => 'No. Mak',
            'uraian'          => 'Uraian',
            'keterangan'      => 'Keterangan',
            'total_nilai'     => 'Total Nilai',
            'Metode'          => 'Metode',
            'status_id'       => 'Status',
        ],
        'submodule' => [
            'draft_perkantoran' => [
                'index' => [
                    'title'    => 'List detail akun (:total)',
                    'is_empty' => 'Tidak ada detail akun yg teregistrasi.',
                ],
                'tables' => [
                    'created_at'      => 'Dibuat',
                    'no_pengajuan'    => 'No. Pengajuan',
                    'tgl_pengajuan'   => 'Tgl. AJU',
                    'no_mak'          => 'No. Mak',
                    'uraian'          => 'Uraian',
                    'keterangan'      => 'Keterangan',
                    'total_nilai'     => 'Total Nilai',
                    'Metode'          => 'Metode',
                    'status_id'       => 'Status',
                    'jumlah_pagu'          => 'Jumlah Pagu',
                    'sisa_pagu'       => 'Sisa Pagu',
                    'total_pengajuan'          => 'Total Pengajuan',
                    'sisa_anggaran'       => 'Sisa Anggaran',

                ],
                'store' => [
                    'messages' => [
                        'success' => 'Akun berhasil ditambah!',
                    ],
                ],
                'destroy' => [
                    'messages' => [
                        'info'    => 'Tidak ada detail akun yg dihapus.',
                        'success' => 'Detail akun berhasil dihapus!',
                    ],
                ],
                'sent' => [
                    'messages' => [
                        'success' => 'Uang diserahkan!',
                    ],
                ],
                'berkas' => [
                    'messages' => [
                        'info'    => 'Layanan Perkantoran Ditolak!',
                        'success' => 'Penyerahan Berkas Pertanggungjawaban!',
                    ],
                ],
                'rampung' => [
                    'messages' => [
                        'info'    => 'Layanan perkantoran belum rampung.',
                        'success' => 'Layanan perkantoran rampung!',
                    ],
                ]
            ],
            'dokumen_perkantoran' => [
                'index' => [
                    'title'    => 'List dokumen perkantoran (:total)',
                    'is_empty' => 'Tidak ada dokumen perkantoran yg teregistrasi.',
                ],
                'store' => [
                    'messages' => [
                        'success' => 'Dokumen perkantoran berhasil ditambah!',
                    ],
                ],
                'destroy' => [
                    'messages' => [
                        'info'    => 'Tidak ada data yg dipilih.',
                        'success' => 'Dokumen perkantoran berhasil dihapus!',
                    ],
                ],
                'tables' => [
                    'created_at'   => 'Dibuat',
                    'nama_dokumen' => 'Dokumen',
                    'ada'          => 'Ada / Tidak',
                    'status_id'    => 'Status',
                ],
            ],
        ],
    ],
];