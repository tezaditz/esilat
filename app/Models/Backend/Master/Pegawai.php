<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawai';

    protected $fillable = [
    	'pangkat_id',
    	'jabatan_id',
    	'bagian_id',
        'nama',
        'nip',
        'tgl_lahir',
        'tempat_lahir',
        'alamat',
    ];

    public static function rules()
    {
        return [
            'pangkat_id'   => 'required',
            'jabatan_id'   => 'required',
            'bagian_id'    => 'required',
            'nama'         => 'required',
            'nip'          => 'required',
            'tgl_lahir'    => 'required',
            'tempat_lahir' => 'required',
            'alamat'       => 'required',
        ];
    }

    public function pangkat()
    {
        return $this->belongsTo('App\Models\Backend\Master\Pangkat', 'pangkat_id');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Backend\Master\Jabatan', 'jabatan_id');
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian', 'bagian_id');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Models\Pengajuan\Jadwal');
    }
}