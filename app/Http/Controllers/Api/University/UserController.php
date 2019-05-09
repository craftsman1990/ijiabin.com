<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Upload;
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
        if (!$user = User::isToken($request->token)) {
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
        if (!$user = User::isToken($request->token)) {
            return  response()->json(['status'=>999,'msg'=>'请先登录！']);
        }
        $request->user_id = $user->id;   
        if ($request->file) {//判断是否有图片上传
           $user_pic = Upload::uploadOne('Api',$request->file);
           if (!$user_pic) {//判断上传是否成功
               return response()->json(['status'=>1,'msg'=>'更换头像失败！']);
           }else{
              $source['head_pic'] = $user_pic;
           }
        }else{
            //没有上传就获取old头像地址
            $source['head_pic'] = "/upload/Api/4fa38f30c947ca57c547719fded06546.jpg";
        }
        if ($request->new_pass) {
            //验证两次密码是否一致
            if ($request->password==$request->new_pass) {
                $source['password'] = bcrypt($request->new_pass);
            }else{
                return response()->json(['status'=>1,'msg'=>'两次密码输入不一致！']);
            }
        }
        $source['user_id'] = $request->user_id;
        $source['username'] = $request->username;
        $source['nickname'] = $request->nickname;
        $source['truename'] = $request->truename;
        $source['mobile'] = $request->mobile;
        $source['email'] = $request->email;
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
        Session::put('mobile',$request->mobile,'180');
        Session::put('yzm',$yzm,'180');
        $res = Sms::send($request->mobile,'SMS_152880235',$yzm);
        if($res->Code != 'OK'){
            return response()->json(['status'=>999,'msg'=>'发送失败，请重试！']);
        }
        $data['mobile'] = $request->mobile;
        $data['yzm'] = $yzm;
        $data['res'] = $res; 
        return response()->json(['status'=>1,'msg'=>'验证码发送成功！','data'=>$data]);
    }
}
