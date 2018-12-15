<?php

namespace App\Models\Backend\Dashboard;

use Illuminate\Database\Eloquent\Model;

class realisasipengadaan extends Model
{
    protected $table = 'realisasi_pengadaan';

    protected $fillable = [
        'eselon_id',
        'kode_satker',
        'nama_satker',
        'alokasi',
        'nilai_kontrak',
        'pencairan_kontrak',
    ];
}
