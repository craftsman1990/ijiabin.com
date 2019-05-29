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

class ContentController extends Controller
{

    public function index(){

    }

    /**
     *课程内容章节数更新
     * @param int $content_nums 设置的课程总章节数
     * @param int $id,课程ID
     **/

//    private function updateContentNums($id,$content_nums)
//    {
//        $keys = 'Course_id:'.$id.';content_nums:'.$content_nums;
//
//        $check_nums = ContentNumsLog::select('nums')->where('courseid_contentnums','=',$keys)->first();
////        dd($check_nums['nums']);
//        if ($check_nums){
//            $old_nums = $check_nums['nums'];
//          //  $new_nums = ContentNumsLog::select('nums')->where('courseid_contentnums','=',$keys)->first()->ToArray();
//            if ( $old_nums== $content_nums){
//               // dd($new_nums['nums'],$content_nums);
//                $update = [
//                    'is_end'=>( $old_nums == $content_nums)?1:0,
//                    'content_updates'=> $old_nums,
//                    'updated_at'=>date('Y-m-d H:i:s',time()),
//                    'end_at'=>date('Y-m-d H:i:s',time())
//                ];
//
//                Course::find($id)->update($update);
////                dd('完结课程'.$old_nums);
//                return true;
//            }elseif ( $old_nums < $content_nums){
//                ContentNumsLog::where('courseid_contentnums','=',$keys)->update(['nums'=>$old_nums+1]);
////                dd('课程待更新，请执行添加'.$old_nums);
//            }else{
////                dd('课程已经完结，请不要再添加章节!'.$old_nums);
//                return false;
//            }
//
//        }else{
//
//            ContentNumsLog::create(['courseid_contentnums'=>$keys,'nums'=>1]);
//            $new_nums = ContentNumsLog::select('nums')->where('courseid_contentnums','=',$keys)->first()->ToArray();
//            $update = [
//                'is_end'=>($new_nums['nums'] == $content_nums)?1:0,
//                'content_updates'=>$new_nums['nums'],
//                'updated_at'=>date('Y-m-d H:i:s',time()),
//                'end_at'=>date('Y-m-d H:i:s',time())
//            ];
//            Course::find($id)->update($update);
////            dd('执行添加'.$new_nums['nums']);
//            return true;
//        }
//
//    }

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
            "time" => "numeric|min:1"
        ];
        $diff_m_0 = [
            "label.max" => "章节标签 不能超过20个字符",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.max" => "音频地址 不能超过255个字符",
            "time.numeric" => "章节时长 必须是数字",
            "time.min" => "章节时长 最小值必须大于1s",
        ];

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
            $message['try_time.max'] =  '章节试看时长 不能超过'.$request->time;
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
            "time" => "numeric|min:1"
        ];
        $diff_m_0 = [
            "label.max" => "章节标签 不能超过20个字符",
            "video.max" => "视频地址 不能超过255个字符",
            "audio.max" => "音频地址 不能超过255个字符",
            "time.numeric" => "章节时长 必须是数字",
            "time.min" => "章节时长 最小值必须大于1s",
        ];

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
            $message['try_time.max'] =  '章节试看时长 不能超过'.$request->time;
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
            //删除封面图片
            if (is_file(public_path($Content->cover))){
                unlink(public_path($Content->cover));
            }
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }





}
