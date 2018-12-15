<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class PilihAkun extends Model
{
    protected $table = 'pilih_akun';

    protected $guarded = ['id'];

    public function rkakl()
    {
        return $this->belongsTo('App\Models\Backend\Master\Rkakl');
    }

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\Kegiatan');
    }
}