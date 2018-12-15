<?php

namespace App\Models\Backend\PertanggungJawaban;

use Illuminate\Database\Eloquent\Model;

class DetailPerjadin extends Model
{
    protected $table = 'detail_perjadin';

    protected $guarded = ['id'];

    public function perjadin()
    {
        return $this->belongsTo('App\Models\Backend\PertanggungJawaban\Perjadin');
    }

    public function data_perjadin()
    {
        return $this->belongsTo('App\Models\Backend\PertanggungJawaban\DataPerjadin');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Backend\Master\Status');
    }

}