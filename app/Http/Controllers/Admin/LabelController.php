<?php

namespace App\Http\Controllers\Admin;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabelController extends Controller
{
    //首页
    public function index(){
        $list = Label::all();
        return view('Admin.Label.index',compact('list',$list));
    }

    //展示(单条)
    public function show($id){

    }

    //添加
    public function create(){

    }

    //执行添加
    public function store(Request $request){
        $credentials = $this->validate($request,['name'=>'required|unique:labels']);
        if (Label::create($credentials)){
            return redirect('admin/label')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit(){

    }

    //执行修改
    public function update(Request $request,$id){
        $credentials = $this->validate($request,['name'=>'required|unique:labels,name,'.$id]);
        if (Label::find($id)->update($credentials)){
            return redirect('admin/label')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        if (Label::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
