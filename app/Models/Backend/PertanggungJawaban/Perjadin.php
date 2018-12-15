<?php

namespace App\Models\Backend\PertanggungJawaban;

use Illuminate\Database\Eloquent\Model;

class Perjadin extends Model
{
    protected $table = 'perjadin';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [
            'bagian_id'         => 'required',
            'no_mak'            => 'required',
            'nama_kegiatan'     => 'required',
            'no_surat_tugas'    => 'required',
            'tgl_surat_tugas'   => 'required',
            'tgl_awal'          => 'required',
            'tgl_akhir'         => 'required',
            'provinsi_id'       => 'required',
            'kabkota'           => 'required',
        ];
    }

    public static function rules_edit()
    {
        return [
            'no_surat_tugas'    => 'required',
            'tgl_surat_tugas'   => 'required',
            'tgl_awal'          => 'required',
            'tgl_akhir'         => 'required',
            'provinsi_id'       => 'required',
            'kabkota'           => 'required',
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

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Backend\Master\Provinsi');
    }

    public function detailperjadin()
    {
        return $this->hasMany('App\Models\Backend\PertanggungJawaban\DetailPerjadin');
    }

    public function dataperjadin()
    {
        return $this->hasMany('App\Models\Backend\PertanggungJawaban\DataPerjadin');
    }

    public function kabkota()
    {
        return $this->belongsTo('App\Models\Backend\Master\KabKota');
    }

}