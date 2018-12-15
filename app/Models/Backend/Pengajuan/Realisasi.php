<?php

namespace App\Models\Backend\Pengajuan;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    //
    protected $table = 'realisasi';

    protected $fillable = [
        'bulan',
        'nilai_pengajuan',
        'nilai_dilaksanakan',
        'nilai_selesai',
    ];
}
