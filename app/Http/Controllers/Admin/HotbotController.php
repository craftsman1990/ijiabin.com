<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotbot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotbotController extends Controller
{
    //首页
    public function index(){
        $list = Hotbot::all();
        return view('Admin.Hotbot.index',compact('list',$list));
    }

    //展示(单条)
    public function show(){

    }

    //添加
    public function create(){

    }

    //执行添加
    public function store(Request $request){
        $credentials = $this->validate($request,['name'=>'required|unique:hotbot']);
        if (Hotbot::create($credentials)){
            return back()->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit(){

    }

    //执行修改
    public function update(Request $request,$id){
        $credentials = $this->validate($request,['name'=>'required|unique:hotbot,name,'.$id]);
        if (Hotbot::find($id)->update($credentials)){
            return back()->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        if (Hotbot::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
