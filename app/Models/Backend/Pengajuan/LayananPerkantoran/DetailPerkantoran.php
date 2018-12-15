<?php

namespace App\Models\Backend\Pengajuan\LayananPerkantoran;

use Illuminate\Database\Eloquent\Model;

class DetailPerkantoran extends Model
{
    protected $table = 'detail_perkantoran';

    protected $guarded = ['id'];

    public function perkantoran()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\LayananPerkantoran\Perkantoran');
    }
}
