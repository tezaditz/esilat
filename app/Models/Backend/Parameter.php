<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameter';

    protected $fillable = [
        'value',
        'description'
    ];

    public static function rules()
    {
        return [
            'value' => 'required',
        ];
    }
}
