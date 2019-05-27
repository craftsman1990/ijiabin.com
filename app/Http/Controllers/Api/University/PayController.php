<?php

namespace App\Http\Controllers\api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Course;
use App\Models\DX\Order;
use App\Models\User;

class PayController extends Controller
{

	/**
	 * 微信扫码支付
	 * @param  Request $request [description]
	 * @param  string  $token  用户token
	 * @param  int     $course_id 课程id
	 * @param  string  $price  订单价格
	 * @param  string  $type   
	 * {
	 *  1:公众号支付(mp)
	 *  2:小程序支付(miniapp)
	 *  3:H5支付(wap)
	 *  4.扫码支付(scan)
	 *  5:刷卡支付(pos)
	 *  6:APP支付(app)}
	 * @return json_encode
	 */
    public function wxPay(Request $request)
    {
    	if (empty($request->course_id) || empty($request->price) || empty($request->type)) {
    		return  response()->json(['status'=>999,'msg'=>'参数错误！']);
    	}
    	if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
    	$course = Course::find($request->course_id);
        $order = Order::where('user_id',$user->id)->where('course_id',$course->id)->first();
        if (!$order){
            $data = [
                'order_num' => time(),
                'title' => $course->name,
                'user_id' => $user->id,
                'course_id' => $course->id,
                'price' => $course->price,
                'status' => 0,
            ];
            if (!$order = Order::create($data)){
                return response(['status'=>999,'msg'=>'未知错误，订单创建失败，请稍后再试！']);
            }
        }
        $wx_order =[
            'out_trade_no' => $order->order_num,
            'body' => $order->title,
            'total_fee' => $order->price * 100,
        ];
        //发起微信支付
        if ($request->type==1) {//公众号支付
        	$wechat_pay = app('wechat_pay')->mp($wx_order);
        }elseif ($request->type==2) {//小程序支付
        	$wechat_pay = app('wechat_pay')->miniapp($wx_order);
        }elseif ($request->type==3) {//H5支付
        	$wechat_pay = app('wechat_pay')->wap($wx_order);
        }elseif ($request->type==4) {//扫码支付
        	$wechat_pay = app('wechat_pay')->scan($wx_order);
        }elseif ($request->type==5) {//刷卡支付
        	$wechat_pay = app('wechat_pay')->pos($wx_order);
        }elseif ($request->type==6) {//APP支付
        	$wechat_pay = app('wechat_pay')->app($wx_order);
        }
        return response(['status'=>1,'msg'=>'请求成功','data'=>$wechat_pay]);
    }
}
