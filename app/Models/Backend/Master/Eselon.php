<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Eselon extends Model
{
    //
    protected $table = 'eselon';

    protected $fillable = [
        'title',
    ];

    public static function rules()
    {
        return [
            'title' => 'required',
        ];
    }

    public function bagian_eselon()
    {
        return $this->hasMany('App\Models\Master\BagianEselon');
    }

}
