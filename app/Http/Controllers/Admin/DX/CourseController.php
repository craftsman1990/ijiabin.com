<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Content;
use App\Models\DX\Course;
use App\Models\CourseSite;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Compress;

class CourseController extends Controller
{
    //首页
    public function index(){
        $list = Course::paginate(20);
//        dd($list);
        return view('Admin.DX.Course.index',compact('list'));
    }

    //展示(单条)
    public function show($id){
        $list = Content::where('course_id',$id)->get();
//        dd($content);

        return view('Admin.DX.Course.show',compact('list','id'));
    }

    //添加
    public function create(){
        return view('Admin.DX.Course.create');
    }

    //执行添加
    public function store(Request $request){
        $verif = array('name'=>'required',
            'teacher'=>'required',
            'professional'=>'required',
            'intro'=>'required',
            'ify'=>'required|numeric',
            'is_pay'=>'required|numeric',
            'looks'=>'required|numeric',
            'cover'=>'required');
        $credentials = $this->validate($request,$verif);
        $size = strlen(file_get_contents($request->cover))/1024;
        if ($size < 100){
            $percent = 1;
        }else{
            $percent = 0.4;
        }
        $pic_path = Upload::baseUpload($credentials['cover'],'upload/Course');
        if ($pic_path){
            $credentials['cover'] = $pic_path;
            //创建缩略图
            $Compress = new Compress(public_path($credentials['cover']),$percent);
            $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        if (Course::create($credentials)){
            return redirect('admin/jbdx/course')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id){
        $course = Course::find($id);
        return view('Admin.DX.Course.edit',compact('course'));
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('name'=>'required',
            'teacher'=>'required',
            'professional'=>'required',
            'intro'=>'required',
            'ify'=>'required|numeric',
            'is_pay'=>'required|numeric',
            'looks'=>'required|numeric',
            'old_cover'=>'required');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        if ($request->cover){
            $size = strlen(file_get_contents($request->cover))/1024;
            if ($size < 100){
                $percent = 1;
            }else{
                $percent = 0.4;
            }
            $pic_path = Upload::baseUpload($request->cover,'upload/Course');
            if ($pic_path){
                $credentials['cover'] = $pic_path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['cover']),$percent);
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
                if (is_file(public_path($request->old_cover))){
                    unlink(public_path($request->old_cover));
                }
                if (is_file(public_path(thumbnail($request->old_cover)))){
                    unlink(public_path(thumbnail($request->old_cover)));
                }
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['cover'] = $credentials['old_cover'];
        }
        unset($credentials['old_cover']);
        if (Course::find($id)->update($credentials)){
            return redirect('admin/jbdx/course')->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $Course = Course::find($id);
        if (!$Course){
            return back() -> with('hint',config('hint.data_exist'));
        }
        $content = Content::where('course_id',$Course->id)->get()->toArray();
        if ($content){
            return back()->with('hint',config('hint.del_failure_exist'));
        }else{
            if (Course::destroy($id)){
                if (is_file(public_path($Course->cover))){
                    unlink(public_path($Course->cover));
                }
                if (is_file(public_path(thumbnail($Course->cover)))){
                    unlink(public_path(thumbnail($Course->cover)));
                }
                return back() -> with('success',config('hint.del_success'));
            }else{
                return back() -> with('hint',config('hint.del_failure'));
            }
        }
    }
}
