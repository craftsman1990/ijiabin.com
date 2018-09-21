<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //列表
    public function index(){
        $list = Admin::paginate(20);
        return view('Admin.Admin.index',compact('list',$list));
    }

    //添加
    public function create(){
        return view('Admin.Admin.create');
    }

    //执行添加
    public function store(Request $request){
        $verif = array('username'=>'required|unique:admin',
            'password'=>'required',
            'password_confirmation'=>'required',
            'mobile'=>'required|numeric|unique:admin',
            'email'=>'required|unique:admin',
            'nickname'=>'required',
            'admin_pic'=>'required');
        $credentials = $this->validate($request,$verif);
        unset($credentials['password_confirmation']);
        $credentials['password'] = md5($credentials['password']);
        //上传头像
        $admin_pic = Upload::baseUpload($credentials['admin_pic'],'upload/Admin');
        if ($admin_pic){
            $credentials['admin_pic'] = $admin_pic;
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        if (Admin::create($credentials)){
            return redirect('admin/admin')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }

    }

    //修改
    public function edit($id){
        $admin = Admin::find($id)->toArray();
        return view('Admin.Admin.edit',compact('admin',$admin));
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('username'=>'required|unique:admin,username,'.$id,
            'mobile'=>'required|numeric|unique:admin,mobile,'.$id,
            'email'=>'required|unique:admin,email,'.$id,
            'nickname'=>'required');
        $credentials = $this->validate($request,$verif);
        //密码验证
        if ($request->get('newpwd')){
            if ($request->get('newpwd') == $request->get('newpwd_confirmation')){
                $credentials['password'] = md5($request->get('newpwd'));
            }else{
                return back() -> with('hint',config('hint.password_two'));
            }
        }
        //图像上传
        if ($request->get('admin_pic')){
            $admin_pic = Upload::baseUpload($request->get('admin_pic'),'upload/Admin');
            if ($admin_pic){
                $credentials['admin_pic'] = $admin_pic;
                @unlink(public_path($request->get('admin_old_pic')));
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['admin_pic'] = $request->get('admin_old_pic');
        }
        if(Admin::find($id)->update($credentials)){
            return redirect('admin/admin')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $adminObj = Admin::find($id);
        if (!$adminObj){
            return back() -> with('hint',config('hint.data_exist'));
        }
        $admin = $adminObj->toArray();
        if (Admin::destroy($id)){
            unlink(public_path($admin['admin_pic']));
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
