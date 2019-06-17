<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recommend;

class RecommendController extends Controller
{

    public function __construct()
    {
    }

    /**
     * 列表
     **/
    public function index()
    {
        $list = Recommend::paginate(20);

        return view('Admin.Recommend.index',compact('list',$list));
    }

    /**
     * 添加
     **/
    public function create()
    {
    }

    /**
     * 执行添加
     **/
    public function store(Request $request){

        $verif = array(
            'title'=>'required|unique:dx_recommend',
            'rank'=>'required|numeric',
            'status'=>'required|numeric');
        $credentials = $this->validate($request,$verif);

        if (Recommend::create($credentials)){
            return redirect('admin/recommend')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    /**
     * 详情
     **/
    public function show()
    {
    }
    /**
     * 修改
     **/
    public function edit()
    {
    }

    /**
     * 执行修改
     **/
    public function update(Request $request,$id)
    {
        $verif = array(
            'title'=>'required|unique:dx_recommend,title,'.$id,
            'rank'=>'required|numeric',
            'status'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if(Recommend::find($id)->update($credentials)){
            return redirect('admin/recommend')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    /**
     * 执行删除
     **/
    public function destroy($id)
    {
        if (Recommend::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }


}
