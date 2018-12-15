<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    protected $fillable = [
        'title',
    ];

    public static function rules()
    {
        return [
            'title' => 'required',
        ];
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Models\Pengajuan\Kegiatan');
    }

    public function kabkota()
    {
        return $this->hasMany('App\Models\Backend\Master\Provinsi');
    }

}
