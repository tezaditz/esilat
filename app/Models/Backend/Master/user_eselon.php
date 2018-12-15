<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class user_eselon extends Model
{
        protected $table = 'users_eselon';

    protected $fillable = [
    	'user_id',
    	'eselon_id',
    ];

}
