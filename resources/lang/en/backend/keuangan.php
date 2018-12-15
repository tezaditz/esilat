<?php

return [
    'module' => 'Keuangan',

    'submodule' => [
        'SPM'       => 'SPM',
        'SP2D' => 'SP2D',
    ],

    'SPM' => [
        'index' => [
            'title'    => 'List SPM',
            'is_empty' => 'Tidak ada SPM yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Data Master SPM berhasil dibuat!',
            ],
        ],
        'sent' => [
            'messages' => [
                'success' => 'SPM berhasil dikirim!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'SPM berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'SPM berhasil dihapus!',
            ],
        ],
        'pilih' => [
            'messages' => [
                'success' => 'Pegawai berhasil dipilih!',
            ],
        ],
        'rampung' => [
            'messages' => [
                'info'    => 'SPM belum rampung!',
                'success' => 'SPM rampung!',
            ],
        ],
        'berkas' => [
            'messages' => [
                'info'    => 'SPM Ditolak!',
                'success' => 'Penyerahan Berkas Pertanggungjawaban SPM!',
            ],
        ],
        'selesai' => [
            'messages' => [
                'success' => 'Pertanggungjawaban SPM Selesai!',
            ],
        ],
        'tables' => [
            'nomor_spm'      => 'Nomor SPM',
            'tanggal_spm'       => 'Tanggal SPM',
            'nilai_spm'          => 'Nilai SPM',
            'nomor_sp2d'  => 'Nomor SP2D',
            'tanggal_sp2d'   => 'Tanggal SP2D',
            'nilai_sp2d'          => 'Nilai SP2D',
            'metode_bayar'          => 'Jenis Pembayaran',
            'publish_at'      => 'Publish at',
            'order'           => 'Order',
            'empty'           => 'Tidak diisi',
            'akun'            => 'Akun',
            'uraian'          => 'Uraian',
        ],
        'submodule' => [
            'kegiatan' => [
                'index' => [
                    'title'    => 'List Kegiatan',
                    'is_empty' => 'Tidak ada kegiatan yg teregistrasi.',
                ],
                'tables' => [
                    'no_aju'    => 'no_pengajuan',
                    'tgl_aju'    => 'Tanggal Pengajuan',
                    'nilai_aju'    => 'Nilai Pengajuan',
                    'nama_kegiatan' => 'Nama Kegiatan',
                    'nomak' => 'No Mak',
                    'active'     => 'Active',
                    'inactive'   => 'Inactive',
                    'not_found'  => 'There are no records.',
                    'publish_at' => 'Publish at',
                    'order'      => 'Order',
                    'empty'      => 'Tidak diisi',
                ],
                'destroy' => [
                    'messages' => [
                        'info'    => 'Tidak ada detail akun yg dihapus.',
                        'success' => 'Detail akun berhasil dihapus!',
                    ],
                ],
            ],
            'pilih_akun' => [
                'index' => [
                    'title'    => 'List akun',
                    'is_empty' => 'Tidak ada akun yg teregistrasi.',
               ] ,
                'tables' => [
                    'created_at'    => 'Dibuat',
                    'no_mak'        => 'No. Mak',
                    'uraian'        => 'Uraian',
                    'vol'           => 'Volume',
                    'hargasat'      => 'Hrg. Satuan',
                    'jumlah'        => 'Jumlah',
                    'realisai'      => 'Realisasi',
                    'sisa_pagu'     => 'Sisa Pagu',
                    'sisa_vol'      => 'Sisa Volume',
                    'hrg_pengajuan' => 'Hrg. Pengajuan',
                    'total'         => 'Total',
                    'sisa_anggaran' => 'Sisa Anggaran',
                    'status'        => 'Status',
                    'active'        => 'Active',
                    'inactive'      => 'Inactive',
                    'not_found'     => 'There are no records.',
                    'publish_at'    => 'Publish at',
                    'order'         => 'Order',
                    'empty'         => 'Tidak diisi',
                ],
                'store' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada akun yg dipilih.',
                        'success' => 'Akun berhasil ditambah!',
                    ],
                ],
            ],
        ],
    ],

    'spm_detail' => [
        'index' => [
            'title'    => 'List Detail SPM',
            'is_empty' => 'Tidak ada SPM yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Data Master SPM berhasil dibuat!',
            ],
        ],
        'sent' => [
            'messages' => [
                'success' => 'SPM berhasil dikirim!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'SPM berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'SPM berhasil dihapus!',
            ],
        ],
        'pilih' => [
            'messages' => [
                'success' => 'Pegawai berhasil dipilih!',
            ],
        ],
        'rampung' => [
            'messages' => [
                'info'    => 'SPM belum rampung!',
                'success' => 'SPM rampung!',
            ],
        ],
        'berkas' => [
            'messages' => [
                'info'    => 'SPM Ditolak!',
                'success' => 'Penyerahan Berkas Pertanggungjawaban SPM!',
            ],
        ],
        'selesai' => [
            'messages' => [
                'success' => 'Pertanggungjawaban SPM Selesai!',
            ],
        ],
        'kegiatan' => [
            'messages' => [
                'success' => 'Kegiatan Berhasil Ditambahkan !',
            ],
        ],
        
        'tables' => [
            'nomor_spm'         =>  'Nomor SPM',
            'tanggal_spm'       =>  'Tanggal SPM',
            'nomak'             =>  'No Mak',
            'nama_kegiatan'     =>  'Nama Kegiatan',
            'nilai'             =>  'Nilai',
            'publish_at'        =>  'Publish at',
            'order'             =>  'Order',
            'empty'             =>  'Tidak diisi',
            'akun'              =>  'Akun',
            'uraian'            =>  'Uraian',
        ],
        'submodule' => [
            'detail_akun' => [
                'index' => [
                    'title'    => 'List detail akun (:total)',
                    'is_empty' => 'Tidak ada detail akun yg teregistrasi.',
                ],
                'tables' => [
                    'created_at' => 'Dibuat',
                    'akun'       => 'Akun',
                    'uraian'     => 'Uraian',
                    'jumlah'     => 'Jumlah',
                    'vol'        => 'Volume',
                    'hrgsat'     => 'Hrg. Satuan',
                    'total'      => 'Total:',
                    'active'     => 'Active',
                    'inactive'   => 'Inactive',
                    'not_found'  => 'There are no records.',
                    'publish_at' => 'Publish at',
                    'order'      => 'Order',
                    'empty'      => 'Tidak diisi',
                ],
                'destroy' => [
                    'messages' => [
                        'info'    => 'Tidak ada detail akun yg dihapus.',
                        'success' => 'Detail akun berhasil dihapus!',
                    ],
                ],
            ],
            'pilih_akun' => [
                'index' => [
                    'title'    => 'List akun',
                    'is_empty' => 'Tidak ada akun yg teregistrasi.',
               ] ,
                'tables' => [
                    'created_at'    => 'Dibuat',
                    'no_mak'        => 'No. Mak',
                    'uraian'        => 'Uraian',
                    'vol'           => 'Volume',
                    'hargasat'      => 'Hrg. Satuan',
                    'jumlah'        => 'Jumlah',
                    'realisai'      => 'Realisasi',
                    'sisa_pagu'     => 'Sisa Pagu',
                    'sisa_vol'      => 'Sisa Volume',
                    'hrg_pengajuan' => 'Hrg. Pengajuan',
                    'total'         => 'Total',
                    'sisa_anggaran' => 'Sisa Anggaran',
                    'status'        => 'Status',
                    'active'        => 'Active',
                    'inactive'      => 'Inactive',
                    'not_found'     => 'There are no records.',
                    'publish_at'    => 'Publish at',
                    'order'         => 'Order',
                    'empty'         => 'Tidak diisi',
                ],
                'store' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada akun yg dipilih.',
                        'success' => 'Akun berhasil ditambah!',
                    ],
                ],
            ],
        ],
    ],

    'kegiatan' => [
        'tables' => [
            ''
        ],
    ],
];