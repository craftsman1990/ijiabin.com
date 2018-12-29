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
        $verif = array('chapter'=>'required',
            'type'=>'required|numeric',
            'title'=>'required',
            'intro'=>'required',
            'video'=>'required',
            'audio'=>'required',
            'time'=>'required',
            'content'=>'required',
            'course_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
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
        $verif = array('chapter'=>'required',
            'type'=>'required|numeric',
            'title'=>'required',
            'intro'=>'required',
            'video'=>'required',
            'audio'=>'required',
            'time'=>'required',
            'content'=>'required',
            'course_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
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
