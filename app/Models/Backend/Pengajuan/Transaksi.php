<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksi';

    protected $fillable = [
        'id_t',
        'rkakl_id',
        'jumlah',
        'vol',
        'kode_9',
        'kode_4',
        'kode_8',
        'kode_6',
        'kode_7',
        'kode_11',
        'kode_0',
        'status',
        'keterangan',
        'tanggal',
    ];

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
