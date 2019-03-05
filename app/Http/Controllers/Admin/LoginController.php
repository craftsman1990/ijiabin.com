<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2019/1/8
 * Time: 17:57
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

class LoginController extends Controller
{
    /*
 |--------------------------------------------------------------------------
 | Login Controller
 |--------------------------------------------------------------------------
 |
 | This controller handles authenticating users for the application and
 | redirecting them to your home screen. The controller uses a trait
 | to conveniently provide its functionality to your applications.
 |
 */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin',['except' =>['logout','store','showLoginForm']]);
    }
    /**
     * 重写登陆页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('Admin.Index.login');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,['username'=>'required','password'=>'required']);
        if (Auth::guard('admin')->attempt($credentials)){
            return Redirect::to('admin/index')->with('success',config('hint.welcome'));
        }else{
            return back() -> with('hint',config('hint.error'));
        }

    }
    /**
     * 重写退出方法
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
//        $this->guard()->logout();
//        $request->session()->flush();
//        $request->session()->regenerate();
//        return redirect('/admin/login');
//        dd(123);
        Auth::guard('admin')->logout();
//        dd($res);
        return Redirect::to('admin/login')->with('success',config('hint.back'));
    }
    /**
     * 重写guard认证
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}