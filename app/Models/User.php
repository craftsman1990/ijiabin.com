<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    protected $fillable = ['username', 'password','nickname','truename','head_pic','mobile','email','address','remember_token','open_id'];

}
