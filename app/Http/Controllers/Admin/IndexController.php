<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //头部及左侧
    public function index(){

//        dd(123);
        $admin = Auth::guard('admin')->user();
        if (!$admin){
            return Redirect::to('admin/login');
        }
        return view('Admin.Index.index',compact('admin'));
    }

    //首页
    public function home(){

//        $nav = DB::table('hg_navigation')->insert(['parent_id'=>1,'n_name'=>'嘉宾大学']);
//        dd($nav);
        return view('Admin.Index.home');
    }

    //登陆
    /*public function login(){
        return view('Admin.Index.login');
    }*/

    //执行登陆
//    public function store(Request $request){
//
//        $credentials = $this->validate($request,['username'=>'required','password'=>'required']);
////        dd($credentials);
////        $res = ;
//        if (Auth::guard('admin')->attempt($credentials)){
////            dd();
////            return redirect()->intended(route('index.show',[Auth::guard('admin')->user()]))->with('success',config('hint.welcome'));
//            return Redirect::to('admin/index')->with('success',config('hint.welcome'));
//        }else{
//            return back() -> with('hint',config('hint.error'));
//        }
////        dd($res);
//        /*switch (Admin::confirm($credentials)){
//            case 1:
//                return back() -> with('hint',config('hint.account_null'));
//                break;
//            case 2:
//                return back()->with('hint', config('hint.password_error'));
//                break;
//            case 3:
//                return Redirect::to("admin/index");
//                break;
//        }*/
//
//    }

    // 退出
    public function loginOut(){
//        Session::forget('a_id');
//        Session::forget('a_name');
//        Session::forget('a_logo');
        dd(3212);
        Auth::logout();
        return Redirect::to('admin/login')->with('success',config('hint.back'));
    }
}
