<?php

namespace App\Http\Controllers\Admin\DX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Notes;
use App\Models\DX\Content;

class NotesController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index()
    {
        dd('小节笔记首页');
    }

    public function show($content_id)
    {
        $content_id = 1;
        $where = array(
            'content_id'=>$content_id,
        );
        $list = Notes::where($where)
            ->leftJoin('users','dx_notes.user_id','=','users.id')
            ->select('dx_notes.*','users.nickname')->get();

        if (!empty($list)){
            foreach ($list as &$value){
                $value->content = mb_substr($value->content,0,20,'utf-8').'......';
            }
        }
        dd($list);

        $content = Content::find($content_id);
        $course_id = $content->course_id;

        return view('Admin.DX.Course.show',compact('list','course_id'));
    }
    //修改
    public function edit($id){
        $course = Course::find($id);
        return view('Admin.DX.Course.edit',compact('course'));
    }

    public function updateStatus(Request $request,$id)
    {
        $verif = array(
            'status'=>'required|numeric',
        );
        $credentials = $this->validate($request,$verif);

        if (Notes::find($id)->update($credentials)){
            return redirect('admin/notes/'.$request->content_id)->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }


    }
}
