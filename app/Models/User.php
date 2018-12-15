<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    public $primarykey  = 'id';

    protected $fillable = [
        'name', 'email', 'password', 'bagian_id', 'username',
    ];

    public static function rules()
    {
        return [
            'name'          => 'required',
            'username'              => 'required',
            'email'             => 'required',
            'bagian_id'          => 'required',
            
        ];
    }

    public function bagian()
    {
        return $this->belongsTo('App\Models\Backend\Master\Bagian');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
