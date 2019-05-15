<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'dx_course_content';

    protected $fillable = ['title', 'intro','label','time','try_time','video','audio','content','type','course_id','chapter','cover'];
    /**
     * 记录播放量
     * @param [type] $request [description]
     */
    public static function addPlay($request)
    {
        //获取播放量
        $Course = Content::where(['id'=>$request->content_id])->first();
        $Course->play_num = $Course->play_num+1;
        if ($Course->save()) {
            return ['status'=>1,'msg'=>'记录成功'];
        }
    }
}