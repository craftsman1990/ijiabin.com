<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'dx_course';

    protected $fillable = ['name', 'crosswise_cover','lengthways_cover','teacher','professional','intro','ify','is_pay','looks','price'];

    //分类获取课程
    public static function getIfy($ify,$num){
        return self::where('ify',$ify)->orderBy('created_at','desc')->limit($num)->get();
    }
}
