<?php

namespace App\Http\Controllers\University;

use App\Models\DX\Collect;
use App\Models\DX\Content;
use App\Models\DX\Course;
use App\Models\DX\LearningState;
use App\Models\DX\Order;
use App\Models\DX\Quiz;
use App\Models\DX\QuizAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:university',['only'=>['buy']]);
    }
    //
    public function show($id,$kid=0,$audio=0){
        $course = Course::find($id);
        $contents = Content::where('course_id',$id)->get();

        foreach ($contents as $k=>$content){
            //当前章节信息
            if ($k==$kid){
                $course->kid = $kid;
                $course->oneId = $content->id;
                $course->oneType = $content->type;
                $course->oneVideo = $content->video;
                $course->oneAudio = $content->audio ;
                $course->oneContent = $content->content;
                $course->oneTime = $content->time;
            }
            $quizs = Quiz::where('content_id',$content->id)->get();
            $content->quizCount = count($quizs);
            foreach ($quizs as $quiz){
                $quiz->answers = QuizAnswer::where('quiz_id',$quiz->id)->get();
            }
            $content->quizs = $quizs;
        }
        //判断登陆
        if (Auth::guard('university')->check()){
            $user = Auth::guard('university')->user();
            //订单信息
            $order = Order::where('user_id',$user->id)->where('course_id',$course->id)->where('status',1)->first();
            if ($order){
                $course->isBuy = 1;
            }else{
                $course->isBuy = 0;
            }
            foreach ($contents as $k=>$con){
                //章节学习记录
                $learning = LearningState::where('user_id',$user->id)->where('content_id',$con->id)->first();
                if ($learning){
                    $con->learning = $learning;
                }else{
                    $learn['user_id'] = $user->id;
                    $learn['content_id'] = $con->id;
                    $learn['learning_time'] = '0';
                    $con->learning = LearningState::create($learn);
                }
                //当前小节学习记录ID及时间


            }
          //判断是否音频跳转过来的
          if($audio == 1){
                $course->learingKey = $kid;
          }else{
              if ($kid == 0){
                  foreach ($contents as $k=>$content){
                      if ($content->learning->state ==0){
                          $course->learingKey = $k;
                          break;
                      }
                  }
              }else{
                  $course->learingKey = 0;
              }
          }


            //课程收藏记录
           /* $collect = Collect::where('user_id',$user->id)->where('by_collect_id',$course->id)->where('type',1)->first();
            if ($collect){
                $course->coll_status = $collect->status;
            }else{
                $course->coll_status = 0;
            }*/
        }
//        dd($course,$contents);
        return view('University.Course.show',compact('course','contents'));
//        return view('University.Course.test',compact('course','contents'));
    }

    /*
     * 音频
     * */
    public function audio($id,$kid){
        $course = Course::find($id);
        $contents = Content::where('course_id',$id)->get();
        foreach ($contents as $k=>$content){
            //当前章节信息
            if ($k==$kid){
                $course->kid = $kid;
                $course->oneId = $content->id;
                $course->oneType = $content->type;
                $course->oneVideo = $content->video;
                $course->oneAudio = $content->audio ;
                $course->oneContent = $content->content;
                $course->oneTime = $content->time;
            }
            $quizs = Quiz::where('content_id',$content->id)->get();
            $content->quizCount = count($quizs);
            foreach ($quizs as $quiz){
                $quiz->answers = QuizAnswer::where('quiz_id',$quiz->id)->get();
            }
            $content->quizs = $quizs;
        }
        //判断登陆
        if (Auth::guard('university')->check()){
            $user = Auth::guard('university')->user();
            //订单信息
            $order = Order::where('user_id',$user->id)->where('course_id',$course->id)->where('status',1)->first();
            if ($order){
                $course->isBuy = 1;
            }else{
                $course->isBuy = 0;
            }
            foreach ($contents as $k=>$con){
                //学习记录
                $learning = LearningState::where('user_id',$user->id)->where('content_id',$con->id)->first();
                if ($learning){
                    $con->learning = $learning;
                }else{
                    $learn['user_id'] = $user->id;
                    $learn['content_id'] = $con->id;
                    $learn['learning_time'] = '0';
                    $con->learning = LearningState::create($learn);
                }
                //当前小节学习记录ID及时间
                if ($k==$kid){
                    $course->learindgId = $con->learning->id;
                    $course->learindgTime = $con->learning->learning_time;
                }
            }
            //课程收藏
            /*$collect = Collect::where('user_id',$user->id)->where('by_collect_id',$course->id)->where('type',1)->first();
            if ($collect){
                $course->coll_status = $collect->status;
            }else{
                $course->coll_status = 0;
            }*/
//            print_r($collect);
        }
//        dd(Auth::guard('university')->check());
//        dd($contents,$course);
        return view('University.Course.audio',compact('course','contents'));
//        return view('University.Course.test',compact('course','contents'));

    }

    /*
     * 创建订单
     * */
    public function buy($id){
        $course = Course::find($id);
        $user = Auth::guard('university')->user();
        $order = Order::where('user_id',$user->id)->where('course_id',$course->id)->first();
        if (!$order){
            $data = [
                'order_num' => time(),
                'title' => $course->name,
                'user_id' => $user->id,
                'course_id' => $course->id,
                'price' => $course->price,
                'status' => 0,
            ];
            if (!$order = Order::create($data)){
                return response(['code'=>'001','msg'=>'未知错误，订单创建失败，请稍后再试！']);
            }
        }
        $wx_order =[
            'out_trade_no' => $order->order_num,
            'body' => $order->title,
            'total_fee' => $order->price * 100,
        ];
        //判断是否微信页面
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            if (!$user->open_id){
               return response(['code'=>'003','msg'=>'缺少参数openid']);
            }
            $wx_order['openid'] = $user->open_id;
            $wechat_pay = app('wechat_pay')->mp($wx_order);
//            dd($wechat_pay);

            return response(['code'=>'002','msg'=>'请求成功','data'=>$wechat_pay]);
//            return view('Payment.wxmp',compact('wechat_pay','order'));
        }else{
            $wechat_pay = app('wechat_pay')->wap($wx_order);
            return response(['code'=>'002','msg'=>'请求成功','data'=>$wechat_pay]);
//            return view('Payment.wxwap',compact('wechat_pay','order'));
        }

    }

    /*
     * 自测题修改
     * */
    public function quizForm(Request $request){
        $count = count($request->all()) - 2;
        if ($count != 0){
            if (!$request->learning_id){
                return response(['code'=>'001','msg'=>'缺少参数，登陆后再试']);
            }
            $learning = LearningState::find($request->learning_id);
            if ($learning->update(['quiz_state'=>$count])){
                return response(['code'=>'002','msg'=>'提交成功','data'=>$count]);
            }else{
                return response(['code'=>'003','msg'=>'提交失败，请稍后再试']);
            }
        }else{
            return response(['code'=>'004','msg'=>'没有任何选择']);
        }


    }

    /*
     * 学习时间及状态保存
     * */
    public function learningPut(Request $request){
        $learning = LearningState::find($request->ls_id);
        if ($learning){
            $data['learning_time'] = $request->now_time;
            if($request->state){
                $data['state'] = $request->state;
            }
            if ($learning->update($data)){
                return response(['code'=>'002','msg'=>'提交成功']);
            }else{
                return response(['code'=>'003','msg'=>'提交失败，请稍后再试']);
            }
        }else{
            return response(['code'=>'001','msg'=>'缺少参数，登陆后再试']);
        }
    }

    //课程收藏
    public function collect(Request $request){
        $user = Auth::guard('university')->user();
        if (!$user){
            return response(['code'=>'001','msg'=>'尚未登陆']);
        }
        //判断是否有收藏过
        $collect = Collect::where('user_id',$user->id)->where('by_collect_id',$request->cid)->where('type',1)->first();
        if ($collect){
            $data['status'] = $request->status;
            if ($collect->update($data)){
                return response(['code'=>'002','msg'=>'操作成功']);
            }else{
                return response(['code'=>'003','msg'=>'操作失败，稍后重试！']);
            }
        }else{
            $data['user_id'] = $user->id;
            $data['by_collect_id'] = $request->cid;
            $data['type'] = 1;
            $data['status'] = 1;
            if (Collect::create($data)){
                return response(['code'=>'002','msg'=>'操作成功']);
            }else{
                return response(['code'=>'003','msg'=>'操作失败，稍后重试！']);
            }
        }
    }

    //测试
    public function test(){

        return view('University.Course.test');
    }
}
