<?php

namespace App\Http\Controllers\University;

use App\Models\DX\Collect;
use App\Models\DX\Comment;
use App\Models\DX\Discussion;
use App\Models\DX\Praise;
use App\Models\DX\Reply;
use App\Models\User;
use App\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:university',['except'=>['index','discussionPoster','commentPoster','detail','commentDetail','checkAuth']]);
    }

    //议题列表
    public function index(){
        $discussion = Discussion::orderBy('time','desc')->get();
        foreach ($discussion as $disc){
            $disc->count = Comment::where('discussion_id',$disc->id)->count();
        }
//        dd($disc);
        return view('University.Discussion.index',compact('discussion'));
    }

    //评论议题
    public function content($id){
        $discussion = Discussion::find($id);
        $user = Auth::user();
//        dd($id);
        return view('University.Discussion.content',compact('discussion','user'));
    }

    //海报
    public function discussionPoster($did){
        $data['discussion'] = Discussion::find($did);
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            $data['web'] = 1;
            $data['signPackage'] = Helper::getJSSDK();
        }else{
            $data['web'] = 0;
        }
        return view('University.Discussion.discussionPoster',compact('data'));
    }

    //评论海报
    public function commentPoster($cid){
        $comment = Comment::find($cid);
        $c_user = User::find($comment->user_id);
        $comment->user = $c_user->nickname;
        $comment->time = Helper::getDifferenceTime($comment->created_at);
        $discussion = Discussion::find($comment->discussion_id);

        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            $data['web'] = 1;
            $data['signPackage'] = Helper::getJSSDK();
        }else{
            $data['web'] = 0;
        }
        return view('University.Discussion.commentPoster',compact('comment','discussion','data'));
    }

    //添加评论
    public function putContent(Request $request){
        //判断内容后给状态 先默认给1;
        $response = detection($request->content);
//        dd($response);
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
                            foreach($sceneResult->details as $detail){
//                            dd($detail->contexts);
                                foreach ($detail->contexts as $context){
                                    $content = $context->context;
                                }
                            }
                            return response(['code'=> '001','msg' => '评论涉嫌非法言论','content' => $content]);
                        }else{
                            $data['content'] = $request->content;
                            $data['discussion_id'] = $request->did;
                            $data['user_id'] = $request->uid;
                            $data['status'] = 1;
                        }
                    }
                }else{
                    return response(['code' => '004','msg' => "task process fail:" . $response->code]);
//                    print_r("task process fail:" + $response->code);
                }
            }
        }else{
            return response(['code' => '004','msg' => "detect not success. code:" . $response->code]);
//            print_r("detect not success. code:" + $response->code);
        }
        if (Comment::create($data)){
            return response(['code'=>'002','msg'=>'评论成功']);
        }else{
            return response(['code'=>'003','msg'=>'评论失败，稍后重试！']);
        }
    }

    //详情
    public function detail($id){
        $discussion = Discussion::find($id);
        $comment = Comment::where('discussion_id',$id)->orderBy('created_at','desc')->get();
        foreach($comment as $v){
            $v->time = Helper::getDifferenceTime($v->created_at);
            if (Auth::guard('university')->check()){
                $login = Auth::guard('university')->user();
                $collect = Collect::where('user_id',$login->id)->where('by_collect_id',$v->id)->where('type',2)->first();
                if ($collect){
                    $v->coll_status = $collect->status;
                }else{
                    $v->coll_status = 0;
                }
                $praise = Praise::where('user_id',$login->id)->where('by_praise_id',$v->id)->where('type',1)->first();
                if ($praise){
                    $v->prai_status = $praise->status;
                }else{
                    $v->prai_status = 0;
                }
            }
            $user = User::find($v->user_id);
            if ($user){
                $v->user_name = $user->nickname;
                $v->user_pic = $user->head_pic;
            }else{
                $v->user_name = '该账户已注销';
                $v->user_pic = 'https://www.ijiabin.com/Home/images/wyjb_logo.png';
            }
            //议题回复
            $reply = Reply::where('type',0)->where('relevance_id',$v->id)->orderBy('created_at','desc')->get()->toArray();
            $replys = $this->recursionReply($reply);
            $v->count = count($replys);
            $info = array();
            foreach ($replys as $k=>&$rv){
                if ($k>=3){
                    break;
                }
                $r_user =User::find($rv['user_id']);
                if ($r_user){
                    $rv['user_name'] = $r_user->nickname;
                }else{
                    $rv['user_name'] = '该账户已注销';
                }
                if ($rv['type'] ==1){
                    $s_user = User::find($rv['replyId']);
                    if ($s_user){
                        $rv['s_user_name'] = $s_user->nickname;
                    }else{
                        $rv['s_user_name'] = '该账户已注销';
                    }
                }
                $info[] = $rv;
            }
            $v->reply = $info;
        }
        return view('University.Discussion.detail',compact('discussion','comment'));
    }

    //回复评论
    public function reply($cid,$type){
        if ($type == 1){
            $reply = Reply::find($cid);
            $rep_user = User::find($reply->user_id);
        }else{
            $comment = Comment::find($cid);
            $rep_user = User::find($comment->user_id);
        }
        if ($rep_user){
            $comment['user'] = $rep_user->nickname;
        }else{
            $comment['user'] = '该账户已注销';
        }
        $comment['id'] =$cid;
        $user = Auth::user();
//        dd($comment);

        return view('University.Discussion.reply',compact('user','comment','type'));
    }

    //添加回复
    public function putReply(Request $request){
        //判断内容后给状态 先默认给1;
        $response = detection($request->content);
//        dd($response);
        if(200 == $response->code){
            $taskResults = $response->data;
            foreach ($taskResults as $taskResult) {
                if(200 == $taskResult->code){
                    $sceneResults = $taskResult->results;
                    foreach ($sceneResults as $sceneResult) {
                        $scene = $sceneResult->scene;
                        $suggestion = $sceneResult->suggestion;
//                        dd($sceneResult->details);
                        //根据scene和suggetion做相关处理
                        if ($suggestion == 'block'){
                            //获取非法字段
                            foreach($sceneResult->details as $detail){
//                            dd($detail->contexts);
                                foreach ($detail->contexts as $context){
                                    $content = $context->context;
                                }
                            }
                            return response(['code'=> '001','msg' => '评论涉嫌非法言论','content' => $content]);
                        }else{
                            $data['content'] = $request->content;
                            $data['relevance_id'] = $request->cid;
                            $data['user_id'] = $request->uid;
                            $data['status'] = 1;
                            $data['type'] = $request->r_type;
                        }
                    }
                }else{
                    return response(['code' => '004','msg' => "task process fail:" . $response->code]);
//                    print_r("task process fail:" + $response->code);
                }
            }
        }else{
            return response(['code' => '004','msg' => "detect not success. code:" . $response->code]);
//            print_r("detect not success. code:" + $response->code);
        }
        if (Reply::create($data)){
            return response(['code'=>'002','msg'=>'评论成功']);
        }else{
            return response(['code'=>'003','msg'=>'评论失败，稍后重试！']);
        }
    }

    //删除回复
    public function delReply(Request $request){
//        dd($request->all());
        $reply = Reply::find($request->rid);
        if (!$reply){
            return response(['code'=>'001','msg'=>'该评论已被删除']);
        }
        if (Reply::destroy($request->rid)){
            return response(['code'=>'002','msg'=>'删除成功']);
        }else{
            return response(['code'=>'003','msg'=>'删除失败']);
        }
    }

    //评论详情
    public function commentDetail($id){
        $comment = Comment::find($id);
        if (Auth::guard('university')->check()){
            $login = Auth::guard('university')->user();
            $collect = Collect::where('user_id',$login->id)->where('by_collect_id',$comment->id)->where('type',2)->first();
            if ($collect){
                $comment->coll_status = $collect->status;
            }else{
                $comment->coll_status = 0;
            }
            $praise = Praise::where('user_id',$login->id)->where('by_praise_id',$comment->id)->where('type',1)->first();
            if ($praise){
                $comment->prai_status = $praise->status;
            }else{
                $comment->prai_status = 0;
            }
        }
        $comment->time = Helper::getDifferenceTime($comment->created_at);
        $user = User::find($comment->user_id);
        if ($user){
            $comment->user_name = $user->nickname;
            $comment->user_pic = $user->head_pic;
        }else{
            $comment->user_name = '该账户已注销';
            $comment->user_pic = 'https://www.ijiabin.com/Home/images/wyjb_logo.png';
        }
        $reply = Reply::where('type',0)->where('relevance_id',$comment->id)->orderBy('created_at','desc')->get()->toArray();
        $replys = $this->recursionReply($reply);
        foreach ($replys as &$v){
            $r_user =User::find($v['user_id']);
            if ($r_user){
                $v['user_name'] = $r_user->nickname;
                $v['user_pic'] = $r_user->head_pic;
            }else{
                $v['user_name'] = '该账户已注销';
                $v['user_pic'] = 'https://www.ijiabin.com/Home/images/wyjb_logo.png';
            }
            if ($v['type'] ==1){
                $s_user = User::find($v['replyId']);
                if ($s_user){
                    $v['s_user_name'] = $s_user->nickname;
                }else{
                    $v['s_user_name'] = '该账户已注销';
                }
            }
        }
//        dd($replys);
        $comment->reply = $replys;
        $discussion = Discussion::find($comment->discussion_id);
        $discussion->time = Helper::getDifferenceTime($discussion->created_at);
        $discussion->count = Comment::where('discussion_id',$discussion->id)->count();
//        dd($comment);
        return view('University.Discussion.commentDetail',compact('comment','discussion'));
    }

    //评论收藏
    public function collect(Request $request){
        $user = Auth::guard('university')->user();
        if (!$user){
            return response(['code'=>'001','msg'=>'尚未登陆']);
        }
        //判断是否有收藏过
        $collect = Collect::where('user_id',$user->id)->where('by_collect_id',$request->cid)->where('type',2)->first();

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
            $data['type'] = 2;
            $data['status'] = 1;
            if (Collect::create($data)){
                return response(['code'=>'002','msg'=>'操作成功']);
            }else{
                return response(['code'=>'003','msg'=>'操作失败，稍后重试！']);
            }
        }
    }

    //点赞
    public function praise(Request $request){
        $user = Auth::guard('university')->user();
        if (!$user){
            return response(['code'=>'001','msg'=>'尚未登陆']);
        }
        //查看该评论下有多少赞
        $comment = Comment::find($request->cid);
        if ($request->status ==1){
            $praise_num = $comment->praise + 1;
        }else{
            $praise_num = $comment->praise - 1 >= 0 ? $comment->praise - 1 : 0 ;
        }
//        dd($praise_num);
        //判断是否有点赞
        $praise = Praise::where('user_id',$user->id)->where('by_praise_id',$request->cid)->where('type',1)->first();
        if ($praise){
            if ($praise->update(['status'=>$request->status]) && $comment->update(['praise'=>$praise_num])){
                return response(['code'=>'002','msg'=>'操作成功','praise'=>$praise_num,'status'=>$request->status]);
            }else{
                return response(['code'=>'003','msg'=>'操作失败，稍后重试！']);
            }
        }else{
            $data['user_id'] = $user->id;
            $data['by_praise_id'] = $request->cid;
            $data['type'] = 1;
            $data['status'] = 1;
            if (Praise::create($data)){
                return response(['code'=>'002','msg'=>'操作成功']);
            }else{
                return response(['code'=>'003','msg'=>'操作失败，稍后重试！']);
            }
        }
    }

    /**
     *递归获取回复
     */
    protected function recursionReply($array,$parent=0){
        static $reply = array();
        foreach ($array as &$v){
            if ($v['type'] ==1){
                $v['replyId'] = $parent;
            }
            $reply[] = $v;
            $result = Reply::Where('type',1)->where('relevance_id',$v['id'])->orderBy('created_at','desc')->get()->toArray();
            if ($result){
//                $v['son'] = $result;
                $this->recursionReply($result,$v['user_id']);
            }
        }
        return $reply;
    }
}
