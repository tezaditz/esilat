<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    //
    protected $table = 'pangkat';

    protected $fillable = [
    	'pangkat',
    	'golongan',
    ];

    public static function rules()
    {
        return [
            'pangkat'         => 'required',
            'golongan'         => 'required',
        ];
    }

    public function pegawai()
    {
        return $this->hasMany('App\Models\Master\Pegawai');
    }

}
