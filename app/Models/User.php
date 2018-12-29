<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = ['username', 'password','nickname','truename','head_pic','mobile','email','address','remember_token','open_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
