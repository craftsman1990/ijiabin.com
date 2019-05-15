<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Collect;
use App\Models\User;

class CollectController extends Controller
{
	/**
	 * 用户收藏/取消收藏
	 * @param [type] $user_id       用户id
	 * @param [type] $by_collect_id 被收藏id（课程/评论）
	 * @param [type] $type          1：收藏课程，2：收藏评论
	 */
    public function collect(Request $request)
    {
        if (empty($request->by_collect_id) || empty($request->type)) {
            return response()->json(['status'=>999,'msg'=>'参数错误']);
        }
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
        $request->user_id = $user->id;
        $result = Collect::UserCollect($request);
        return response()->json($result);
    }
    /**
     * 单个/多个 删除我的收藏
     * @param  [type] $id 收藏id集合
     * @return [json]
     */
    public static function delCollect(Request $request)
    {
        if (empty($request->ids)) {
            return response()->json(['status'=>999,'msg'=>'参数错误']);
        }
        $result = Collect::delCollect($request);
        return response()->json($result);
    }
    /**
     * 我的收藏
     * @param  [type] $user_id 当前登录用户id
     * @return [json] json_encode    
     */
    public function myCollect(Request $request)
    {
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
        $request->user_id = $user->id;
        $result = Collect::getCollectList($request);
        if (empty($result)) {
            return  response()->json(['status'=>1,'msg'=>'暂无收藏数据']);
        }
        return response()->json($result);
    }
}
