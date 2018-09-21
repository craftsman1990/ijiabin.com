<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use App\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    //首页
    public function index(){
        $all = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $list['arr'] = Helper::_tree($all);
        $list['json'] = json_encode(Helper::_tree_json($all));
        return view('Admin.Navigation.index',compact('list',$list));
    }

    //展示(单条)
    public function show(){

    }

    //添加
    public function create(){

    }

    //执行添加
    public function store(Request $request){
        $verif = array('n_name'=>'required',
            'sort'=>'required|numeric',
            'parent_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if (Navigation::create($credentials)){
            return redirect('admin/navigation')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit(){

    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('n_name'=>'required',
            'sort'=>'required|numeric',
            'parent_id'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if(Navigation::find($id)->update($credentials)){
            return redirect('admin/navigation')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $nav = Navigation::where('parent_id',$id)->get()->toArray();
        if($nav){
            return back() -> with('hint',config('hint.del_failure_exist'));
        }
        if (Navigation::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
