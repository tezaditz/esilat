<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 08:23 AM
 */
return [
    'module' => 'PeranggungJawaban',

    'submodule' => [
        'kegiatan'                       => 'Kegiatan',
        'nominatif'                      => 'Nominatif',
        'perjadin'                       => 'Perjadin Dalam Negeri',
        'perjadin_luar_negri'            => 'Perjadin Luar Negeri',
        'akun_perjadin'                  => 'Akun Perjadin',
        'perkantoran'                    => 'Layanan Perkantoran',
        'pelaksana'                      => 'Pelaksana Perjadin',
        'draft_perjadin'                 => 'Draft Pengajuan Perjadin Dalam Negeri',
        'draft_perjadin_luar'            => 'Draft Pengajuan Perjadin Luar Negeri',
        'detail_perjadin'                => 'Detail Pengajuan Perjadin Dalam Negeri',
        'draft_perjadin_luar_negri'      => 'Draft Pertanggungjawaban Perjadin Luar Negeri',
        'detail_perjadin_luar_negri'     => 'Detail Pertanggungjawaban Perjadin Luar Negeri',
    ],

    'kegiatan' => [
        'index' => [
            'title'    => 'List Pertanggungjawaban kegiatan (:total)',
            'is_empty' => 'Tidak ada Pertanggungjawaban kegiatan kegiatan yg teregistrasi.',
        ],
        'store' => [
            'messages' => [
                'success' => 'Detail Kegiatan berhasil di Update!',
                'info'    => 'Tidak ada data data yang di input.'
            ],
        ],
        'tables' => [
            'created_at'      => 'Dibuat',
            'bagian_id'       => 'Bagian',
            'no_aju'          => 'No. AJU',
            'tahun_anggaran'  => 'Tahun Anggaran',
            'tgl_pengajuan'   => 'Tgl. AJU',
            'no_mak'          => 'No. Mak',
            'nama_kegiatan'   => 'Nama Kegiatan',
            'subkomponen'     => 'Subkomponen',
            'judul'           => 'Nama Kegiatan',
            'tgl_kegiatan'    => 'Tgl. Kegiatan',
            'hotel'           => 'Hotel',
            'total_realisasi' => 'Jumlah Pengajuan',
            'jenis_transaksi' => 'Jenis Transaksi',
            'posisi_dok'      => 'Posisi Dok.',
            'tgl_awal'        => 'Tgl. Awal',
            'tgl_akhir'       => 'Tgl. Akhir',
            'provinsi'        => 'Daerah',
            'status'          => 'Status',
            'active'          => 'Active',
            'inactive'        => 'Inactive',
            'not_found'       => 'There are no records.',
            'publish_at'      => 'Publish at',
            'order'           => 'Order',
            'empty'           => 'Tidak diisi',
        ],
    ],

    'perkantoran' => [
        'index' => [
            'title'    => 'List Layanan Perkantoran (:total)',
            'is_empty' => 'Tidak ada Layanan Perkantoran yg teregistrasi.',
        ],
        'sent' => [
            'messages' => [
                'success' => 'Pertanggungjawaban Layanan Perkantoran berhasil dikirim!',
            ],
        ],
        'selesai' => [
            'messages' => [
                'success' => 'Pertanggungjawaban Layanan Perkantoran Selesai',
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

    'perjadin' => [
        'index' => [
            'title'    => 'List Perjadin Dalam Negeri (:total)',
            'is_empty' => 'Tidak ada Pertanggungjawaban Perjadin yg teregistrasi.',
            'kegiatan_title'    => 'List Perjadin Dalam Negeri (:total)',
            'kegiatan_is_empty' => 'Tidak ada Perjadin yg teregistrasi.',
            'perjadin_luar_title'    => 'List Perjadin Luar Negeri (:total)',
        ],
        'store' => [
            'messages' => [
                'success' => 'Perjadin berhasil dibuat!',
            ],
        ],
        'kirim' => [
            'messages' => [
                'info'    => 'Update status berhasil .',
                'success' => 'Update status Tidak berhasil!',
            ],
        ],
        'destroy' => [
            'messages' => [
                'info'    => 'Tidak ada data yg dipilih.',
                'success' => 'Perjadin berhasil dihapus!',
            ],
        ],
        'tables' => [
            'created_at'      => 'Dibuat',
            'bagian_id' => 'Bagian',
            'no_aju' => 'No. AJU',
            'tgl_pengajuan' => 'Tgl. AJU',
            'no_mak' => 'No. Mak',
            'thn_anggaran' => 'Thn. Anggaran', 
            'nama_kegiatan' => 'Nama Kegiatan',
            'tgl_kegiatan'    => 'Tgl. Kegiatan',
            'no_surat_tugas' => 'No. Surat Tugas',
            'tgl_surat_tugas' => 'Tgl Surat Tugas',
            'tgl_awal' => 'Tgl Awal',
            'tgl_akhir' => 'Tgl Akhir',
            'provinsi_id' => 'Prov Tujuan',
            'kabkota' => 'Kab/Kota',
            'alasan' => 'Alasan',
            'total_pengajuan' => 'Total pengajuan',
            'metode' => 'Metode',
            'status' => 'Status',
            'posisi_dok' => 'Posisi Dok.',
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
                'store' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada akun yg dipilih.',
                        'success' => 'Perjadin berhasil dibuat!',
                    ],
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
                    'vol2'          => 'Jumlah Pelaksana',
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
            'detail_perjadin' => [
                'index' => [
                    'title'    => 'List Pelaksana (:total)',
                    'is_empty' => 'Tidak ada Pelaksana yg teregistrasi.',
               ] ,
               'destroy' => [
                    'messages' => [
                        'info'    => 'Tidak ada peserta yg dihapus.',
                        'success' => 'Peserta berhasil dihapus!',
                    ],
                ],
                'tables' => [
                    'created_at'        => 'Dibuat',
                    'nama_pelaksana'    => 'Nama Peserta',
                    'nip'               => 'Nip',
                    'uang_harian'       => 'Uang Harian',
                    'transport'         => 'Transport',
                    'taksi'             => 'Transport / Taksi',
                    'taksi_kab_kota'    => 'Transport / Taksi ( Kab/Kota )',
                    'registration'      => 'Registration Fee',
                    'pesawat'           => 'Tiket Pesawat',
                    'penginapan'        => 'Penginapan',
                    'total'             => 'Total',
                    'keterangan'        => 'Keterangan',
                    'nilai_pengajuan'  => 'Nilai Pengajuan',
                    'jumlah_pengajuan'  => 'Jumlah Pengajuan',
                    'active'            => 'Active',
                    'inactive'          => 'Inactive',
                    'not_found'         => 'There are no records.',
                    'publish_at'        => 'Publish at',
                    'order'             => 'Order',
                    'empty'             => 'Tidak diisi',
                ],
                'store' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada Detail Perjadin yg dipilih.',
                        'success' => 'Peserta berhasil ditambah!',
                    ],
                ],
            ],
            'draft_perjadin' => [
                'index' => [
                    'title'    => 'List Draft Perjadin',
                    'is_empty' => 'Tidak ada Draft Perjadin yg teregistrasi.',
               ] ,
                'tables' => [
                    'created_at'       => 'Dibuat',
                    'no_aju'           => 'No. AJU',
                    'posisi_dok'       => 'Posisi Dok.',
                    'status'           => 'Status',
                    'bagian_id'        => 'Bagian',
                    'no_mak'           => 'No. Mak',
                    'nama_kegiatan'    => 'Kegiatan',
                    'tgl_kegiatan'     => 'Tgl. Kegiatan',
                    'Provinsi_tujuan'  => 'Provinsi Tujuan',
                    'daerah_tujuan'    => 'Daerah Tujuan',
                    'jumlah_pengajuan' => 'Jumlah Pengajuan',

                    'akun'   => 'Akun',
                    'uraian' => 'Uraian',
                    'total'  => 'Total',

                    'nama_pelaksana' => 'Nama Lengkap',
                    'nip'            => 'Nip',
                    'uang_harian'    => 'Uang Harian',
                    'transport'      => 'Transport',
                    'pesawat'        => 'Tiket Pesawat',
                    'penginapan'     => 'Penginapan',
                    'jumlah'         => 'Jumlah',
                    'registration'   => 'Registration',
                    'nama_lengkap'   => 'Nama Lengkap',
                ],
                'store' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada Draft Perjadin yg dipilih.',
                        'success' => 'Draft berhasil dikirim!',
                    ],
                ],
                'sent' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada Draft Perjadin yg dipilih.',
                        'success' => 'Perjadin berhasil dikirim!',
                    ],
                ],
                'serahkan' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada Draft Perjadin yg dipilih.',
                        'success' => 'Uang berhasil diserahkan!',
                    ],
                ],
                'sentper' => [
                    'messages' => [
                        'info'    => 'kesalahan terjadi, mungkin tidak ada Draft Perjadin yg dipilih.',
                        'success' => 'Pertanggungjawaban berhasil dikirim!',
                    ],
                ],
                'berkas' => [
                    'messages' => [
                        'info'    => 'Perjadin Ditolak!',
                        'success' => 'Perjadin berhasil dikirim!',
                    ],
                ],

            ],
    ],
    ],



];