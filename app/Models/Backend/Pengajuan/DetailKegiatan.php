<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class DetailKegiatan extends Model
{
    protected $table = 'detail_kegiatan';

    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\Kegiatan');
    }

    public function rkakl()
    {
        return $this->belongsTo('App\Models\Backend\Master\Rkakl');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Backend\Master\Status');
    }
}