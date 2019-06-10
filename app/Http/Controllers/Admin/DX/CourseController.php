<?php	
 namespace App\Http\Controllers\Admin\DX;	
 use App\Models\DX\Content;	
use App\Models\DX\Course;	
use App\Models\CourseSite;	
use App\Services\Upload;
 use Doctrine\DBAL\Driver\IBMDB2\DB2Driver;
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
        $verif = [	
            'name'=>'required|max:24',
            'teacher'=>'required|max:20',
            'professional'=>'required|max:50',
            'intro'=>'required',
            'ify'=>'required|numeric',	
            'is_pay'=>'required|numeric',	
            'looks'=>'required|numeric',	
            'content_nums'=>'required|numeric',
            'price'=>'required|numeric',
            'crosswise_cover'=>'required',	
            'lengthways_cover'=>'required'	
        ];	
        $message = [	
            'name.required'=>'课程名称 不能为空',	
            'name.max'=>'课程名称 不能超过24个字符',
            'teacher.required'=>'授课老师 不能为空',	
            'teacher.max'=>'授课老师 不能超过20个字符',
            'professional.required'=>'老师职称 不能为空',	
            'professional.max'=>'老师职称 不能超过50个字符',
            'intro.required'=>'简介 不能为空',
            'ify.required'=>'类别 未选择',
            'ify.numeric'=>'类别 类型错误',	
            'is_pay.required'=>'付费课 未选择',	
            'is_pay.numeric'=>'付费课 类型错误',	
            'looks.required'=>'观看次数 不能为空',	
            'content_nums.required'=>'课程内容总节数 不能为空',
            'looks.numeric'=>'观看次数 只能是数值',
            'content_nums.numeric'=>'课程内容总节数  只能是数值',
            'price.required'=>'价格 不能为空',
            'price.numeric'=>'价格 只能是数值',	
            'crosswise_cover.required'=>'横向封面图 不能为空',	
            'lengthways_cover.required'=>'纵向封面图 不能为空',	
        ];	
        $credentials = $this->validate($request,$verif,$message);	
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

        $credentials['created_at'] = $credentials['updated_at'] = date('Y-m-d H:i:s',time());

        $course_id = Course::insertGetId($credentials);

        if ($course_id){
            return redirect('admin/jbdx/course/'.$course_id)->with('success', config('hint.add_success'));
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
        $verif = [	
            'name'=>'required|max:24',
            'teacher'=>'required|max:20',
            'professional'=>'required|max:50',
            'intro'=>'required',
            'ify'=>'required|numeric',	
            'is_pay'=>'required|numeric',	
            'price'=>'required|numeric',	
            'looks'=>'required|numeric'];	
        $message = [	
            'name.required'=>'课程名称 不能为空',	
            'name.max'=>'课程名称 不能超过24个字符',
            'teacher.required'=>'授课老师 不能为空',	
            'teacher.max'=>'授课老师 不能超过20个字符',
            'professional.required'=>'老师职称 不能为空',	
            'professional.max'=>'老师职称 不能超过50个字符',
            'intro.required'=>'简介 不能为空',
            'ify.required'=>'类别 未选择',
            'ify.numeric'=>'类别 类型错误',	
            'is_pay.required'=>'付费课 未选择',	
            'is_pay.numeric'=>'付费课 类型错误',	
            'price.required'=>'价格 不能为空',	
            'price.numeric'=>'价格 只能是数值',	
            'looks.required'=>'观看次数 不能为空',	
            'looks.numeric'=>'观看次数 只能是数值',	
        ];	
        $credentials = $this->validate($request,$verif,$message);	
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
//                if (is_file(public_path($Course->cover))){
//                    unlink(public_path($Course->cover));
//                }
//                if (is_file(public_path(thumbnail($Course->cover)))){
//                    unlink(public_path(thumbnail($Course->cover)));
//                }
                //删除横向封面图片
                if (is_file(public_path($Course->crosswise_cover))){
                    unlink(public_path($Course->crosswise_cover));
                }
                //删除横纵向封面图片
                if (is_file(public_path(thumbnail($Course->lengthways_cover)))){
                    unlink(public_path(thumbnail($Course->lengthways_cover)));
                }
                return back() -> with('success',config('hint.del_success'));	
            }else{	
                return back() -> with('hint',config('hint.del_failure'));	
            }	
        }	
    }

    //改变状态 ，上架或下架
    public function updateStatus(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
       // dd($status);
        $status_new = $status == 1 ? 0:1;
        //dd($status_new);

        if (Course::find($id)->update(['status'=>$status_new])){
            return back()->with('success',config('jbdx.upper_lower_success'));
        }else{
            return back()->with('hint',config('jbdx.upper_lower_fail'));
        }

    }
}