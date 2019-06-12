<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DX\Order;
use App\Models\DX\Collect;
use App\Models\DX\LearningState;
use App\Services\Helper;

class Course extends Model
{
    protected $table = 'dx_course';

    protected $fillable = ['name', 'crosswise_cover','lengthways_cover','teacher','professional'
        ,'intro','ify','is_pay','looks','price','play_num','content_nums','content_updates','is_end',
        'updated_at','end_at','status','content'];

    //分类获取课程
    public static function getIfy($ify,$num){
        return self::where('ify',$ify)->orderBy('created_at','desc')->limit($num)->get();
    }
    /**
     * 获取课程列表
     * @param  int $page     [description]
     * @param  int $pageSize [description]
     * @param  int $ify       分类id
     * @return [type]           [description]
     */
    public static function getCourseList($request)
    {
        $offset = ($request->page-1)*$request->pageSize;
            $source = DB::table('dx_course')
            ->select('id','name','crosswise_cover','lengthways_cover','ify','content_nums','content_updates','is_end','looks','teacher','professional','updated_at','intro','content')
            ->where(['status'=>1,'ify'=>$request->ify])
            ->orderBy('created_at','desc')
            // ->offset($offset)
            // ->limit($request->pageSize)
            ->get()
            ->toArray();//课程
        //根据课程查询课程下的小结
        foreach ($source as $key => $v) {
            $list = DB::table('dx_course_content')
            ->select('id','title','intro','time','video','type','chapter','label','try_time','course_id','play_num','cover','status')
            ->where('course_id','=',$v->id)
            ->get()->toArray();
            //获取上架小节数
            $content_nums = DB::table('dx_course_content')->where(['status'=>1,'course_id'=>$v->id])->count();
            if (empty($content_nums)) {
               $content_nums = '';
            }
            $num = array_sum(array_column($list,'play_num'));
            $play_num = $num + $v->looks;
            //转换展示播放量
            if($play_num < 10000) {
               $play = (string)$play_num;
            } else if ($play_num >= 10000) {
              $str =substr($play_num,-3);
               if ($str>=500) {
                  $play_num = $play_num-$str +1000;
               }else{
                   $play_num = $play_num-$str;
               }
               $play = ($play_num/10000).'w';
            }
            $crosswise_cover = url($v->crosswise_cover);
            $lengthways_cover = url($v->lengthways_cover);
            foreach ($list as $k => $val) {
                $list[$k]->cover = url($val->cover);
                //用户登录返回播放进度
                if ($request->user_id) {
                  //获取播放进度
                  $plays = LearningState::where(['user_id'=>$request->user_id,'content_id'=>$val->id])->first();
                    if ($plays) {
                        $play_state = (int)$plays->learning_time;
                    }else{
                        $play_state = 0;
                    }
                  $list[$k]->play_state = $play_state;
                }
            }
            $request->course_id = $v->id;
            //根据课程id验证是否已经购买
            if (empty($request->user_id)) {
                $is_pay = 0;
            }else{
                $Order = Order::isOrder($request);
                if (empty($Order)) {
                    $is_pay = 0;
                }else{
                    $is_pay = 1;
                }
            }
            $source[$key]->play_num = $play;
            $source[$key]->content_updates = $content_nums;
            $source[$key]->crosswise_cover = $crosswise_cover;
            $source[$key]->lengthways_cover = $lengthways_cover;
            $source[$key]->is_pay = $is_pay;
            $source[$key]->course_content = $list;
        }
        return $source;
    }
    //获取wap站首页课程列表信息
    public static function getWapContentList($page='',$pageSize='',$ify)
    {
       $offset = ($page-1)*$pageSize;
       //分类存在根据分类查询
       if ($ify) {
             $source = DB::table('dx_course')
            ->where(['status'=>1,'ify'=>$request->ify])
            ->orderBy('created_at','desc')
            ->offset($offset)
            ->limit($pageSize)
            ->get()
            ->toArray();//课程  
       }else{
            $source = DB::table('dx_course')
            ->where(['status'=>1])
            ->orderBy('created_at','desc')
            ->get()
            ->toArray();//课程 
       }
        foreach ($source as $key => $v) {
            $list = DB::table('dx_course_content')
            ->select('id','play_num')
            ->where('course_id','=',$v->id)
            ->get()->toArray();
            //获取上架小节数
            $content_nums = DB::table('dx_course_content')->where(['status'=>1,'course_id'=>$v->id])->count();
            if (empty($content_nums)) {
               $content_nums = '';
            }
            $num = array_sum(array_column($list,'play_num'));
            $play_num = $num + $v->looks;
            //转换展示播放量
            if($play_num < 10000) {
               $play = (string)$play_num;
            } else if ($play_num >= 10000) {
               $str =substr($play_num,-3);
               if ($str>=500) {
                  $play_num = $play_num-$str +1000;
               }else{
                   $play_num = $play_num-$str;
               }
               $play = ($play_num/10000).'w';
            }
            $crosswise_cover = url($v->crosswise_cover);
            $lengthways_cover = url($v->lengthways_cover);
            $source[$key]->play_num = $play;
            $source[$key]->content_updates = $content_nums;
            $source[$key]->crosswise_cover = $crosswise_cover;
            $source[$key]->lengthways_cover = $lengthways_cover;
            $source[$key]->intro = $v->intro;
            $source[$key]->content = $v->content;
        }
        return $source;
    }
    /**
     * 根据课程id获取课程详情
     * @param  [type] $request Obj
     * $request{course_id:课程id  user_id:用户id}
     * @return array          
     */
    public static function getCourseDetail($request)
    {
        $source = DB::table('dx_course')
        ->select('id','name','crosswise_cover','lengthways_cover','ify','intro','price','content')
        ->where('id','=',$request->course_id)
        ->get()
        ->toArray();//课程
        //根据课程查询课程下的小结
        foreach ($source as $key => $v) {
            $list = DB::table('dx_course_content')
            ->select('id','title','intro','time','video','type','chapter','label','try_time','course_id','type','cover','status','content')
            ->where('course_id','=',$v->id)
            ->get()->toArray();
            foreach ($list as $k => $val) {
                //验证用户是否收藏
                if (empty($request->user_id)) {
                    $is_collect = 0;
                    $play_state = 0;
                }else{
                    $Collect = Collect::isCollect($request->user_id,$val->id);
                    if (empty($Collect)) {
                        $is_collect = 0;
                    }else{
                        $is_collect = 1;
                    }
                    //获取用户播放进度
                    $play = LearningState::where(['user_id'=>$request->user_id,'content_id'=>$val->id])->first();
                    if ($play) {
                        $play_state = (int)$play->learning_time;
                    }else{
                        $play_state = 0;
                    }
                }
                if ($request->course_content_id==$val->id) {
                    $list[$k]->current  = 1;
                }
                $list[$k]->is_collect = $is_collect;
                $list[$k]->play_state = $play_state;
                $list[$k]->cover = url($val->cover);
            }
            //根据课程id验证是否已经购买
            if (empty($request->user_id)) {
                $is_pay = 0;
            }else{
                $Order = Order::isOrder($request);
                if (empty($Order)) {
                    $is_pay = 0;
                }else{
                    $is_pay = 1;
                }
            }
            $source[$key]->crosswise_cover = url($v->crosswise_cover);
            $source[$key]->lengthways_cover = url($v->lengthways_cover);
            $source[$key]->is_pay = $is_pay;
            $source[$key]->course_content = $list;
        }
        return $source;
    }
}
