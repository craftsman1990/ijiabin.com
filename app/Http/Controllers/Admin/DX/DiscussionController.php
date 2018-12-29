<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Comment;
use App\Models\DX\Discussion;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{

    public function index(){
        $list = Discussion::paginate(20);
        return view('Admin.DX.Discussion.index',compact('list'));
    }

    public function show($id){
        $list = Comment::where('discussion_id',$id)->paginate(20);
        foreach ($list as $v){
            $user = User::find($v->user_id);
//            dd($user);
            if ($user){
                $v->user_name = $user->nickname;
            }else{
                $v->user_name = '该用户已经注销';
            }
        }
//        dd($list);
        return view('Admin.DX.Discussion.show',compact('list'));
    }

    public function create(){
        return view('Admin.DX.Discussion.create');
    }

    public function store(Request $request){
        $verif = array('title'=>'required',
            'time'=>'required',
            'author'=>'required',
            'content'=>'required');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        if (Discussion::create($credentials)){
            return redirect('admin/jbdx/discussion')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    public function edit($id){
        $discussion = Discussion::find($id);
        return view('Admin.DX.Discussion.edit',compact('discussion'));
    }

    public function update(Request $request,$id){
        $verif = array('title'=>'required',
            'time'=>'required',
            'author'=>'required',
            'content'=>'required');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        if (Discussion::find($id)->update($credentials)){
            return redirect('admin/jbdx/discussion')->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    public function destroy($id){
        $discussion = Discussion::find($id);
        if (!$discussion){
            return back() -> with('hint',config('hint.data_exist'));
        }

        if (Discussion::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
