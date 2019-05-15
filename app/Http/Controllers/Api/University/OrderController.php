<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Order;
use App\Models\User;

class OrderController extends Controller
{
	/**
	 * 我的购买列表
	 * @param  [type] $user_id 当前登录用户id
	 * @return [json] json_encode         
	 */
    public function myOrder(Request $request)
    {
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
        $request->user_id = $user->id;
    	$result = Order::myOrderList($request);
        if (empty($result)) {
            return  response()->json(['status'=>1,'msg'=>'暂无购买记录！']);
        }
    	$data['status'] = 1;
    	$data['data'] = $result;
    	return response()->json($data);
    }
}
