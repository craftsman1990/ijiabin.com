<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    protected $table = 'advertising';

    protected $fillable = ['title','video','cover','href','location'];

    //获取广告
    public static function getAdver($lt,$num){
        $res = self::where('location',$lt)->orderBy('created_at','desc')->limit($num)->get()->toArray();
        return $res;
    }
}
