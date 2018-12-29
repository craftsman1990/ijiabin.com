<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = ['username', 'password','mobile','email','nickname','admin_pic'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // 后台登陆判断
    public static function confirm($data){
        $admin = self::where('username',$data['username'])->first();
        if (!$admin) {
            return 1;
        }
        $admin = $admin -> toArray();
        if ($admin['password'] != md5($data['password'] )) {
            return 2;
        }
        Session::put('a_id', $admin['id']);
        Session::put('a_name', $admin['nickname']);
        Session::put('a_pic', $admin['admin_pic']);
        return 3;
    }
}
