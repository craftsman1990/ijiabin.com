<?php

namespace App\Http\Controllers\University;

use App\Models\DX\Collect;
use App\Models\DX\Comment;
use App\Models\DX\Content;
use App\Models\DX\Course;
use App\Models\DX\Discussion;
use App\Models\DX\Feedback;
use App\Models\DX\LearningState;
use App\Models\DX\Order;
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
        $user = Auth::guard('university')->user();
        $score = GuesteScore::where('user_id',$user->id)->first();
        if (!$score){
            $score = GuesteScore::create(array('user_id'=>$user->id,'score'=>0));
        }
//        dd($user);
        return view('University.My.index',compact('user','score'));
    }

    //我的嘉分
    public function guesteScore(){
        $user = Auth::guard('university')->user();
        $score = GuesteScore::where('user_id',$user->id)->first();
        $records = ScoreRecord::where('gs_id',$score->id)->get();
//        dd($score,$records);
        return view('University.My.guesteScore',compact('score','records'));
    }

    //关于嘉分
    public function aboutGuesteScore(){
        return view('University.My.aboutGuesteScore');
    }

    //我的评论
    public function comment(){
        $user = Auth::guard('university')->user();
        $comments = Comment::where('user_id',$user->id)->get();
        foreach ($comments as $comment){
            $discussion = Discussion::find($comment->discussion_id);
            $comment->dis_title = $discussion->title;
            $comment->dis_time = str_replace('-','.',substr($discussion->time,0,10));
            $comment->dis_count = Comment::where('discussion_id',$discussion->id)->count();
        }
//        dd($comments);
        return view('University.My.comment',compact('comments','user'));
    }

    //我的已购
    public function order(){
        $user = Auth::guard('university')->user();
        $orders = Order::where('user_id',$user->id)->where('status',1)->get();
        foreach ($orders as $order){
            $course = Course::find($order->course_id);
            $contents = Content::where('course_id',$course->id)->get();
            $learningCount = 0;
            $contentsCount = count($contents);
            foreach ($contents as $content){
                $learning = LearningState::where('user_id',$user->id)->where('content_id',$content->id)->where('state',1)->first();
                if ($learning){
                    $learningCount++;
                }else{
                    break;
                }
            }
            if ($learningCount == $contentsCount){
                $order->learningState = 2;
            }elseif($learningCount > 0){
                $order->learningState = 1;
                $order->learningCount = $learningCount;
            }else{
                $order->learningState = 0;
            }
            $order->course = $course;
        }
//        dd($orders);
        return view('University.My.order',compact('orders'));
    }

    //我的收藏
    public function collect(){
        $user = Auth::guard('university')->user();
        $collects = Collect::where('user_id',$user->id)->where('status',1)->get();
        $data = array();
        $data['courseCount'] = 0;
        $data['commentCount'] = 0;
        foreach($collects as $collect){
            if ($collect->type ==1){
                //课程收藏
                $course = Course::find($collect->by_collect_id);
                if ($course){
                    $course->collect_id = $collect->id;
                    $data['course'][] = $course;
                    $data['courseCount'] ++;
                }
            }else{
                //评论收藏
                $comment = Comment::find($collect->by_collect_id);
                if ($comment){
                    $comment->collect_id = $collect->id;
                    $data['comment'][] = $comment;
                    $data['commentCount'] ++;
                }
            }
        }
        if (isset($data['course'])){
            foreach ($data['course'] as $course){
                $contents = Content::where('course_id',$course->id)->get();
                $learningCount = 0;
                $contentsCount = 0;
                foreach ($contents as $content){
                    $learning = LearningState::where('user_id',$user->id)->where('content_id',$content->id)->first();
                    if ($learning){
                        $learningCount++;
                    }
                    $contentsCount++;
                }
                /*if ($learningCount == $contentsCount){
                    //已学完
                    $course->learningState = 2;
                }elseif($learningCount > 0){
                    //学习中
                    $course->learningState = 1;
                }else{
                    //未学习
                    $course->learningState = 0;
                }*/
                $course->contentsCount = $contentsCount;
                $course->learningCount = $learningCount;
            }
        }
        if (isset($data['comment'])){
            foreach ($data['comment'] as $comment){
                $discussion = Discussion::find($comment->discussion_id);
                $comment->dis_title = $discussion->title;
                $comment->dis_time = str_replace('-','.',substr($discussion->time,0,10));
                $comment->dis_count = Comment::where('discussion_id',$discussion->id)->count();
                $comUser = User::find($comment->user_id);
                if ($comUser){
                    $comment->user_name = $comUser->nickname;
                    $comment->user_pic = $comUser->head_pic;
                }else{
                    $comment->user_name = '该用户已注销';
                    $comment->user_pic = asset('University/images/jbdx_code.png');
                }
            }
        }

    //    dd($data);
        return view('University.My.collect',compact('data','user'));
    }
    /*
        * 取消收藏
        * */
    public function cancelCollect(Request $request){
//        dd($request->all());
        $num = 0;
        foreach ($request->ids as $v){
            if (Collect::find($v)->update(['status'=>0])){
                $num++;
            }
        }
        return response(['code'=>'002','msg'=>'取消'.$num.'条收藏成功！','data'=>$num]);
    }

    //问题反馈
    public function feedback(Request $request){
        if ($request->all()){
            $verif = array('question'=>'required');
            $credentials = $this->validate($request,$verif);
            $credentials['user_id'] = Auth::guard('university')->id();
            if (Feedback::create($credentials)){
                return redirect('university/my/index')->with('hint','感谢您的反馈，我们会尽快为您处理！');
            }else{
                return back()->with('hint','提交失败，请稍后再试！');
            }
        }
        return view('University.My.feedback');
    }

    //设置
    public function setting(){
        return view('University.My.setting');
    }

    //账号管理
    public function accountManagement(){
        $user = Auth::guard('university')->user();
//        dd($user);
        return view('University.My.accountManagement',compact('user'));
    }

    //修改手机号
    public function editMobile(Request $request){
        if ($request->all()){
            $this->validate($request,['mobile'=>'required|unique:users']);
            $yzm = Session::get('yzm');
            $mobile = Session::get('mobile');
            if ($request->mobile != $mobile || $request->yzm != $yzm){
                return back()->with('hint',config('jbdx.yzm_error'));
            }
            $user = Auth::user();
            if ($user->update(['mobile'=>$request->mobile])){
                return redirect('university/my/index')->with('hint',config('jbdx.update_success'));
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
//                return back()->with('success',config('jbdx.update_success'));
                return redirect('university/my/index')->with('hint',config('jbdx.update_success'));
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
        $userInfo = [
            'nickname' => $newtok['nickname'],
            'truename' => $newtok['nickname'],
            'head_pic' => $newtok['headimgurl'],
            'open_id' => $newtok['openid'],
            ];
        $user = Auth::guard('university')->user();
        if ($user->update($userInfo)){
            return redirect('university/my/index')->with('hint','欢迎');
        }else{
            return redirect('university/my/index')->with('hint','获取信息失败，请自行填写');
        }
    }

    //手动填写信息
    public function fillInfo(Request $request){
        $user = Auth::guard('university')->user();
        if($request->all()){
            $credentials = $this->validate($request,['truename'=>'required|max:10'],['truename.required' => '名称不能为空','truename.max' => '名称超过10个字符']);
            $response = detection($credentials['truename']);
            if(200 == $response->code){
                $taskResults = $response->data;
                foreach ($taskResults as $taskResult) {
                    if(200 == $taskResult->code){
                        $sceneResults = $taskResult->results;
                        foreach ($sceneResults as $sceneResult) {
                            $scene = $sceneResult->scene;
                            $suggestion = $sceneResult->suggestion;
                            //根据scene和suggetion做相关处理
                            if ($suggestion == 'block'){
                                //获取非法字段
                                /*foreach($sceneResult->details as $detail){
                                    foreach ($detail->contexts as $context){
                                        $content = $context->context;
                                    }
                                }*/
                                return back()->with('hint','姓名违法');
                            }
                        }
                    }else{
                        return back()->with('hint',"task process fail:" . $response->code);
                    }
                }
            }else{
                return back()->with('hint',"detect not success. code:" . $response->code);
            }
            $credentials['nickname'] = $credentials['truename'];
            if ($request->head_pic){
                $path = Upload::baseUpload($request->head_pic,'upload/User');
                if ($path){
                    //创建缩略图
                    $Compress = new Compress(public_path($path),'0.4');
                    $Compress->compressImg(public_path(thumbnail($path)));

                    //删除旧图片(如果有，并且不是默认头像)
                    if ($user->head_pic != asset('University/images/default_head_pic.png')){
                        $head_pic = strstr($user->head_pic,'upload');
                        if ($head_pic){
                            if (is_file(public_path($head_pic))){
                                unlink(public_path($head_pic));
                            }
                            if (is_file(public_path(thumbnail($head_pic)))){
                                unlink(public_path(thumbnail($head_pic)));
                            }
                        }
                    }
                }else{
                    return back() -> with('hint',config('hint.upload_failure'));
                }
                $credentials['head_pic'] = asset($path);
            }
            if ($user->update($credentials)){
                return redirect('university/my/index')->with('hint','欢迎');
//                return redirect('university/my/editPassWord')->with('hint','欢迎');
            }else{
                return redirect('university/my/index')->with('hint','填写失败，请稍后重试！');
            }
        }
        return view('University.My.fillInfo',compact('user'));
    }

    //静默授权获取openid
    public function getOpenId(){
        $appid = config('hint.appId');
        $appsecret = config('hint.appSecret');
        $code = $_GET['code'];
        $id = $_GET['state'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $acctok = request_curl($url);
        $res = json_decode($acctok,true);
        $accUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN';
        $newtok = json_decode(request_curl($accUrl),true);
        $user = Auth::guard('university')->user();
        if ($user->update(['open_id'=>$newtok['openid']])){
//            return redirect('university/course/video/id/'.$id)->with('hint','授权成功请点击完成支付');
            return redirect()->route('video',['id'=>$id])->with('hint','授权成功请点击完成支付');
        }else{
//            return redirect('university/course/video/id'.$id)->with('hint','授权失败请稍后重试');
            return redirect()->route('video',['id'=>$id])->with('hint','授权失败请稍后重试');
        }
    }

}
