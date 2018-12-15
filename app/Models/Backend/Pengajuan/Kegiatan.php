<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [
            'hotel_id'      => 'required',
            'tgl_awal'      => 'required',
            'tgl_akhir'     => 'required',
            'provinsi_id'   => 'required',
        ];
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Backend\Master\Status');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Backend\Master\Hotel');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Backend\Master\Provinsi');
    }

    public function nominatif()
    {
        return $this->hasMany('App\Models\Nominatif\Nominatif');
    }

    public function detail_akun()
    {
        return $this->hasMany('App\Models\Backend\Pengajuan\DetailAkun');
    }

    public function metode_bayar()
    {
        return $this->belongsTo('App\Models\Backend\Master\MetodeBayar');
    }

    public function detail_kegiatan()
    {
        return $this->hasMany('App\Models\Backend\Pengajuan\DetailKegiatan');
    }
}