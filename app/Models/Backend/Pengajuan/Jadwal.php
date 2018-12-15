<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    //
    protected $table = 'jadwal';

    protected $fillable = [
        'kegiatan_id',
        'pegawai_id',
        'judul_kegiatan',
        'tanggal',
    ];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\Kegiatan');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Backend\Master\Pegawai');
    }
}
