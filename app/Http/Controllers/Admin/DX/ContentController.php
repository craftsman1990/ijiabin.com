<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Content;
use App\Models\DX\Quiz;
use App\Models\DX\QuizAnswer;
use Illuminate\Http\Request;
use App\Services\Upload;
use App\Http\Controllers\Controller;
use App\Services\Compress;
use App\Models\DX\Course;


class ContentController extends Controller
{

    public function index(){

    }

    public function show($id){

        $content = Content::find($id);
        $list = Quiz::where('content_id',$id)->get();
        foreach ($list as $quiz){
            $quiz->allAnswer = QuizAnswer::where('quiz_id',$quiz->id)->get();
        }

        return view('Admin.DX.Course.contentShow',compact('list','content'));
    }

    public function create(Request $request){
//        dd($request->course_id);
        return view('Admin.DX.Course.contentCreate',compact('request'));
    }

    //执行添加
    public function store(Request $request){
        //判断是否上架
        $verif = [
            'chapter'=>'required|numeric|min:1',
            'type'=>'required|numeric',
            'title'=>'required|max:30',
            'intro'=>'required|max:255',
            'status'=>'required',
            'course_id'=>'required|numeric',
            'cover'=>'required'
        ];
        $message =[
            'chapter.required' => '章节编号 不能为空',
            'chapter.numeric' => '章节编号 必须是数字',
            'chapter.min' => '章节编号 必须大于或等于1',
            'type.required' => '属性 不能为空',
            'type.numeric' => '属性 必须是数字',
            'title.required' => '章节标题 不能为空',
            'title.max' => '章节标题 不能超过30个字符',
            'intro.required' => '章节简介 不能为空',
            'intro.max' => '章节简介 不能超过255个字符',
            'status.required' => '是否上架  不能为空',
            'course_id.required' => '课程ID 不能为空',
            'cover.required'=>'封面图 不能为空',
        ];

        $diff_v = [
            "label" => "max:30",
            "video" => "required|max:255",
            "audio" => "required|max:255",
            "time" => "required|numeric|min:1",
            "content" => "required"
        ];
        $diff_m = [
            "label.max" => "章节标签 不能超过30个字符",
            "video.required" => "视频地址 不能为空",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.required" => "音频地址 不能为空",
            "audio.max" => "音频地址 不能超过255个字符",
            "time.required" => "章节时长 不能为空",
            "time.numeric" => "章节时长 必须是数字",
            "time.min" => "章节时长 最小值必须大于1s",
            "content.required" => "章节内容 不能为空"
        ];

        //判断是否上架
        if ($request->status == 1){
            $verif = array_merge($verif,$diff_v);
            $message = array_merge($message,$diff_m);
            if ($request->try_time !== null){
                $verif['try_time'] = 'numeric|max:'.$request->time;
                $message['try_time.numeric'] = '章节试看时长 必须是数字';
                $message['try_time.max'] =  '章节试看时长 不能超过'.$request->time;
            }
        }

        $credentials = $this->validate($request,$verif,$message);

//        dd($credentials);
        //横图
        $cor_size = $credentials['cover']->getSize() / 1024;
        if ($cor_size < 100){
            $cor_per = 1;
        }else{
            $cor_per = 0.4;
        }
        $cro_path = Upload::uploadOne('Content',$credentials['cover']);
        if ($cro_path){
            $credentials['cover'] = $cro_path;
            //创建缩略图
            $Compress = new Compress(public_path($credentials['cover']),$cor_per);
            $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }

//        dd($credentials);
        if (Content::create($credentials)){
            return redirect('admin/jbdx/course/'.$credentials['course_id'])->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id){
        $content = Content::find($id);
        return view('Admin.DX.Course.contentEdit',compact('content'));
    }

    //执行修改
    public function update(Request $request,$id){
        //判断是否上架
        $verif = [
            'chapter'=>'required|numeric|min:1',
            'type'=>'required|numeric',
            'title'=>'required|max:30',
            'intro'=>'required|max:255',
            'status'=>'required',
            'course_id'=>'required|numeric',
        ];
        $message =[
            'chapter.required' => '章节编号 不能为空',
            'chapter.numeric' => '章节编号 必须是数字',
            'chapter.min' => '章节编号 必须大于或等于1',
            'type.required' => '属性 不能为空',
            'type.numeric' => '属性 必须是数字',
            'title.required' => '章节标题 不能为空',
            'title.max' => '章节标题 不能超过30个字符',
            'intro.required' => '章节简介 不能为空',
            'intro.max' => '章节简介 不能超过255个字符',
            'status.required' => '是否上架  不能为空',
            'course_id.required' => '课程ID 不能为空',
        ];

        $diff_v = [
            "label" => "max:30",
            "video" => "required|max:255",
            "audio" => "required|max:255",
            "time" => "required|numeric|min:1",
            "content" => "required"
        ];
        $diff_m = [
            "label.max" => "章节标签 不能超过30个字符",
            "video.required" => "视频地址 不能为空",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.required" => "音频地址 不能为空",
            "audio.max" => "音频地址 不能超过255个字符",
            "time.required" => "章节时长 不能为空",
            "time.numeric" => "章节时长 必须是数字",
            "time.min" => "章节时长 最小值必须大于1s",
            "content.required" => "章节内容 不能为空"
        ];

        //判断是否上架
        if ($request->status == 1){
            $verif = array_merge($verif,$diff_v);
            $message = array_merge($message,$diff_m);
            if ($request->try_time !== null){
                $verif['try_time'] = 'numeric|max:'.$request->time;
                $message['try_time.numeric'] = '章节试看时长 必须是数字';
                $message['try_time.max'] =  '章节试看时长 不能超过'.$request->time;
            }
        }

        $credentials = $this->validate($request,$verif,$message);

        
        //横图
        if ($request->cover){
            $cor_size = $request->cover->getSize() / 1024;
            if ($cor_size < 100){
                $cor_per = 1;
            }else{
                $cor_per = 0.4;
            }
            $cro_path = Upload::uploadOne('Content',$request->cover);
            if ($cro_path){
                $credentials['cover'] = $cro_path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['cover']),$cor_per);
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
                if (is_file(public_path($request->old_cover))){
                    unlink(public_path($request->old_cover));
                    if (is_file(public_path(thumbnail($request->old_cover)))){
                        unlink(public_path(thumbnail($request->old_cover)));
                    }
                }
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            if($request->old_cover){
                $credentials['cover'] = $request->old_cover;
            }else{
                return back() -> with('hint','没有原图，也没有图片上传');
            }
        }
//        dd($credentials);
        unset($credentials['old_cover']);

        if (Content::find($id)->update($credentials)){
            return redirect('admin/jbdx/course/'.$credentials['course_id'])->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $Content = Content::find($id);
        if (!$Content){
            return back() -> with('hint',config('hint.data_exist'));
        }
        $quiz = Quiz::where('content_id',$id)->get()->toArray();
        if ($quiz){
            return back()->with('hint',config('hint.del_failure_exist'));
        }
        if (Content::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }

}
