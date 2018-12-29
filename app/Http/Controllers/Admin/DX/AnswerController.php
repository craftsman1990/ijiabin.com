<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\QuizAnswer;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//自测题答案
class AnswerController extends Controller
{

    //执行添加/修改
    public function store(Request $request){
        $verif = array('card'=> new Uppercase,
            'answer'=> new Uppercase,
            'CRUD'=>'required|numeric',
            'quiz_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        if ($credentials['CRUD'] == 1){
            //批量删除原有答案
            QuizAnswer::where('quiz_id',$credentials['quiz_id'])->delete();
        }
        //添加
        $len = count($credentials['card']);
        $num = 0;
        for ($i=0;$i<$len;$i++){
            $arr['card'] = $credentials['card'][$i];
            $arr['answer'] = $credentials['answer'][$i];
            $arr['quiz_id'] = $credentials['quiz_id'];
            if (QuizAnswer::create($arr)){
                $num++;
            }
        }
        return back()->with('success','操作'.$num.'条答案成功！');
    }

    //ajax请求
    public function getAnswer(Request $request){
        $answer = QuizAnswer::where('quiz_id',$request->qid)->get()->toArray();
        return response($answer);
    }
}
