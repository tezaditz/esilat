<?php

namespace App\Models\Backend\PertanggungJawaban;

use Illuminate\Database\Eloquent\Model;

class DataPerjadin extends Model
{
    protected $table = 'data_perjadin';

    protected $guarded = ['id'];

    public function perjadin()
    {
        return $this->belongsTo('App\Models\Backend\PertanggungJawaban\Perjadin');
    }

    
    public function status()
    {
        return $this->belongsTo('App\Models\Backend\Master\Status');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Backend\Master\Pegawai');
    }

}