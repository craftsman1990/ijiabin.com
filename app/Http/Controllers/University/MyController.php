<?php

namespace App\Http\Controllers\University;

use App\Models\DX\ScoreRecord;
use App\Models\DX\GuesteScore;
use App\Models\User;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\Compress;

class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:university');
    }

    //我的界面
    public function index(){
        $user = Auth::user();
        $score = GuesteScore::where('user_id',$user->id)->first();
        if (!$score){
            $score = GuesteScore::create(array('user_id'=>$user->id,'score'=>0));
        }
//        dd($user);
        return view('University.My.index',compact('user','score'));
    }

    //我的嘉分
    public function guesteScore(){
        $user = Auth::user();
        $score = GuesteScore::where('user_id',$user->id)->first();
        $record = ScoreRecord::where('gs_id',$score->id)->get();
        return view('University.My.guesteScore',compact('score','record'));
    }

    //关于嘉分
    public function aboutGuesteScore(){
        return view('University.My.aboutGuesteScore');
    }

    //设置
    public function setting(){
        return view('University.My.setting');
    }

    //账号管理
    public function accountManagement(){
        $user = Auth::user();
//        dd($user);
        return view('University.My.accountManagement',compact('user'));
    }

    //修改手机号
    public function editMobile(Request $request){
        if ($request->all()){
            $yzm = Session::get('yzm');
            $mobile = Session::get('mobile');
            if ($request->mobile != $mobile || $request->yzm != $yzm){
                return back()->with('hint',config('jbdx.yzm_error'));
            }
            $user = Auth::user();
            if ($user->update(['mobile'=>$request->mobile])){
                return back()->with('success',config('jbdx.update_success'));
            }else{
                return back()->with('hint',config('jbdx.update_error'));
            }
        }
        return view('University.My.editMobile');
    }

    //修改密码
    public function editPassWord(Request $request){
        if ($request->all()){
            $this->validate($request,['password'=>'required|confirmed|min:6']);
            $user = Auth::user();
            if ($user->update(['password'=>bcrypt($request->password)])){
                return back()->with('success',config('jbdx.update_success'));
            }else{
                return back()->with('hint',config('jbdx.update_error'));
            }
        }
        return view('University.My.editPassWord');
    }

    //关于我们
    public function aboutUs(){
        return view('University.My.aboutUs');
    }

    //完善信息
    public function replenish(){
        return view('University.My.replenish');
    }

    //微信获取信息
    public function doReplenish(){
        $appid = config('hint.appId');
        $appsecret = config('hint.appSecret');
        $code = $_GET['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $acctok = request_curl($url);
        $res = json_decode($acctok,true);
        $accUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN';
        $newtok = json_decode(request_curl($accUrl),true);
        $userInfo = array('nickname' => $newtok['nickname'],
                        'head_pic'=> $newtok['headimgurl'],
                        'open_id'=> $newtok['openid'],);
        $user = Auth::user();
        if ($user->update($userInfo)){
            return redirect('university/my/index')->with('success','欢迎');
        }else{
            return redirect('university/my/index')->with('hint','获取信息失败，请自行填写');
        }
    }

    //手动填写信息
    public function fillInfo(Request $request){
        if($request->all()){
            $verif = array('truename'=>'required',
                'head_pic'=>'required');
            $credentials = $this->validate($request,$verif);
            $credentials['nickname'] = $credentials['truename'];

            $size = $credentials['head_pic']->getSize() / 1024;
            if ($size < 100){
                $per = 1;
            }else{
                $per = 0.4;
            }
            $path = Upload::uploadOne('User',$credentials['head_pic']);
            if ($path){
                $credentials['head_pic'] = $path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['head_pic']),$per);
                $Compress->compressImg(public_path(thumbnail($credentials['head_pic'])));
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
            $user = Auth::user();
            if ($user->update($credentials)){
                return redirect('university/my/index')->with('success','欢迎');
            }else{
                return redirect('university/my/index')->with('hint','填写失败，请稍后重试！');
            }
        }
        return view('University.My.fillInfo');
    }


}
