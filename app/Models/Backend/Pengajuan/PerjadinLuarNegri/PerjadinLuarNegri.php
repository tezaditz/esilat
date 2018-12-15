<?php

namespace App\Models\Backend\Pengajuan\PerjadinLuarNegri;

use Illuminate\Database\Eloquent\Model;

class PerjadinLuarNegri extends Model
{
    //
    protected $table = 'perjadin_luar_negri';

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
            'negara_id'         => 'required',
        ];
    }

    public static function rules_edit()
    {
        return [
            'no_surat_tugas'    => 'required',
            'tgl_surat_tugas'   => 'required',
            'tgl_awal'          => 'required',
            'tgl_akhir'         => 'required',
            'negara_id'         => 'required',
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

    public function detailperjadin()
    {
        return $this->hasMany('App\Models\Backend\PertanggungJawaban\DetailPerjadin');
    }

    public function dataperjadin()
    {
        return $this->hasMany('App\Models\Backend\PertanggungJawaban\DataPerjadin');
    }

    public function negara()
    {
        return $this->belongsTo('App\Models\Backend\Master\Negara');
    }
}
