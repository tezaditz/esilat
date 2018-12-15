<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    //
    protected $table = 'negara';

    protected $fillable = [
        'kode',
        'nama_negara',
    ];

}
