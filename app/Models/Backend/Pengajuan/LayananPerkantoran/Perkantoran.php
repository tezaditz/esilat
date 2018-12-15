<?php

namespace App\Models\Backend\Pengajuan\LayananPerkantoran;

use Illuminate\Database\Eloquent\Model;

class Perkantoran extends Model
{
    //
    protected $table = 'perkantoran';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [
            'no_mak'        => 'required',
            'uraian'		=> 'required',
        ];
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Backend\Master\Status');
    }

    public function dokumenperkantoran()
    {
        return $this->hasMany('App\Models\Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoran');
    }

}
