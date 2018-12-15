<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Rpk extends Model
{
    protected $table = 'rpk';

    protected $guarded = ['id'];

    /**
     * @return array
     */

    public function rpd()
    {
        return $this->belongsTo('App\Models\Backend\rpd', 'id');
    }

}
