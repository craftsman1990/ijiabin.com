<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Admin extends Model
{

    protected $table = 'admin';

    protected $fillable = ['username', 'password','mobile','email','nickname','admin_pic'];

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
