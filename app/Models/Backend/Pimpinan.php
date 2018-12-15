<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    protected $table = 'pimpinan';

    protected $guarded = ['id'];

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'bagian_id' => 'required',
            'nip'       => 'required',
            'nama'      => 'required',
            'jabatan'   => 'required',
        ];
    }
    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian');
    }
}