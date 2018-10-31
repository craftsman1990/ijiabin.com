<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\view;
use App\Models\Award;
use App\Models\Click;
use App\Models\LuckyDraw;
use App\Models\User;
use App\Models\Winners;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class MettingController extends Controller
{
//    public $uid;

  /*  public function __construct(){
        $this->uid = Cookie::get('uid');
        if (!$this->uid){
//            return redirect('api/weixin/wxLogin');die;
            return Redirect::to('api/weixin/wxLogin');
            dd(123);
        }
    }*/

    //年会抽奖
    public function luckyDraw(){
//        setcookie('uid',1);
//        dd(!array_key_exists('uid',$_COOKIE));
        if (!array_key_exists('uid',$_COOKIE)){
            return Redirect::to('mobile/metting/wxLogin');die;
        }
        $uid = $_COOKIE['uid'];
        $data = LuckyDraw::all();
        $open['status'] = 0;
        foreach ($data as $v){
            if ($v->status == 1){
                $open['id'] = $v->id;
                $open['status'] = 1;
                break;
            }
        }
        if ($open['status'] ==1){
            $arawd = Award::where('ld_id',$open['id'])->where('num','>',0)->get()->toArray();
            if (!$arawd){
                LuckyDraw::find($open['id'])->update(['status'=>0]);
                $open['status'] = 0;
            }
        }
        $winner = Winners::orderBy('time','desc')->get();
//        dd($winner);
        $user = User::find($uid);
        $open['uid'] = $uid;
        $open['nickname'] = $user->nickname;
        return view('Mobile.Metting.luckyDraw',compact('open',$open),compact('winner',$winner));
    }

    //登记领奖
    public function register(Request $request){
        if (!array_key_exists('uid',$_COOKIE)){
            return Redirect::to('mobile/metting/wxLogin');die;
        }
        $uid = $request->get('uid');

        return view('Mobile.Metting.register',compact('uid',$uid));
    }

    //登记成功
    public function doRegister(Request $request){
        if (!array_key_exists('uid',$_COOKIE)){
            return Redirect::to('mobile/metting/wxLogin');die;
        }
        $uid =  $request->post('uid');
        $data['truename'] =  $request->post('truename');
        $data['mobile'] =  $request->post('mobile');
        $data['address'] =  $request->post('address');
        User::find($uid)->update($data);
        $winner = Winners::where('user_id',$uid)->get();
        $award = Award::find($winner[0]->award_id);
        $award->uid = $uid;
//        dd($award);
        return view('Mobile.Metting.doRegister',compact('award',$award));
    }

    //我的奖品
    public function myAward($uid){
        if (!array_key_exists('uid',$_COOKIE)){
            return Redirect::to('mobile/metting/wxLogin');die;
        }
        $winner = Winners::where('user_id',$uid)->get()->toArray();
//        dd($winner);
        if ($winner){
            $data['status'] = 1;
            $data['winner'] = $winner[0];
            $data['award'] = Award::find($winner[0]['award_id']);
            $data['user'] = User::find($uid);
        }else{
            $data['status'] = 0;
        }

//        dd($uid);
        return view('Mobile.Metting.myAward',compact('data',$data));
    }

    //控制页
    public function control(){
        $data = LuckyDraw::all();
//        dd($lucky);
        return view('Mobile.Metting.control',compact('data',$data));
    }

    //点击开始
    public function doControl($status,$ldid){
//        dd($ldid);
        LuckyDraw::find($ldid)->update(['status'=>$status]);
        return Redirect::to('mobile/metting/control');
    }

    //点击抽奖
    public function clickOne(Request $request){
        $uid = $request->post('uid');
        $nickname = $request->post('nickname');
        $ld_id = $request->post('ld_id');
        $click = Click::find(1);
        $nowClick = $click->num+1;
        $click->update(['num'=>$nowClick]);
        if ($nowClick % 120 == 0){
            //查看是否已经中奖
            $zhong = Winners::where('user_id',$uid)->get()->toArray();
            if ($zhong){
                $res['code'] = 404;
                $res['msg'] = '您已中奖';
                return response($res);die;
            }
            //该场所有奖品
            $arawd = Award::where('ld_id',$ld_id)->where('num','>',0)->get()->toArray();
            //奖品抽完，该场次结束
            if (!$arawd){
                $res['code'] = 401;
                $res['msg'] = '已经结束';
                LuckyDraw::find($ld_id)->update(['status'=>0]);
                return response($res);die;
            }
            //减奖品
            $arawdNum = $arawd[0]['num'] - 1;
            $awardRes = Award::find($arawd[0]['id'])->update(['num'=>$arawdNum]);
            if ($awardRes){
                //添加中奖名单
                $winner['user_id'] = $uid;
                $winner['ld_id'] = $ld_id;
                $winner['nickname'] = $nickname;
                $winner['award_id'] = $arawd[0]['id'];
                $winner['award_name'] = $arawd[0]['name'];
                $winner['time'] = date('Y-m-d H:i:s',time());
                $winRes = Winners::create($winner);
                if ($winRes){
                    //减奖品
                    $res['code'] = 200;
                    $res['msg'] = '恭喜您中奖啦！';
                    $res['data'] = $arawd[0];
                    $res['uid'] = $uid;
                }else{
                    $res['code'] = 402;
                    $res['msg'] = '添加中奖名单失败！';
                }
            }else{
                $res['code'] = 403;
                $res['msg'] = '减奖品数目失败！';
            }
        }else{
            $res['code'] = 400;
            $res['msg'] = '未中奖';
        }
        return response($res);
    }

    //微信登陆
    public function wxLogin(){
        $appid = config('hint.appId');;
        $red_uri = urlencode('https://www.ijiabin.com/mobile/metting/getInfo');
        $scope = 'snsapi_userinfo';
        $state = 'canshu123';
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

        //判断是否第一次登陆
        $user = User::where('open_id',$res['openid'])->get()->toArray();
        if(!$user){
            $accUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN';
            $newtok = json_decode($this->request($accUrl),true);
            $data['open_id'] = $newtok['openid'];
            $data['nickname'] = $newtok['nickname'];
            $data['head_pic'] = $newtok['headimgurl'];
            $user = User::create($data);
            setcookie('uid',$user->id, time()+3600);

        }else{
            setcookie('uid',$user[0]['id'], time()+3600);
        }
        return redirect('mobile/metting/luckyDraw');
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
}
