<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:23 AM
 */
return [
    'module' => 'Pengajuan',

    'submodule' => [
        'kegiatan'       => 'Kegiatan',
        'draft_kegiatan' => 'Draft Pengajuan Kegiatan',
    ],

    'kegiatan' => [
        'index' => [
            'title'    => 'List kegiatan (:total)',
            'is_empty' => 'Tidak ada kegiatan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Kegiatan berhasil dibuat!',
            ],
        ],
        'sent' => [
            'messages' => [
                'success' => 'Kegiatan berhasil dikirim!',
                'error' => [
                    'metode' => 'Metode Bayar Tidak Boleh Kosong!',
                    'Status' => 'Status Tidak Boleh Kosong!'
                ],
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Kegiatan berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Kegiatan berhasil dihapus!',
            ],
        ],
        'pilih' => [
            'messages' => [
                'success' => 'Pegawai berhasil dipilih!',
            ],
        ],
        'rampung' => [
            'messages' => [
                'info'    => 'Kegiatan belum rampung!',
                'success' => 'Kegiatan rampung!',
            ],
        ],
        'berkas' => [
            'messages' => [
                'info'    => 'Kegiatan Ditolak!',
                'success' => 'Penyerahan Berkas Pertanggungjawaban Kegiatan!',
            ],
        ],
        'selesai' => [
            'messages' => [
                'success' => 'Pertanggungjawaban Kegiatan Selesai!',
            ],
        ],
        'tables' => [
            'created_at'      => 'Dibuat',
            'bagian_id'       => 'Bagian',
            'no_aju'          => 'No. AJU',
            'tahun_anggaran'  => 'Tahun Anggaran',
            'tgl_pengajuan'   => 'Tgl. AJU',
            'no_mak'          => 'No. Mak',
            'nama_kegiatan'   => 'Kegiatan',
            'subkomponen'     => 'Subkomponen',
            'judul'           => 'Nama Kegiatan',
            'tgl_kegiatan'    => 'Tgl. Kegiatan',
            'hotel'           => 'Hotel',
            'total_realisasi' => 'Jumlah Pengajuan',
            'jenis_transaksi' => 'Jenis Transaksi',
            'posisi_dok'      => 'Posisi Dok.',
            'tgl_awal'        => 'Tgl. Awal',
            'tgl_akhir'       => 'Tgl. Akhir',
            'lokasi'          => 'Lokasi',
            'provinsi'        => 'Daerah',
            'alasan'          => 'Alasan',
            'status'          => 'Status',
            'active'          => 'Active',
            'inactive'        => 'Inactive',
            'not_found'       => 'There are no records.',
            'publish_at'      => 'Publish at',
            'order'           => 'Order',
            'empty'           => 'Tidak diisi',
            'akun'            => 'Akun',
            'uraian'          => 'Uraian',
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

    'perjadin' => [
        'index' => [
            'title'    => 'List kegiatan (:total)',
            'is_empty' => 'Tidak ada kegiatan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Kegiatan berhasil dibuat!',
            ],
            'rpk' => [
                'empty' => 'Tidak ada data RPK pada tanggal tersebut',
            ],
        ],
        'sent' => [
            'messages' => [
                'success' => 'Kegiatan berhasil dikirim!',
            ],
        ],
        'update' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Kegiatan berhasil diubah!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Kegiatan berhasil dihapus!',
            ],
        ],
        'pilih' => [
            'messages' => [
                'success' => 'Pegawai berhasil dipilih!',
            ],
        ],
        'rampung' => [
            'messages' => [
                'info'    => 'Kegiatan belum rampung!',
                'success' => 'Kegiatan rampung!',
            ],
        ],
        'berkas' => [
            'messages' => [
                'info'    => 'Kegiatan Ditolak!',
                'success' => 'Penyerahan Berkas Pertanggungjawaban Kegiatan!',
            ],
        ],
        'selesai' => [
            'messages' => [
                'success' => 'Pertanggungjawaban Kegiatan Selesai!',
            ],
        ],
        'tables' => [
            'created_at'      => 'Dibuat',
            'bagian_id'       => 'Bagian',
            'no_aju'          => 'No. AJU',
            'tahun_anggaran'  => 'Tahun Anggaran',
            'tgl_pengajuan'   => 'Tgl. AJU',
            'no_mak'          => 'No. Mak',
            'nama_kegiatan'   => 'Kegiatan',
            'subkomponen'     => 'Subkomponen',
            'judul'           => 'Nama Kegiatan',
            'tgl_kegiatan'    => 'Tgl. Kegiatan',
            'hotel'           => 'Hotel',
            'total_realisasi' => 'Jumlah Pengajuan',
            'jenis_transaksi' => 'Jenis Transaksi',
            'posisi_dok'      => 'Posisi Dok.',
            'tgl_awal'        => 'Tgl. Awal',
            'tgl_akhir'       => 'Tgl. Akhir',
            'lokasi'          => 'Lokasi',
            'provinsi'        => 'Daerah',
            'alasan'          => 'Alasan',
            'status'          => 'Status',
            'active'          => 'Active',
            'inactive'        => 'Inactive',
            'not_found'       => 'There are no records.',
            'publish_at'      => 'Publish at',
            'order'           => 'Order',
            'empty'           => 'Tidak diisi',
            'akun'            => 'Akun',
            'uraian'          => 'Uraian',
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
];