<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class JenisBelanja extends Model
{
    protected $table = 'jenis_belanja';

    protected $fillable = [
        'code','description'
    ];


}
