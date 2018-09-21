<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choiceness extends Model
{
    protected $table = 'choiceness';

    protected $fillable = ['type', 'cho_id'];

    //获取当前精选前三条信息
    public static function getChoi($num){
        $choi = self::select('type','cho_id')->orderBy('id','desc')->limit($num)->get();
        $newArr = array();
        foreach ($choi as $v){
            if ($v->type == 1){
                $res = Article::select('title','cover','publish_time')->find($v->cho_id);
            }else{
                $res = Video::select('title','cover','publish_time')->find($v->cho_id);
            }
            if ($res){
                $v->title = $res->title;
                $v->cover = $res->cover;
                $v->publish_time = $res->publish_time;
                $newArr[] = $v;
            }
        }
//        dd($newArr);
        return $newArr;
    }
}
