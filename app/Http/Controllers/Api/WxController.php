<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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


    //微信登陆
    public function wxLogin(Request $request){
//        dd($uri);
//        return redirect('mobile/metting/luckyDraw');die;
        $appid = config('hint.appId');;
        $red_uri = urlencode($request->uri);
        $scope = 'snsapi_userinfo';
        if ($request->state){
            $state = $request->state;
        }else{
            $state = 'canshu123';
        }
//        dd($red_uri);
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$red_uri.'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect ';
        return redirect($url);
    }

    //通过code换取网页授权access_token
    public function getInfo(){
        $appid = config('hint.appId');
        $appsecret = config('hint.appSecret');
        $code = $_GET['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $acctok = $this->request($url);
        $res = json_decode($acctok,true);
        return $res;
        //判断是否第一次登陆
        /*$user = User::where('open_id',$res['openid'])->get()->toArray();
              if(!$user){
                  $accUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN';
                  $newtok = json_decode($this->request($accUrl),true);
                  $data['open_id'] = $newtok['openid'];
                  $data['nickname'] = $newtok['nickname'];
                  $data['head_pic'] = $newtok['headimgurl'];
                  $user = User::create($data);
                  setcookie('uid',$user->id, time()+3600*24);

              }else{
                  setcookie('uid',$user[0]['id'], time()+3600*24);
              }
              return redirect('mobile/metting/luckyDraw');*/
    }

    /*
     *封装Curl请求
     * @param string $url   要请求的url地址
     * @param bool  $https  是否是https请求
     * @param string $method 请求方式，默认为get请求
     * @param data   $data  如果是post请求，post的数据
     */
    public function request($url,$https=true,$method='get',$data=null){
        //1.初始化url
        $ch = curl_init($url);
        //2.设置相关的参数
        //字符串不直接输出,进行一个变量的存储
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //判断是否为https请求
        if($https === true){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //判断是否为post请求
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //3.发送请求
        $str = curl_exec($ch);
        //4.关闭连接,避免无效消耗资源
        curl_close($ch);
        return $str;
    }

    //
    /*public function getOpenId(){
        $appid = config('hint.appId');;
        $red_uri = urlencode('https://www.ijiabin.com/api/weixin/callBack');
        $scope = 'snsapi_base';
        $state = 'canshu123';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$red_uri.'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect ';
        return redirect($url);
    }*/

    /*public function callBack(Request $request){
        $appid = config('hint.appId');
        $appsecret = config('hint.appSecret');
        $code = $_GET['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $acctok = $this->request($url);
        $res = json_decode($acctok,true);
        return $res;
    }*/

    /*public function test(){
        $res = $this->getOpenId();
        dd($res);
    }*/
}
