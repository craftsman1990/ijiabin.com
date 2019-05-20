<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DX\Code;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
	/**
	 * 验证码登录/密码登录
	 * @param  Request $request 
	 * $request{
	 * 	mobile：手机号
	 * 	code：验证码
	 * 	password：密码
	 * }
	 * @return userInfo
	 */
    public function login(Request $request)
    {
    	if (empty($request->mobile)) {
    		return response()->json(['status'=>999,'msg'=>'手机号不能为空']);
    	}
    	if (!empty($request->code)) {//判断是否验证码登录
      		$codes = Code::where('mobile',$request->mobile)->get();
      		$users = User::where('mobile',$request->mobile)->get();     		
      		$user_obj = $codes[0];
            if ($request->mobile!=$user_obj->mobile || $request->code!=$user_obj->code) {
            	return response()->json(['status'=>999,'msg'=>'验证码错误！']);
            }
            $user_obj->code = null;
            $user_obj->save();
	        if (!$users->toArray()){
	            $name = 'JIA_U'.dechex(date('YmdHis',time()));
	            $info['mobile'] = $mobile;
	            // $info['username'] = $mobile;
	            $info['nickname'] = $name;
	            $info['truename'] = $name;
	            $info['head_pic'] = asset('University/images/default_head_pic.png');
	            $user= User::create($info);
	            if (!$user){
	                return response()->json(['status'=>999,'msg'=>'注册失败！']);
	            }
	            $api_token = User::generateToken($user->id);//登录成功生成token
	            $userinfo['user_id'] = $user->id;
	            $userinfo['username'] = $user->username;
	            $userinfo['head_pic'] = $user->head_pic;
	            $userinfo['token'] = $api_token;
	            //首次登陆
	            $userinfo['is_first'] = 1;
	            return response()->json(['status'=>1,'msg'=>'登录成功','data'=>$userinfo]);
	        }else{
	            $user = $users[0];
	            if ($user['username']) {
	            	$userinfo['username'] = $user->username;
	            }else{
	            	$userinfo['username'] = $user->username;
	            	$userinfo['is_first'] = 1;
	            }
	            $api_token = User::generateToken($user->id);//登录成功生成token
	            $userinfo['user_id'] = $user->id;
	            $userinfo['head_pic'] = $user->head_pic;
	            $userinfo['token'] = $api_token;
	            return response()->json(['status'=>1,'msg'=>'登录成功','data'=>$userinfo]);
	        }
    	}else{//密码登录
    		$users = User::where('mobile',$request->mobile)->get();
    		if (!$users->toArray()) {
    			return response()->json(['status'=>999,'msg'=>'请先注册再进行密码登录！']);
    		}
    		if (empty($request->password)) {
    			return response()->json(['status'=>999,'msg'=>'请输入密码！']);
    		}
    		$message = [
	            'mobile.required'=>'请输入手机号',
	            'mobile.exists'=>'账号未注册，试试快速登录',
	            'password.required' => '请输入登录密码'
	        ];
        	$credentials = $this->validate($request,['mobile'=>'required|exists:users','password'=>'required'],$message);
    		if (Auth::guard('university')->attempt($credentials,true)) {
    			$api_token = User::generateToken($users[0]->id);//登录成功生成token
	    	    $userinfo['user_id'] = $users[0]->id;
	            $userinfo['username'] = $users[0]->username;
	            $userinfo['head_pic'] = $users[0]->head_pic;
	            $userinfo['token'] = $api_token;
	            return response()->json(['status'=>1,'msg'=>'登录成功','data'=>$userinfo]);
    		}else{
    			return response()->json(['status'=>999,'msg'=>'用户名或密码错误！']);
    		}
    		
    	}
    }
}
