<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    //

    protected $table = 'pengadaan';

    protected $fillable = [
    	'rkakl_id',
    	'no_mak_sys',
    	'uraian',
        'vol',
        'sat',
        'hargasat',
        'jumlah',
    ];

    public static function rules()
    {
        return [
            'rkakl_id'         => 'required',
            'no_mak_sys'       => 'required',
            'uraian'    => 'required',
            'vol'     => 'required',
            'sat'   => 'required',
            'hargasat'   => 'required',
            'jumlah'    => 'required',
        ];
    }

    public function rkakl()
    {
        return $this->belongsTo('App\Models\Backend\Master\Rkakl', 'rkakl_id');
        
    }

}
