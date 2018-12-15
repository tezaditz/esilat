<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class BagianEselon extends Model
{
    //
    protected $table = 'bagian_eselon';

    protected $fillable = [
        'bagian_id',
        'eselon_id',
    ];

    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian');
    }

    public function eselon()
    {
        return $this->belongsTo('App\Models\Backend\Master\Eselon');
    }

}
