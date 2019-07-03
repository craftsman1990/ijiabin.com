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
        if ($request->type==1) {
            if (empty($request->code)) {
               return  response()->json(['status'=>999,'msg'=>'支付必填code！']);
            }
        }
        if (empty($request->header('token'))) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
    	if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>701,'msg'=>'token已过期！']);
        }
    	$course = Course::find($request->course_id);
        // $order = Order::where('user_id',$user->id)->where('course_id',$course->id)->first();
        // if (!$order){
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
        // }
        $wx_order =[
            'out_trade_no' => $order->order_num,
            'body' => $order->title,
            'total_fee' => $order->price * 100,
        ];
        $appid = config('hint.appId');
        $appsecret = config('hint.appSecret');
        //发起微信支付
        if ($request->type==1) {//公众号支付
        	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$request->code.'&grant_type=authorization_code';
            $acctok = request_curl($url);
            $res = json_decode($acctok,true);
            $wx_order['openid'] = $res['openid'];
            $wechat_pay = app('wechat_pay')->mp($wx_order);
            $wechat_pay['openid'] = $wx_order['openid'];
        }elseif ($request->type==2) {//小程序支付
        	$wechat_pay = app('wechat_pay')->miniapp($wx_order);
        }elseif ($request->type==3) {//H5支付
        	$wechat_pay = app('wechat_pay')->wap($wx_order);
        }elseif ($request->type==4) {//扫码支付
        	$wechat_pay = app('wechat_pay')->scan($wx_order);
            $wechat_pay['order'] = $wx_order['out_trade_no'];
        }elseif ($request->type==5) {//刷卡支付
        	$wechat_pay = app('wechat_pay')->pos($wx_order);
        }elseif ($request->type==6) {//APP支付
        	$wechat_pay = app('wechat_pay')->app($wx_order);
        }
        return response(['status'=>1,'msg'=>'请求成功','data'=>$wechat_pay]);
    }
    /**
     * 查询订单是否支付成功
     * @param Request $request [description]
     */
    public function PayOrder(Request $request)
    {
        if (empty($request->order_num)) {
            return  response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        $order = Order::where('order_num',$request->order_num)->first();
        if (empty($order)) {
           return response(['status'=>999,'msg'=>'订单不存在']);
        }
        // $data['order_num'] = $order->order_num;
        $data['is_pay'] = $order->status;
        return response(['status'=>1,'msg'=>'请求成功','data'=>$data]);
    }

     /**
     * wap支付
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function wapPay(Request $request)
    {
        if (empty($request->course_id) || empty($request->price)) {
            return  response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        if (empty($request->token)) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
        if (!$user = User::isToken($request->token)) {
            return  response()->json(['status'=>701,'msg'=>'token已过期！']);
        }
        $course = Course::find($request->course_id);
        if (empty($course)) {
            return  response()->json(['status'=>999,'msg'=>'课程不存在']);
        }
        //$order = Order::where('user_id',$user->id)->where('course_id',$course->id)->first();
        // if (!$order){
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
        // }
        $wx_order =[
            'out_trade_no' => $order->order_num,
            'body' => $order->title,
            'total_fee' => $order->price * 100,
        ];
            $config['return_url'] = 'https://www.ijiabin.com/test';
        return app('wechat_pay',$config)->wap($wx_order);
    }
}
