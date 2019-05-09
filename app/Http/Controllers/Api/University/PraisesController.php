<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Praise;
use App\Models\User;

class PraisesController extends Controller
{
	/**
	 * 用户点赞
	 * @param  [type] $user_id      用户id
	 * @param  [type] $by_praise_id 被点赞的id
	 * @param  [type] $type         1.议题评论点赞，2.课程内容评论点赞
	 * @return [json] json_encode
	 */
   public function praises(Request $request)
   {
   		if (empty($request->by_praise_id) || empty($request->type)) {
   			return response()->json(['status'=>999,'msg'=>'参数错误']);
   		}
      if (!$user = User::isToken($request->token)) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
      }
      $request->user_id = $user->id;
   		$result = Praise::userPraise($request);
   		return response()->json($result);
   }
}
