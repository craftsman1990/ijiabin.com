<?php

namespace App\Http\Controllers\University;

use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //密码登陆
    public function passwordLogin(Request $request){
        $parameter['source'] = $request->source;
        $parameter['yid'] = $request->yid;
        return view('University.Login.passwordLogin',compact('parameter'));
    }

    //执行密码登录
    public function doPasswordLogin(Request $request){
        $credentials = $this->validate($request,['mobile'=>'required','password'=>'required']);
//        dd($credentials);
        if (Auth::guard('university')->attempt($credentials)){
            $user = Auth::guard('university')->user();
            if (!$user->nickname){
                return redirect('university/my/replenish');
            }
            //从哪里来，回哪里去
            switch ($request->source){
                case 1:
                    //议题列表
                    return redirect('university/discussion/index');
                case 2:
                    //议题详情
                    return redirect('university/discussion/detail/id/'.$request->yid);
                case 3:
                    //议题详情
                    return redirect('university/discussion/commentDetail/id/'.$request->yid);
                case 4:
                    //课程内容页1
                    return redirect('university/course/show/id/'.$request->yid);
                case 5:
                    //课程内容页2
                    return redirect('university/course/audio/id/'.$request->yid);
                default:
                    return redirect('university/my/index')->with('success',config('jbdx.login_success'));
            }
        }else{
            return back()->with('hint',config('hint.error'));
        }
    }

    //快速登陆
    public function quickLogin(Request $request){
        $parameter['source'] = $request->source;
        $parameter['yid'] = $request->yid;
        return view('University.Login.quickLogin',compact('parameter'));
    }

    //执行快速登陆
    public function doQuickLogin(Request $request){
        $credentials = $this->validate($request,['mobile'=>'required','yzm'=>'required']);
        $yzm = Session::get('yzm');
        $mobile = Session::get('mobile');
        if ($credentials['mobile'] != $mobile || $credentials['yzm'] != $yzm){
            return back()->with('hint',config('jbdx.yzm_error'));
        }
        $users = User::where('mobile',$mobile)->get();
        if (!$users->toArray()){
            $info['mobile'] = $mobile;
            $user= User::create($info);
            if (!$user){
                return back()->with('hint',config('jbdx.register_error'));
            }
        }else{
            $user = $users[0];
        }
        Auth::guard('university')->login($user);
        //完善信息
        if (!$user->nickname){
            return redirect('university/my/replenish');
        }
        //返回，从哪里了，返回到哪里去
        //从哪里来，回哪里去
        switch ($request->source){
            case 1:
                //议题列表
                return redirect('university/discussion/index');
            case 2:
                //议题详情
                return redirect('university/discussion/detail/id/'.$request->yid);
            case 3:
                //议题详情
                return redirect('university/discussion/commentDetail/id/'.$request->yid);
            case 4:
                //课程内容页
                return redirect('university/course/show/id/'.$request->yid);
            case 5:
                //课程内容页2
                return redirect('university/course/audio/id/'.$request->yid);
            default:
                return redirect('university/my/index')->with('success',config('jbdx.login_success'));
        }
    }

    //退出
    public function loginOut(){
        Auth::guard('university')->logout();
        return redirect('university/login')->with('success',config('hint.back'));
    }

    //注册
    public function register(){
        return view('University.Login.register');
    }

    //注册执行
    public function doregister(Request $request){
        dd($request->all());
    }

    //服务协议
    public function serviceAgreement(){
        return view('University.Login.serviceAgreement');
    }

    //获取验证码
    public function getCode(Request $request){
        if (!$request->mobile){
            return response(array('code'=>'001','msg'=>'缺少参数：手机号'));
        }
        $yzm = rand(1000,9999);
        Session::put('mobile',$request->mobile,'180');
        Session::put('yzm',$yzm,'180');
        $res = Sms::send($request->mobile,'SMS_152880235',$yzm);
//        dd($res->Code);
        if($res->Code != 'OK'){
            return response(array('code'=>'002','msg'=>'发送失败，请重试'));
        }
        $data['mobile'] = $request->mobile;
        $data['yzm'] = $yzm;
        $data['res'] = $res;
        return response(array('code'=>'003','msg'=>'请求成功！','data'=>$data));
    }


}
