<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //头部及左侧
    public function index(){
        if (!session('a_id')){
            return Redirect::to('admin/login');
        }
        return view('Admin.Index.index');
    }

    //首页
    public function home(){

//        $nav = DB::table('hg_navigation')->insert(['parent_id'=>1,'n_name'=>'嘉宾大学']);
//        dd($nav);
        return view('Admin.Index.home');
    }

    //登陆
    public function login(){
        return view('Admin.Index.login');
    }

    //执行登陆
    public function store(Request $request){

        $credentials = $this->validate($request,['username'=>'required','password'=>'required']);

        switch (Admin::confirm($credentials)){
            case 1:
                return back() -> with('hint',config('hint.account_null'));
                break;
            case 2:
                return back()->with('hint', config('hint.password_error'));
                break;
            case 3:
                return Redirect::to("admin/index");
                break;
        }

    }

    // 退出
    public function loginOut(){
        Session::forget('a_id');
        Session::forget('a_name');
        Session::forget('a_logo');
        return Redirect::to('admin/login');
    }
}
