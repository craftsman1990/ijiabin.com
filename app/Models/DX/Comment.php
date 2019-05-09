<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $table = 'dx_comment';

    protected $fillable = ['discussion_id', 'content','user_id','praise','status','type','grade'];

    /**
     * 用户评论
     * @param  [type] $request
     * $request {
     *     discussion_id：评论的内容id 
     *     content：评论内容
     *     user_id：用户id
     *     type: 1.议题评论	2.课程评论	3.课程内容评论
     * @return array
     */
    public static function userComment($request)
    {
    	//需要调用腾讯的敏感词过滤
    	$commentObj = new Comment();
    	$commentObj->discussion_id = $request->discussion_id;
    	$commentObj->content = $request->content;
    	$commentObj->user_id = $request->user_id;
    	$commentObj->praise = 0;
    	$commentObj->type = $request->type;
        $commentObj->grade = $request->grade;
    	$commentObj->status = 1;
    	if ($commentObj->save()) {
    		return ['status'=>1,'msg'=>'评论成功'];
    	}else{
    		return ['status'=>999,'msg'=>'评论失败'];
    	}
    }

    /**
     * 根据课程id获取评论信息
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function getCommentLit($request)
    {
        $source = DB::table('dx_comment')
        ->join('users','dx_comment.user_id','=','users.id')
        ->where(['discussion_id'=>$request->discussion_id,'status'=>1,'type'=>2])
        ->select('content','praise','dx_comment.id as comment_id','nickname','email','head_pic','grade')
        ->get()
        ->toArray();
       return $source;
    }
}
