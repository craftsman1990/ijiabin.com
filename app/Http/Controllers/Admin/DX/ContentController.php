<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Content;
use App\Models\DX\Quiz;
use App\Models\DX\QuizAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function index(){

    }

    public function show($id){
        $content = Content::find($id);
        $list = Quiz::where('content_id',$id)->get();
        foreach ($list as $quiz){
            $quiz->allAnswer = QuizAnswer::where('quiz_id',$quiz->id)->get();
        }
//        dd($list);
        return view('Admin.DX.Course.contentShow',compact('list','content'));
    }

    public function create(Request $request){
//        dd($request->course_id);
        return view('Admin.DX.Course.contentCreate',compact('request'));
    }

    //执行添加
    public function store(Request $request){
        $verif = [
            'chapter'=>'required|numeric|min:1',
            'type'=>'required|numeric',
            'title'=>'required|max:30',
            'intro'=>'required|max:255',
            'video'=>'required|max:255',
            'audio'=>'required|max:255',
            'time'=>'required|max:10',
            'content'=>'required',
            'course_id'=>'required|numeric'
        ];
        $message =[
            'chapter.required' => '章节编号 不能为空',
            'chapter.numeric' => '章节编号 必须是数字',
            'chapter.min' => '章节编号 必须大于或等于1',
            'type.required' => '属性 不能为空',
            'type.numeric' => '属性 必须是数字',
            'title.required' => '章节标题 不能为空',
            'title.max' => '章节标题 不能超过30个字符',
            'intro.required' => '章节简介 不能为空',
            'intro.max' => '章节简介 不能超过255个字符',
            'video.required' => '视频地址 不能为空',
            'video.max' => '视频地址 不能超过255个字符',
            'audio.required' => '音频地址 不能为空',
            'audio.max' => '音频地址 不能超过255个字符',
            'time.required' => '章节时长 不能为空',
            'time.max' => '章节时长 不能超过10个字符',
            'content.required' => '章节内容 不能为空',
            'course_id.required' => '课程ID 不能为空',
        ];
        $credentials = $this->validate($request,$verif,$message);
//        dd($credentials);
        if (Content::create($credentials)){
            return redirect('admin/jbdx/course/'.$credentials['course_id'])->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id){
        $content = Content::find($id);
        return view('Admin.DX.Course.contentEdit',compact('content'));
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = [
            'chapter'=>'required|numeric|min:1',
            'type'=>'required|numeric',
            'title'=>'required|max:30',
            'intro'=>'required|max:255',
            'video'=>'required|max:255',
            'audio'=>'required|max:255',
            'time'=>'required|max:10',
            'content'=>'required',
            'course_id'=>'required|numeric'
        ];
        $message =[
            'chapter.required' => '章节编号 不能为空',
            'chapter.numeric' => '章节编号 必须是数字',
            'chapter.min' => '章节编号 必须大于或等于1',
            'type.required' => '属性 不能为空',
            'type.numeric' => '属性 必须是数字',
            'title.required' => '章节标题 不能为空',
            'title.max' => '章节标题 不能超过30个字符',
            'intro.required' => '章节简介 不能为空',
            'intro.max' => '章节简介 不能超过255个字符',
            'video.required' => '视频地址 不能为空',
            'video.max' => '视频地址 不能超过255个字符',
            'audio.required' => '音频地址 不能为空',
            'audio.max' => '音频地址 不能超过255个字符',
            'time.required' => '章节时长 不能为空',
            'time.max' => '章节时长 不能超过10个字符',
            'content.required' => '章节内容 不能为空',
            'course_id.required' => '课程ID 不能为空',
        ];
        $credentials = $this->validate($request,$verif,$message);
//        dd($credentials);
        if (Content::find($id)->update($credentials)){
            return redirect('admin/jbdx/course/'.$credentials['course_id'])->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $Content = Content::find($id);
        if (!$Content){
            return back() -> with('hint',config('hint.data_exist'));
        }
        $quiz = Quiz::where('content_id',$id)->get()->toArray();
        if ($quiz){
            return back()->with('hint',config('hint.del_failure_exist'));
        }
        if (Content::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
