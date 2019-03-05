<?php

namespace App\Http\Controllers\University;

use App\Http\Resources\view;
use App\Models\Advertising;
use App\Models\DX\Comment;
use App\Models\DX\Course;
use App\Models\DX\Discussion;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //首页
    public function index(){
        $adver = Advertising::getAdver(8,3);
        $discussion = Discussion::orderBy('created_at','desc')->first();
        $comment = Comment::where('discussion_id',$discussion->id)->first();
        if ($comment){
            $user = User::find($comment->user_id);
            $comment->user_name = $user->nickname;
            $comment->user_pic = $user->head_pic;
        }
        $course['boutique'] = Course::getIfy(2,3);
        $course['business'] = Course::getIfy(3,3);
//        dd($adver);
        return view('University.Index.index',compact('adver','discussion','course','comment'));
    }

    //嘉宾派
    public function jbp(){

        return view('University.Index.jbp');
    }

    //嘉宾派报名提交
    public function jbp_apply(Request $request){
        if($request->all()){
            dd($request->all());
        }
        return view('University.Index.gbp_apply');
    }

    //国际课程
    public function gjkc(){

        return view('University.Index.gjkc');
    }

    //国际课程报名
    public function gjkc_apply(Request $request){

        return view('Uninversity.Index.gjkc_apply');
    }

    //课程列表
    public function courseCategory($cgid){
        $courses = Course::getIfy(1,10);
//        dd($course);
        return view('University.Index.courseCategory',compact('courses'));
    }
}
