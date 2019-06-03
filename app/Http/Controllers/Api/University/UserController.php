<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DX\Code;
use App\Models\DX\Feedback;
use App\Services\Upload;
use App\Services\Helper;
use Illuminate\Support\Facades\Session;
use App\Models\Sms;

class UserController extends Controller
{
	/**
	 * 我的个人信息
	 * @param  [type] $user_id 当前登录用户id
	 * @return [json] json_encode        
	 */
    public function getUser(Request $request)
    {  
        if (empty($request->header('token'))) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>701,'msg'=>'token已过期！']);
        }
        $request->user_id = $user->id;
    	$data = User::getUserDetails($request->user_id);
        //获取用户是否关注公众号
        $user = User::checkSubscribe($request->user_id);
        if (empty($user)) {
            $subscribe = 0;
        }else{
            $subscribe = 1;
        }
        $data[0]->subscribe = $subscribe;
        $result['status'] = 1;
        $result['data'] = $data;
        return response()->json($result);
    }
    /**
     * 修改用戶信息
     * @param  [type] $user_id  當前登錄用戶id
     * @param  [type] $username 用戶名
     * @param  [type] $mobile   手機號
     * @param  [type] $email    郵箱
     * @param  [type] $head_pic 頭像
     * @param  [type] $nickname 暱稱
     * @param  [type] $Address  地址
     * @param  [type] $password 密码
     * @return [json] json_encode         
     */
    public function upUser(Request $request)
    {
        if (empty($request->header('token'))) {
            return  response()->json(['status'=>700,'msg'=>'请先登录！']);
        }
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>701,'msg'=>'token已过期！']);
        }
        $request->user_id = $user->id;   
        if ($request->file) {//判断是否有图片上传
           //处理敏感图片
           $response = imageVerification($request->file);
           if(200 == $response->code){
            $taskResults = $response->data;
            foreach ($taskResults as $taskResult) {
                if(200 == $taskResult->code){
                    $sceneResults = $taskResult->results;
                    foreach ($sceneResults as $sceneResult) {
                        $scene = $sceneResult->scene;
                        $suggestion = $sceneResult->suggestion;
                        if ($suggestion!='pass') {
                            return response()->json(['code' => '999','msg' => "图片违规请重新上传！"]);
                        }
                    }
                }else{
                    return response()->json(['code' => '999','msg' => "task process fail:" . $response->code]);
                }
            }
        }else{
            return response()->json(['code' => '999','msg' => "detect not success. code:" . $response->code]);
        }
           $user_pic = Upload::uploadOne('Api',$request->file);
           if ($user_pic==2) {
               return response()->json(['status'=>999,'msg'=>'图片格式错误！']);
           }
           if ($user_pic==3) {
               return response()->json(['status'=>999,'msg'=>'图片过大请重新上传！']);
           }
           if (!$user_pic) {//判断上传是否成功
               return response()->json(['status'=>1,'msg'=>'更换头像失败！']);
           }else{
             //获取当前请求域名
              // $host_name = Helper::getResponse();
              $source['head_pic'] = url($user_pic);
           }
        }else{
            //没有上传就获取old头像地址
            $source['head_pic'] = '';
        }
        if ($request->mobile) {
            $users = User::where('mobile',$request->mobile)->get();
            if (empty($users)) {
               return response()->json(['status'=>999,'msg'=>'请输入正确的手机号']);
            }
            $codes = Code::where('mobile',$request->mobile)->get();
            $user_obj = $codes[0];
             if ($request->mobile!=$user_obj->mobile || $request->code!=$user_obj->code) {
                return response()->json(['status'=>999,'msg'=>'验证码错误！']);
            }
        }
        if ($request->new_password) {
            //验证两次密码是否一致
            if ($request->password==$request->new_password) {
                $source['password'] = bcrypt($request->new_password);
            }else{
                return response()->json(['status'=>999,'msg'=>'两次密码输入不一致！']);
            }
            //验证手机是否和注册手机相同
            if ($request->mobile!=$user->mobile) {
              return response()->json(['status'=>999,'msg'=>'请使用注册手机号修改密码！']);
            }
        }else{
             $source['password'] = '';
        }
        //用户修改手机号
        if ($request->new_mobile) {
            $codes = Code::where('mobile',$request->new_mobile)->get();
            if (!$codes->toArray()) {
               return response()->json(['status'=>999,'msg'=>'验证码错误！']);
            }
            $user_obj = $codes[0];
             if ($request->new_mobile!=$user_obj->mobile || $request->code!=$user_obj->code) {
                return response()->json(['status'=>999,'msg'=>'验证码错误！']);
            }
            //验证手机是否存在
            $checkMobile = User::checkMobile($request->new_mobile);
            if ($checkMobile) {
               return response()->json(['status'=>999,'msg'=>'手机号已存在！']);
            }
            $source['mobile'] = $request->new_mobile;
        }else{
            $source['mobile'] = '';
        }
        $source['user_id'] = $request->user_id;
        $source['username'] = $request->username;
        $source['nickname'] = $request->nickname;
        $source['truename'] = $request->truename;
        // $source['mobile'] = $request->mobile;
        $source['authentication'] = $request->authentication;
        $source['position'] = $request->position;
        $source['company'] = $request->company;
        $source['address'] = $request->address;
    	$result = User::upUser($source);
        return response()->json($result);
    }

    /**
     * 发送验证码
     * @param  Request $request 
     * mobile：手机号
     * @return [json]
     */
    public function sendCode(Request $request){
        if (!$request->mobile){
            return response()->json(['status'=>999,'msg'=>'手机号有误，请重新填写！']);
        }
        $yzm = rand(1000,9999);
        $res = Sms::send($request->mobile,'SMS_166905179',$yzm);
        if($res->Code != 'OK'){
            return response()->json(['status'=>999,'msg'=>'发送失败，请重试！']);
        }
        $codes = Code::where('mobile',$request->mobile)->get();
        if (!$codes->toArray()){
        $info['mobile'] = $request->mobile;
        $info['code'] = $yzm;
        $code= Code::create($info);
        return response()->json(['status'=>1,'msg'=>'验证码发送成功！']);
    }else{
        $code = $codes[0];
        $code->code = $yzm;
        if ($code->save()) {
            $data['mobile'] = $request->mobile;
            $data['yzm'] = $yzm;
            return response()->json(['status'=>1,'msg'=>'验证码发送成功！']);
      }
    }
  }
  /**
   * 微信授权用户信息
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function getWxUser(Request $request)
  {
        if (empty($request->code)) {
          return response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        $appid = config('hint.appId');
        $appsecret = config('hint.appSecret');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$request->code.'&grant_type=authorization_code';
        $acctok = request_curl($url);
        $res = json_decode($acctok,true);
         //判断是否第一次登陆
        $user = User::where('open_id',$res['openid'])->get()->toArray();
        $data['res'] = $res;
        $data['user'] = $user;
        return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
        if(!$user){
            $accUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN';
            $newtok = json_decode(request_curl($accUrl),true);

            $data['open_id'] = $newtok['openid'];
            $data['nickname'] = $newtok['nickname'];
            $data['head_pic'] = $newtok['headimgurl'];
            $data['username'] = $newtok['nickname'];
            $data['truename'] = $newtok['nickname'];
            $user = User::create($data);
            return response()->json(['status'=>1,'msg'=>'success','data'=>$user]);
        }else{
            return response()->json(['status'=>1,'msg'=>'success','data'=>$user]);
        }
  }

  /**
   * \(^o^)/~问题反馈
   * @param  Request $request [description]
   * @param  string question  反馈问题内容
   * @param  string contact   联系方式
   * @return [type]           [description]
   */
  public function feedBack(Request $request)
  {
    if (empty($request->question)) {
      return response()->json(['status'=>999,'msg'=>'参数错误']);
    }
    if (empty($request->header('token'))) {
        return  response()->json(['status'=>700,'msg'=>'请先登录！']);
    }
    if (!$user = User::isToken($request->header('token'))) {
        return  response()->json(['status'=>701,'msg'=>'token已过期！']);
    }
    $request->user_id = $user->id;
    $result = Feedback::addFeedBack($request);
    return response()->json($result);
  }
}
