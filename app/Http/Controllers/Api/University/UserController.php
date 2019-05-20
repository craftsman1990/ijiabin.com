<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DX\Code;
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
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
        $request->user_id = $user->id;
    	$data = User::getUserDetails($request->user_id);
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
        if (!$user = User::isToken($request->header('token'))) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
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
           if (!$user_pic) {//判断上传是否成功
               return response()->json(['status'=>1,'msg'=>'更换头像失败！']);
           }else{
             //获取当前请求域名
              $host_name = Helper::getResponse();
              $source['head_pic'] = $host_name.$user_pic;
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
                return response()->json(['status'=>1,'msg'=>'两次密码输入不一致！']);
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
        $res = Sms::send($request->mobile,'SMS_152880235',$yzm);
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
}
