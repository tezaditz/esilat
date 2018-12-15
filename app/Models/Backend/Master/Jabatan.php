<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $fillable = [
        'name',
    ];

    public static function rules()
    {
        return [
            'name'         => 'required',
        ];
    }

    public function pegawai()
    {
        return $this->hasMany('App\Models\Master\Pegawai');
    }

}
