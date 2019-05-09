<?php

namespace App\Http\Controllers\Admin\DX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Comment;
use App\Models\DX\Content;
use App\Models\User;

class CommentController extends Controller
{
    //首页
    public function index()
    {

    }

    //详情
    public function show(Request $request,$id)
    {
        $verif = [
            'type' => 'required|numeric',
        ];
        $message = [
            'type' => 'type属性 不能为空',
        ];
        $credentials = $this->validate($request,$verif,$message);

        $list = Comment::where(['discussion_id'=>$id,'type'=>$credentials['type']])->paginate(20);

        foreach ($list as $v){
            $user = User::where(['id'=>$v->user_id,'status'=>1])->first();
//            dd($user);
            if ($user){
                $v->user_name = $user->nickname;
            }else{
                $v->user_name = '该用户已经注销';
            }
        }

        return view('Admin.DX.Course.commentShow',compact('list'));


    }

    //新增
    public function create()
    {

    }

    //执行新增
    public function store()
    {

    }

    //修改
    public function edit()
    {

    }

    //执行修改
    public function update(Request $request,$id)
    {
        $verif = [
            'status' => 'required|numeric',
        ];
        $message = [
            'status' => '要修改的状态 不能为空',
        ];
        $credentials = $this->validate($request,$verif,$message);

        $credentials['status'] = $request['status']==0?1:0;


        $comment = Comment::find($id);
       // dd($comment);

        if (Comment::find($id)->update($credentials)){
            return redirect("admin/jbdx/comment/".$comment['discussion_id']."?type=".$comment['type'])->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id)
    {

    }

}
