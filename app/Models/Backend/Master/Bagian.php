<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'bagian';

    protected $fillable = [
        'nama_bagian',
        'kode',
    ];

    public static function rules()
    {
        return [
            'nama_bagian' => 'required',
            'kode'       => 'required',
        ];
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Models\Pengajuan\Kegiatan');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Models\Pengajuan\Jadwal');
    }

    public function pegawai()
    {
        return $this->hasMany('App\Models\Master\Pegawai');
    }

    public function bagian_eselon()
    {
        return $this->hasMany('App\Models\Backend\Master\BagianEselon');
    }

}
