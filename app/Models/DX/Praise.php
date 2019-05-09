<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Praise extends Model
{
    protected $table = 'dx_praises';

    protected $fillable = ['by_praise_id', 'type','user_id','status'];

    /**
     * 用户点赞/取消点赞
     * @param  [obj] $request
     * user_id:用户id，by_praise_id：被点赞的ID，type：1议题评论，2：课程评论
     * @return   array
     */
    public static function userPraise($request)
    {
        //验证用户是否点赞过
        $praise = Praise::where(['user_id'=>$request->user_id,'type'=>$request->type,'by_praise_id'=>$request->by_praise_id])->first();
        if (empty($praise)) {
           $praises = new Praise();
           $praises->user_id = $request->user_id;
           $praises->by_praise_id = $request->by_praise_id;
           $praises->type = $request->type;
           $praises->status = 1;
           if ($praises->save()) {
                return ['status'=>1,'msg'=>'点赞成功'];
           }
        }else{
            if ($praise->status==0) {
                $praise->status = 1;
            }else{
                $praise->status = 0;
            }
            if ($praise->save()) {
                return ['status'=>1,'msg'=>'操作成功'];
            }
        }
    }
    /**
     * 获取点赞数量
     * @param  [type] $request [by_praise_id type]
     * @return [type]          [description]
     */
    public static function getPraiseNum($by_praise_id)
    {
        $praise = Praise::where(['type'=>2,'by_praise_id'=>$by_praise_id,'status'=>1])->count();
        return $praise;
    }
}
