<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    protected $table = 'rpd';

    protected $guarded = ['id'];

    public function rkakl()
    {
        return $this->belongsTo('App\Models\Backend\Master\Rkakl');
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian');
    }

    public function rpk()
    {
        return $this->hasMany('App\Models\Backend\Rpk' , 'rpd_id');
    }
}