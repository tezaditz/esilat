<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class NoPengajuan extends Model
{
    protected $table = 'no_pengajuan';

    protected $fillable = [
        'bagian_id',
        'nomor',
        'jenis',
        'kode_transaksi',
    ];

    public static function rules()
    {
        return [
            'bagian_id'      => 'required',
            'nomor'          => 'required',
            'jenis'          => 'required',
            'kode_transaksi' => 'required',
        ];
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian');
    }
}
