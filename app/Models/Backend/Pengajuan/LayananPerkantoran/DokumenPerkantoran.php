<?php

namespace App\Models\Backend\Pengajuan\LayananPerkantoran;

use Illuminate\Database\Eloquent\Model;

class DokumenPerkantoran extends Model
{
    //
    protected $table = 'dok_perkantoran';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [
            'nama_dokumen' => 'required',
            'ada'          => 'required',
        ];
    }

    public function perkantoran()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\LayananPerkantoran\Perkantoran');
    }
}
