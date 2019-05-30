<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DX\LearningState;
use App\Services\Helper;
use App\Models\DX\Content;
use Illuminate\Support\Facades\Session;

class PlayController extends Controller
{
	/**
	 * 学习/播放进度
	 * @param  Request $request obj
	 * $request{token:用户登录信息,content_id:学习/播放id,learning_time:播放时长单位S}
	 * @return [type]           [description]
	 */
    public function playStates(Request $request)
    {
    	if (empty($request->content_id) || empty($request->learning_time)) {
            return response()->json(['status'=>999,'msg'=>'参数错误']);
        }
        if (empty($request->header('token'))) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>701,'msg'=>'token已过期！']);
        }
        $request->user_id = $user->id;
        $result = LearningState::learningState($request);
        return response()->json($result);
    }

    /**
     * 记录视频播放量
     * @param  Request $request [description]
     * $request{content_id：课程id}
     * @return json
     * 注意：单个ip每天只记录一次播放量
     */
    public function playNum(Request $request)
    {
        if (empty($request->content_id)) {
             return response()->json(['status'=>999,'msg'=>'参数错误']);
        }
        //获取客户端ip地址
        $ip = Helper::get_client_ip();
        $key = $request->content_id.'_ipaddr';
        if ($ip) {
            $ipaddr = Session::get($key);
            if ($ipaddr == $ip) {
                return response()->json(['status'=>999,'msg'=>'24小时内只能记录一次']);
            }else{
                $lifeTime = 24 * 3600;//一天的秒数
                Session::put($key,$ip,$lifeTime);
                $result = Content::addPlay($request);
                return response()->json($result);
            }
        }
    }
}
