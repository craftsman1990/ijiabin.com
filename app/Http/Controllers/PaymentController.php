<?php

namespace App\Http\Controllers;

use App\Models\DX\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payByWechat(Request $request) {
        $order = [
            'out_trade_no' => time(),
            'body' => 'subject-测试',
            'total_fee' => '1',
            'openid' => 'o1u9uwFPh4pBm9AjvLDo604wkGLs',
        ];
//        dd($order);
//        return response($order);
        // 校验权限
//        $this->authorize('own', $order);
        // 校验订单状态
        /*if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }*/
        // scan 方法为拉起微信扫码支付
        return app('wechat_pay')->scan([
            'out_trade_no' => $order['out_trade_no'],  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee' => $order['total_fee'], // 与支付宝不同，微信支付的金额单位是分。
            'body'      => '支付 Laravel Shop 的订单：'.$order['out_trade_no'], // 订单描述
            'openid' => 'o1u9uwFPh4pBm9AjvLDo604wkGLs'
        ]);
    }

    public function wechatNotify()
    {
        // 校验回调参数是否正确
        $data  = app('wechat_pay')->verify();
//        \Log::debug('wechat_pay notify', $data->all());
        // 找到对应的订单
        $order = Order::where('order_num', $data->out_trade_no)->first();
        // 订单不存在则告知微信支付
        if (!$order) {
            return 'fail';
        }
        // 订单已支付
        if ($order->status == 1) {
            // 告知微信支付此订单已处理
            return app('wechat_pay')->success();
        }

        // 将订单标记为已支付
        $res = $order->update([
            'pay_time'       => Carbon::now(),
            'payment_method' => 'wechat',
            'payment_no'     => $data->transaction_id,
            'status'         => 1,
        ]);

        //写入日志记录
       /* $log = '[' . date('Y-m-d H:i:s') . '] ' .$res. "\r\n";
        $filepath = storage_path('logs/test.log');
        file_put_contents($filepath,$log,FILE_APPEND);*/
        return app('wechat_pay')->success();
    }
}
