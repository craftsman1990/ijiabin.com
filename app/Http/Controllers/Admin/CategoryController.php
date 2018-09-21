<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //首页
    public function index(){
        $list = Category::paginate(20);
        return view('Admin.Category.index',compact('list',$list));
    }

    //展示(单条)
    public function show(){

        return view('Admin.Category.show');
    }

    //添加
    public function create(){

        return view('Admin.Category.create');
    }

    //执行添加
    public function store(Request $request){
        $verif = array('cg_name'=>'required|unique:category',
            'sort'=>'required|numeric',
            'status'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if (Category::create($credentials)){
            return redirect('admin/category')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit(){

        return view('Admin.Category.edit');
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('cg_name'=>'required|unique:category,cg_name,'.$id,
            'sort'=>'required|numeric',
            'status'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if(Category::find($id)->update($credentials)){
            return redirect('admin/category')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        if (Category::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
