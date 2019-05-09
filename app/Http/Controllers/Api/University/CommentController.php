<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Comment;
use App\Models\User;
use App\Models\DX\Praise;

class CommentController extends Controller
{
	/**
	 * 用户评论
	 * @param  [type] $discussion_id 被评论的ID
	 * @param  [type] $content       评论内容
	 * @param  [type] $user_id       评论人ID
	 * @param  [type] $type          1:议题评论,2:课程评论,3:课程内容评论
     * @param  [type] $grade         分数
	 * @return [json]  json_encode              
	 */
    public function comment(Request $request)
    {
        if (empty($request->discussion_id) || empty($request->content) || empty($request->type) ||empty($request->grade)) {
            return response()->json(['status'=>999,'msg'=>'参数错误']);
        }
        if (!$user = User::isToken($request->token)) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
        $request->user_id = $user->id;
    	$result = Comment::userComment($request);
    	return response()->json($result);
    }

    /**
     * 获取评论列表
     * @param  Request $request 
     * request 课程id：discussion_id	type:  1:议题评论,2:课程评论,3:课程内容评论
     * @return json_encode
     */
    public function getCommentList(Request $request)
    {
    	if (empty($request->discussion_id)) {
    		return response()->json(['status'=>999,'msg'=>'参数错误']);
    	}
    	$commentList = Comment::getCommentLit($request);
        if (empty($commentList)) {
            return  response()->json(['status'=>1,'msg'=>'暂无评论信息！']);
        }
        foreach ($commentList as $key => $v) {
            //获取点赞数量
            $praise_num = Praise::getPraiseNum($v->comment_id);
            $commentList[$key]->praise = $praise_num;
        }
        $result['status'] = 1;
        $result['data'] = $commentList;
    	return response()->json($result);
    }
}
