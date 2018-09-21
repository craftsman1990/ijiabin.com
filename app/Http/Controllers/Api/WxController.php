<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class WxController extends Controller
{
    //微信分享
    public function getShare(Request $request){
        //获取参数
        $url = $request->get('url');
        $appid = config('hint.appId');
        $secret = config('hint.appSecret');

        //缓存内是否存在accessToken
        $accessToken = Cache::remember('accessToken11',120,function () use ($appid,$secret){
            //获取access_token的请求地址
            $accessTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
            //请求地址获取access_token
            $accessTokenJson = file_get_contents($accessTokenUrl);
            $accessTokenObj = json_decode($accessTokenJson);
            $accessToken = $accessTokenObj->access_token;
            return $accessToken;

        });

        //获取jsapi_ticket的请求地址
        $ticketUrl = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";
        $jsapiTicketJson = file_get_contents($ticketUrl);
        $jsapiTicketObj = json_decode($jsapiTicketJson);
        $jsapiTicket = $jsapiTicketObj->ticket;

        //随机生成16位字符
        $noncestr = str_random(16);
        //时间戳
        $time = time();
        //拼接string1
        $jsapiTicketNew = "jsapi_ticket=$jsapiTicket&noncestr=$noncestr&timestamp=$time&url=$url";
        //对string1作sha1加密
        $signature = sha1($jsapiTicketNew);
        //存入数据
        $data = [
            'appid' => $appid,
            'timestamp' => $time,
            'nonceStr' => $noncestr,
            'signature' => $signature,
            'jsapiTicket' => $jsapiTicket,
            'url' => $url,
            'jsApiList' => [
                'api' => '#'
            ]
        ];
        //返回
        return json_encode($data);
    }

}
