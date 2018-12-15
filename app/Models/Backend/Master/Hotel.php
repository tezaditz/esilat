<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';

    protected $fillable = [
        'nama_hotel',
        'npwp',
        'nama_bank',
        'no_rekening',
        'ktp',
        'nama_perusahaan',
    ];

    public static function rules()
    {
        return [
            'nama_hotel'      => 'required',
            'npwp'            => 'required',
            'nama_bank'       => 'required',
            'no_rekening'     => 'required',
            'ktp'             => 'required',
            'nama_perusahaan' => 'required',
        ];
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Models\Pengajuan\Kegiatan');
    }
    
}
