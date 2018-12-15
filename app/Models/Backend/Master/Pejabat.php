<?php

namespace App\Models\Backend\Master;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    //
    protected $table = 'pejabat';

    protected $guarded = ['id'];

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'nip'       => 'required',
            'nama'      => 'required',
            'jabatan'   => 'required',
        ];
    }
}
