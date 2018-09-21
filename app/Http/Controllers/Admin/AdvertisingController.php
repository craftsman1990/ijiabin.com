<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertising;
use App\Services\Helper;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisingController extends Controller
{

    //首页
    public function index(){
        $list = Advertising::paginate(20);
        return view('Admin.Advertising.index',compact('list',$list));
    }

    //展示(单条)
    public function show(){

    }

    //添加
    public function create(){

        return view('Admin.Advertising.create');
    }

    //执行添加
    public function store(Request $request){
        $verif = array('title'=>'',
//            'href'=>'required',
            'location'=>'required|numeric',
            'cover'=>'required');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        if ($credentials['location'] ==1){
            //1号位视频不为空
            if (!$request->post('video')){
                return back() -> with('hint',config('hint.video_exist'));
            }
            $credentials['video'] = Helper::checkVideoLocal($request->post('video'));
        }else{
            //其他位置链接不能为空
            if (!$request->post('href')){
                return back() -> with('hint',config('hint.href_exist'));
            }
            $credentials['href'] = $request->post('href');
        }
//        dd($credentials);
        $pic_path = Upload::uploadOne('Advertising',$credentials['cover']);
        if ($pic_path){
            $credentials['cover'] = $pic_path;
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        if (Advertising::create($credentials)){
            return redirect('admin/advertising')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id){
        $data = Advertising::find($id);
        return view('Admin.Advertising.edit',compact('data',$data));
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('title'=>'',
//            'href'=>'required',
            'location'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        //1号位视频不为空
        if ($credentials['location'] ==1){
            if (!$request->post('video')){
                return back() -> with('hint',config('hint.video_exist'));
            }
            $credentials['video'] = Helper::checkVideoLocal($request->post('video'));
        }else{
            //其他位置链接不能为空
            if (!$request->post('href')){
                return back() -> with('hint',config('hint.href_exist'));
            }
            $credentials['href'] = $request->post('href');
        }
        //图像上传
        if ($request->file('cover')){
            $pic_path = Upload::uploadOne('Advertising',$request->file('cover'));
            if ($pic_path){
                $credentials['cover'] = $pic_path;
                @unlink(public_path($request->get('old_cover')));
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['cover'] = $request->post('old_cover');
        }
        if(Advertising::find($id)->update($credentials)){
            return redirect('admin/advertising')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $Obj = Advertising::find($id);
        if (!$Obj){
            return back() -> with('hint',config('hint.data_exist'));
        }
        if (Advertising::destroy($id)){
            @unlink(public_path($Obj->cover));
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
