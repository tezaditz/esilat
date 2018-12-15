<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class DetailAkun extends Model
{
    protected $table = 'detail_akun';

    protected $fillable = [
        'kegiatan_id',
        'akun',
        'uraian',
        'sisa_pagu',
        'jumlah',
    ];

    public static function rules()
    {
        return [
            'kegiatan_id' => 'required',
            'akun'        => 'required',
            'uraian'      => 'required',
            'sisa_pagu'   => 'required',
            'jumlah'      => 'required',
        ];
    }

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Backend\Pengajuan\Kegiatan');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Backend\Master\Status');
    }
    public function metode_bayar()
    {
        return $this->belongsTo('App\Models\Backend\Master\MetodeBayar');
    }
}
