<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Rkakl extends Model
{
    protected $table = 'rkakl';

    protected $guarded = ['id'];

    public function pengadaan()
    {
        return $this->hasMany('App\Models\Master\Pengadaan');
    }

}
