<?php

namespace App\Models\Backend\Pengajuan\Perjadin;

use Illuminate\Database\Eloquent\Model;

class PerjadinAkun extends Model
{
    protected $table = 'perjadin_akun';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [

        ];
    }
}