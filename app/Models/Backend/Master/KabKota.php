<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    //
    protected $table = 'kabkota';

    protected $guarded = ['id'];

    public static function rules()
    {
        return [
            'nama' => 'required',
        ];
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Backend\Master\Provinsi');
    }

    public function perjadin()
    {
        return $this->hasMany('App\Models\Backend\PertanggungJawaban\Perjadin');
    }
}
