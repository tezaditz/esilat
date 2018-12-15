<?php

namespace App\Models\Backend\Nominatif;

use Illuminate\Database\Eloquent\Model;

class Nominatif extends Model
{
    protected $table = 'nominativ';

    protected $fillable = [
        'kegiatan_id',
        'peserta_id',
        'nama_peserta',
        'nip',
        'gol',
        'instansi',
        'daerah_asal',
        'prov_daerah_tujuan',
        'kab_daerah_tujuan',
        'tgl_berangkat',
        'tgl_kembali',
        'lama',
        'tiket_pesawat',
        'transport',
        'uang_harian',
        'flag',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\Kegiatan', 'kegiatan_id');
    }
}