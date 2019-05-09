<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DX\Order;
use App\Models\DX\Collect;

class Course extends Model
{
    protected $table = 'dx_course';

    protected $fillable = ['name', 'crosswise_cover','lengthways_cover','teacher','professional','intro','ify','is_pay','looks','price','play_num'];

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
    public static function getCourseList($page='',$pageSize='',$ify)
    {
    	$offset = ($page-1)*$pageSize;
    	$source = DB::table('dx_course')
    	->select('id','name','crosswise_cover','lengthways_cover','ify')
        ->where('ify','=',$ify)
    	->offset($offset)
    	->limit($pageSize)
    	->get()
    	->toArray();//课程
    	//根据课程查询课程下的小结
    	foreach ($source as $key => $v) {
    		$list = DB::table('dx_course_content')
    		->select('id','title','intro','time','video','type','chapter','label','try_time','course_id','play_num')
    		->where('course_id','=',$v->id)
    		->get()->toArray();
            $play_num = array_sum(array_column($list,'play_num'));
            //转换展示播放量
            if($play_num < 10000) {
               $play = (string)$play_num;
            } else if ($play_num >= 10000) {
               $play = ($play_num/10000).'w';
            }
            $source[$key]->play_num = $play;
    		$source[$key]->course_content = $list;
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
        ->select('id','name','crosswise_cover','lengthways_cover','ify','intro')
        ->where('id','=',$request->course_id)
        ->get()
        ->toArray();//课程
        //根据课程查询课程下的小结
        foreach ($source as $key => $v) {
            $list = DB::table('dx_course_content')
            ->select('id','title','intro','time','video','type','chapter','label','try_time','course_id')
            ->where('course_id','=',$v->id)
            ->get()->toArray();
            foreach ($list as $k => $val) {
                //验证用户是否收藏
                if (empty($request->user_id)) {
                    $is_collect = 0;
                }else{
                    $Collect = Collect::isCollect($request->user_id,$val->id);
                    if (empty($Collect)) {
                        $is_collect = 0;
                    }else{
                        $is_collect = 1;
                    }
                }
                $list[$k]->is_collect = $is_collect;
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
            $source[$key]->is_pay = $is_pay;
            $source[$key]->course_content = $list;
        }
        return $source;
    }
}
