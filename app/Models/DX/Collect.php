<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Collect extends Model
{
    protected $table = 'dx_collect';

    protected $fillable = ['by_collect_id', 'type','user_id','status'];
    /**
     * 用户收藏
     * @param [type] $request obj
     */
    public static function UserCollect($request)
    {
      //验证用户是否收藏过
      $collect = Collect::where(['user_id'=>$request->user_id,'type'=>$request->type,'by_collect_id'=>$request->by_collect_id])->first();
      if (empty($collect)) {
         $collects = new Collect();
         $collects->user_id = $request->user_id;
         $collects->by_collect_id = $request->by_collect_id;
         $collects->type = $request->type;
         $collects->status = 1;
         if ($collects->save()) {
            return ['status'=>1,'msg'=>'收藏成功'];
         }
      }else{
        if ($collect->status==0) {
          $collect->status = 1;
        }else{
          $collect->status = 0;
        }
        if ($collect->save()) {
          return ['status'=>1,'msg'=>'操作成功'];
        }
      }
    }
    //我收藏的课程
    public static function getCollectList($request)
    {
        //判断当前请求方式
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    	$data = Collect::where(['user_id'=>$request->user_id,'type'=>1])->get()->toArray();
    	if (empty($data)) {
    		return ['status'=>1,'msg'=>'暂无收藏'];
    	}
    	foreach ($data as $key => $v) {
        //根据id获取小节信息
    		$re = DB::table('dx_course_content')
    		->where(['id'=>$v['by_collect_id']])
    		->first();
        //根据小节id获取课程信息
        $course = DB::table('dx_course')
        ->where(['id'=>$re->course_id])
        ->first();
        //获取上架小节数
         $content_nums = DB::table('dx_course_content')->where(['status'=>1,'course_id'=>$re->course_id])->count();
         if (empty($content_nums)) {
            $content_nums = '';
         }
        $result[$key]['id'] = $v['id'];
        $result[$key]['name'] = $re->title;
        $result[$key]['chapter'] = $re->chapter;
        $result[$key]['lengthways_cover'] = $http_type.$_SERVER['SERVER_NAME'].$course->lengthways_cover;
        $result[$key]['course_name'] = $course->name;
        $result[$key]['content_updates'] = $content_nums;
    	}
  		$resul['status'] = 1;
  		$resul['data'] = $result;
    	return $resul;
    }
    //批量删除收藏课程
    public static function delCollect($request)
    {
      $ids = explode(',', $request->ids);
      foreach ($ids as $v) {
        DB::table('dx_collect')->where(['id'=>$v])->delete();
      }
      return ['status'=>1,'msg'=>'操作成功'];
    }
    /**
     * 判断用户是否收藏
     * @param  [type]  $request user_id&小节id
     * @return array
     */
    public static function isCollect($user_id,$by_collect_id)
    {
       $data = Collect::where(['user_id'=>$user_id,'type'=>1,'status'=>1,'by_collect_id'=>$by_collect_id])->get()->toArray();
       if (empty($data)) {
           return [];
       }
       return $data;
    }
}
