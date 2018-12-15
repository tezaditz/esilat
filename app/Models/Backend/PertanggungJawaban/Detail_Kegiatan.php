<?php

namespace App\Models\Backend\PertanggungJawaban;

use Illuminate\Database\Eloquent\Model;

class Detail_Kegiatan extends Model
{
    protected $table = 'detail_kegiatan';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'kegiatan_id', 
        'rkakl_id', 
        'level', 
        'header', 
        'rincian_akun', 
        'akun', 
        'uraian', 
        'vol1', 
        'vol2', 
        'satuan', 
        'hrgsat', 
        'jml_rph', 
        'status_id', 
        'metode', 
        'sisa_pagu', 
        'sptjbflag', 
        'kode_9', 
        'kode_4', 
        'kode_8', 
        'kode_6', 
        'kode_7', 
        'kode_11', 
        'kode_0', 
        'pj_vol1', 
        'pj_vol2', 
        'pj_hrgsat', 
        'pj_jml_rph', 
        'jenis_kegiatan', 
        'jenis_peserta'
    ];

    public static function rules()
    {
        return [
            'kegiatan_id'     => 'required',
        ];
    }

}