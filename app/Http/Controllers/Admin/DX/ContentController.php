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
use App\Models\DX\ContentNumsLog;
use Illuminate\Support\Facades\DB;

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

    /**
     *课程内容章节数更新
     * @param object $course 需要更新的课程
     * @param int $status  设置的课程小节是否上架 0：未上架，1；上架
     * @param string $opation 操作动作
     **/

    private function updatedContentNumsLog(Course $course,$status,$opation = 'update')
    {
        $id = $course->id;

        $content_nums = $course->content_nums;
        $content_updates = $course->content_updates;

        $keys =  'Course_id:'.$id.';content_nums:'.$content_nums;

        $check_nums = ContentNumsLog::select('nums')->where('courseid_contentnums','=',$keys)->first();

        $jubge = true; $jubge_log = true;

//        $message = '';
        if ($check_nums){

            if ($opation == 'add'){
                //更新日志表中的更新数
                if ( $check_nums->nums == $content_nums && $jubge_log == true ){
                    $jubge_log = false;
//                  $message = '日志更新完成';
                }elseif ( $check_nums->nums < $content_nums ){
                    ContentNumsLog::where('courseid_contentnums','=',$keys)->update(['nums'=>$check_nums->nums+1]);
//                  $message = '日志添加记录';
                }else{
                    $jubge_log = false;
//                  $message = '超出了更新记录数，无法再更新！';
                }
            }


            //更新课程表中小节更新数
            if ( $status == 1 && $content_updates == $content_nums && $jubge == true){
                $jubge = false;
//                $message = '更新完毕';
            }else if ($status == 1 && $content_updates < $content_nums && $jubge == true ){
                $update = array(
                    'is_end' => ($content_updates+1 == $content_nums)?1:0,
                    'content_updates' =>$content_updates+1,
                    'updated_at' => date('Y-m-d H:i:s',time()),
                    'end_at' =>($content_updates+1 == $content_nums)?date('Y-m-d H:i:s',time()):$course->end_at
                );
                Course::find($id)->update($update);
//                $message = 'Course表中content_updates自动加1;'.$content_updates;
            }

           // $message = '更新记录表中已经有记录了，执行更新';
        }else {
            if ($opation == 'add'){
                ContentNumsLog::create(['courseid_contentnums'=>$keys,'nums'=>1]);
            }

            if ($status == 1){
                $update = [
                    'is_end'=>($content_updates == $content_nums-1)?1:0,
                    'content_updates'=>1,
                    'updated_at'=>date('Y-m-d H:i:s',time()),
                    'end_at'=>($content_updates == $content_nums-1)?date('Y-m-d H:i:s',time()):$course->end_at
                ];
                Course::find($id)->update($update);
                $jubge = ($content_updates == $content_nums-1)?false:true;
            }
//            $message = '没有记录需要添加数据记录!';
        }

        $res = array(
            'is_add' => $jubge_log,
            'is_update' =>$jubge,
//            'message' =>$message
        );
        return  $res;
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
            'title'=>'required|max:24',
            'intro'=>'required|max:105',
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
            'title.max' => '章节标题 不能超过24个字符',
            'intro.required' => '章节简介 不能为空',
            'intro.max' => '章节简介 不能超过105个字符',
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

        $diff_v_0 = [
            "label" => "max:20",
            "video" => "max:255",
            "audio" => "max:255",
        ];
        $diff_m_0 = [
            "label.max" => "章节标签 不能超过20个字符",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.max" => "音频地址 不能超过255个字符",
        ];

        if($request->time !== null){
            $diff_v_0['time'] = 'numeric|min:1';
            $diff_m_0['time.numeric'] = '章节时长 必须是数字';
            $diff_m_0['time.numeric'] = '章节时长 最小值必须大于1s';
        }

        //判断是否上架
        if ($request->status == 1){
            $verif = array_merge($verif,$diff_v);
            $message = array_merge($message,$diff_m);
        }else{
            $verif = array_merge($verif,$diff_v_0);
            $message = array_merge($message,$diff_m_0);
        }

        if ($request->try_time !== null){
            $verif['try_time'] = 'numeric|max:'.$request->time;
            $message['try_time.numeric'] = '章节试看时长 必须是数字';
            $message['try_time.max'] =  '章节试看时长 不能超过章节时长'.$request->time;
        }

        $credentials = $this->validate($request,$verif,$message);

        if ($request->try_time == null){
            $credentials['try_time'] =  0;
        }
        
        if ($request->status ==0){
            $credentials['content'] = $request->content;
        }

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

        //开启事务
        DB::beginTransaction();
//        dd($credentials);
        if (Content::create($credentials)){

            //更新课节数日志
            $Course = Course::find($request->course_id);
            $add_res = $this->updatedContentNumsLog($Course,$request->status,'add');
            if ($add_res['is_add'] == false) {
                //回滚
                return back()->with('hint', config('hint.add_contentNums_fail'));
            }else{
                //提交
                DB::commit();
                return redirect('admin/jbdx/course/'.$credentials['course_id'])->with('success', config('hint.add_success'));
            }
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
            'title'=>'required|max:24',
            'intro'=>'required|max:105',
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
            'title.max' => '章节标题 不能超过24个字符',
            'intro.required' => '章节简介 不能为空',
            'intro.max' => '章节简介 不能超过105个字符',
            'status.required' => '是否上架  不能为空',
            'course_id.required' => '课程ID 不能为空',
        ];

        $diff_v = [
            "label" => "max:20",
            "video" => "required|max:255",
            "audio" => "required|max:255",
            "time" => "required|numeric|min:1",
            "content" => "required"
        ];
        $diff_m = [
            "label.max" => "章节标签 不能超过20个字符",
            "video.required" => "视频地址 不能为空",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.required" => "音频地址 不能为空",
            "audio.max" => "音频地址 不能超过255个字符",
            "time.required" => "章节时长 不能为空",
            "time.numeric" => "章节时长 必须是数字",
            "time.min" => "章节时长 最小值必须大于1s",
            "content.required" => "章节内容 不能为空"
        ];

        $diff_v_0 = [
            "label" => "max:20",
            "video" => "max:255",
            "audio" => "max:255",
        ];
        $diff_m_0 = [
            "label.max" => "章节标签 不能超过20个字符",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.max" => "音频地址 不能超过255个字符",
        ];

        if($request->time !== null){
            $diff_v_0['time'] = 'numeric|min:1';
            $diff_m_0['time.numeric'] = '章节时长 必须是数字';
            $diff_m_0['time.numeric'] = '章节时长 最小值必须大于1s';
        }

        //判断是否上架
        if ($request->status == 1){
            $verif = array_merge($verif,$diff_v);
            $message = array_merge($message,$diff_m);
        }else{
            $verif = array_merge($verif,$diff_v_0);
            $message = array_merge($message,$diff_m_0);
        }

        if ($request->try_time !== null){
            $verif['try_time'] = 'numeric|max:'.$request->time;
            $message['try_time.numeric'] = '章节试看时长 必须是数字';
            $message['try_time.max'] =  '章节试看时长 不能超过章节时长:'.$request->time;
        }


        $credentials = $this->validate($request,$verif,$message);

        if ($request->try_time == null){
            $credentials['try_time'] =  0;
        }

        if ($request->status ==0){
            $credentials['content'] = $request->content;
        }
        
        //横图
        if ($request->cover){
            $cor_size = $request->cover->getSize() / 1024;
            if ($cor_size < 100){
                $cor_per = 1;
            }else{
                $cor_per = 0.4;
            }
            $cro_path = Upload::uploadOne('Content',$request->cover);
           // dd($cro_path);
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
       // dd($credentials);
        unset($credentials['old_cover']);
        $Content = Content::find($id);
        if (Content::find($id)->update($credentials)){
             //修改之前首先判断原先的数据是否已经上架，如果没有则添加到日志
            if ($Content->status == 0){
                //更新课节数日志
                $Course = Course::find($request->course_id);
                $this->updatedContentNumsLog($Course,$request->status);
            }

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
        if ($Content->status == 1){
            return back()->with('hint',config('hint.del_failure_updated'));
        }
        if (Content::destroy($id)){
            //删除封面图片
            if (is_file(public_path($Content->cover))){
                unlink(public_path($Content->cover));
            }
            //删除课节数更新日志
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }

}
