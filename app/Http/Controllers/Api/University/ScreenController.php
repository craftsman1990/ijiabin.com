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
	 * @param  [type] $pace       播放进度
	 * @return [json] json_encode           
	 */
    public function sendScreen(Request $request)
    {
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
    	if (empty($request->content_id) || empty($request->text) || empty($request->pace)) {
    		return response()->json(['status'=>999,'msg'=>'参数错误']);
    	}
        $request->user_id = $user->id;
         //验证敏感字符处理
        $response = detection($request->text);
        if(200 == $response->code){
            $taskResults = $response->data;
            foreach ($taskResults as $taskResult) {
                if(200 == $taskResult->code){
                    $sceneResults = $taskResult->results;
                    foreach ($sceneResults as $sceneResult) {
                        $scene = $sceneResult->scene;
                        $suggestion = $sceneResult->suggestion;
                        //根据scene和suggetion做相关处理
                        if ($suggestion == 'block'){
                            //获取非法字段
                            foreach($sceneResult->details as $detail){
                                foreach ($detail->contexts as $context){
                                    $content = $context->context;
                                }
                            }
                            return response()->json(['code'=> '999','msg' => '有非法关键字！','content' => $content]);
                        }else{
                            $result = BulletScreen::userBulletScreen($request);
                            return response()->json($result);
                        }
                    }
                }else{
                    return response()->json(['code' => '999','msg' => "task process fail:" . $response->code]);
                }
            }
        }else{
            return response()->json(['code' => '999','msg' => "detect not success. code:" . $response->code]);
        }
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
