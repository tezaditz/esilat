<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class PlnClass extends Model
{
    protected $table = 'pln_class';

    protected $fillable = [
        'uraian',
    ];
}
