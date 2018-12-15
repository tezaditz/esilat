<?php

namespace App\Models\Backend\Rpdsummary;

use Illuminate\Database\Eloquent\Model;

class Rpdsummary extends Model
{
    //
    protected $table = 'rpdsummary';

    protected $fillable = [
        'tahun_ang',
        'bulan',
        'nilai',
        'realisasi',
    ];
}
