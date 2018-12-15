<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $table = 'tamu';

    protected $fillable = [
    	'id',
    	'nip',
    	'nama',
    	'instansi',
    	'jabatan',
    ];

        public static function rules()
    {
        return [
            'instansi'   => 'required',
            'jabatan'    => 'required',
            'nama'         => 'required',
            'nip'          => 'required',
           
        ];
    }
}
