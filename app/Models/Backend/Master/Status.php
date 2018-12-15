<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table = 'status';

    protected $fillable = [
    	'kode_status',
    	'keterangan',
    	'posisi_dokumen',
    	'modul',
    	'kode_realisasi',
    ];

    public static function rules()
    {
        return [
            'kode_status'         => 'required',
            'keterangan'          => 'required',
        ];
    }

    public function perkantoran()
    {
        return $this->hasMany('App\Models\Backend\Pengajuan\Perkantoran');
    }

}
