<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\BulletScreen;
use App\Models\User;

class ScreenController extends Controller
{
	/**
	 * 用戶發送彈幕
	 * @param  [type] $user_id    用戶id
	 * @param  [type] $content_id 當前內容id
	 * @param  [type] $text       彈幕內容
	 * @return [json] json_encode           
	 */
    public function sendScreen(Request $request)
    {
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
    	if (empty($request->content_id) || empty($request->text)) {
    		return response()->json(['status'=>999,'msg'=>'参数错误']);
    	}
        $request->user_id = $user->id;
    	$result = BulletScreen::userBulletScreen($request);
    	return response()->json($result);
    }

    /**
     * 获取弹幕列表
     * @param  Request $request
     * $request{token：用户token,content_id:}
     * @return [type]           [description]
     */
    public function getScreen(Request $request)
    {
        if ($user = User::isToken($request->header('token'))) {
            $request->user_id = $user->id;
        }
        $result = BulletScreen::getBulletScreen($request);
        if (empty($result)) {
           return response()->json(['status'=>1,'msg'=>'暂无数据！']);
        }
        return response()->json(['status'=>1,'msg'=>'数据获取成功','data'=>$result]);
    }
}
