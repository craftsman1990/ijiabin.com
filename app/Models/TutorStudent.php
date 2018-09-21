<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorStudent extends Model
{
    protected $table = 'tutor_student';

    protected $fillable = ['name','head_pic','position','intro','classic_quote','type','show_index','sort'];

    //首页展示
    public static function getIndexShow(){
        return self::where('show_index',1)->orderBy('sort','DESC')->limit(config('hint.index_show_tust'))->get();
    }

    //单独获取导师或者学员信息
    public static function getPeople($type,$num,$start=0){
        return self::where('type',$type)->orderBy('sort','desc')->skip($start)->take($num)->get();
    }
}
