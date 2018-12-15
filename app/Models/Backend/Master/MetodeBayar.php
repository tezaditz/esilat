<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    protected $table = 'metode_bayar';

    protected $fillable = [
        'kode',
        'metode_bayar',
    ];

    public static function rules()
    {
        return [
            'kode'         => 'required',
            'metode_bayar' => 'required',
        ];
    }
}
