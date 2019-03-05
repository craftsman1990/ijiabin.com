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

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

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
            'price'=>'required|numeric',
            'crosswise_cover'=>'required',
            'lengthways_cover'=>'required');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        //横图
        $cor_size = $credentials['crosswise_cover']->getSize() / 1024;
        if ($cor_size < 100){
            $cor_per = 1;
        }else{
            $cor_per = 0.4;
        }
        $cro_path = Upload::uploadOne('Course',$credentials['crosswise_cover']);
        if ($cro_path){
            $credentials['crosswise_cover'] = $cro_path;
            //创建缩略图
            $Compress = new Compress(public_path($credentials['crosswise_cover']),$cor_per);
            $Compress->compressImg(public_path(thumbnail($credentials['crosswise_cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        //纵图
        $len_size = $credentials['lengthways_cover']->getSize() / 1024;
        if ($len_size < 100){
            $len_per = 1;
        }else{
            $len_per = 0.4;
        }
        $len_path = Upload::uploadOne('Course',$credentials['lengthways_cover']);
        if ($len_path){
            $credentials['lengthways_cover'] = $len_path;
            //创建缩略图
            $Compress = new Compress(public_path($credentials['lengthways_cover']),$len_per);
            $Compress->compressImg(public_path(thumbnail($credentials['lengthways_cover'])));
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
            'price'=>'required|numeric',
            'looks'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
//        dd($credentials);
        //横图
        if ($request->crosswise_cover){
            $cor_size = $request->crosswise_cover->getSize() / 1024;
            if ($cor_size < 100){
                $cor_per = 1;
            }else{
                $cor_per = 0.4;
            }
            $cro_path = Upload::uploadOne('Course',$request->crosswise_cover);
            if ($cro_path){
                $credentials['crosswise_cover'] = $cro_path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['crosswise_cover']),$cor_per);
                $Compress->compressImg(public_path(thumbnail($credentials['crosswise_cover'])));
                if (is_file(public_path($request->old_cro_cover))){
                    unlink(public_path($request->old_cro_cover));
                    if (is_file(public_path(thumbnail($request->old_cro_cover)))){
                        unlink(public_path(thumbnail($request->old_cro_cover)));
                    }
                }
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            if($request->old_cro_cover){
                $credentials['crosswise_cover'] = $request->old_cro_cover;
            }else{
                return back() -> with('hint','没有原图，也没有图片上传');
            }
        }
        //纵图
        if ($request->lengthways_cover){
            $len_size = $request->lengthways_cover->getSize() / 1024;
            if ($len_size < 100){
                $len_per = 1;
            }else{
                $len_per = 0.4;
            }
            $len_path = Upload::uploadOne('Course',$request->lengthways_cover);

            if ($len_path){
                $credentials['lengthways_cover'] = $len_path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['lengthways_cover']),$len_per);
                $Compress->compressImg(public_path(thumbnail($credentials['lengthways_cover'])));
                if (is_file(public_path($request->old_len_cover))){
                    unlink(public_path($request->old_len_cover));
                    if (is_file(public_path(thumbnail($request->old_len_cover)))){
                        unlink(public_path(thumbnail($request->old_len_cover)));
                    }
                }
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            if($request->old_cro_cover){
                $credentials['lengthways_cover'] = $request->old_len_cover;
            }else{
                return back() -> with('hint','没有原图，也没有图片上传');
            }
        }
//        dd($credentials);
        unset($credentials['old_cro_cover']);
        unset($credentials['old_len_cover']);
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
