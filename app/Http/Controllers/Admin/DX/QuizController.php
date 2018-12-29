<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Quiz;
use App\Models\DX\QuizAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//自测题
class QuizController extends Controller
{

    //执行添加
    public function store(Request $request){
        $verif = array('title'=>'required',
            'answer'=>'required',
            'analysis'=>'required',
            'content_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if (Quiz::create($credentials)){
            return back()->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('title'=>'required',
            'answer'=>'required',
            'analysis'=>'required',
            'content_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if (Quiz::find($id)->update($credentials)){
            return back()->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //执行删除
    public function destroy($id){
        $quiz = Quiz::find($id);
        if (!$quiz){
            return back() -> with('hint',config('hint.data_exist'));
        }
        $answer = QuizAnswer::where('quiz_id',$id)->get()->toArray();
        if ($answer){
            return back()->with('hint',config('hint.del_failure_exist'));
        }
        if (Quiz::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }

    //ajax请求
    public function getQuiz(Request $request){
        $quiz = Quiz::find($request->qid);
        return response($quiz);
    }
}
