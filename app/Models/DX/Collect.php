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
    	$data = Collect::where(['user_id'=>$request->user_id,'type'=>1])->get()->toArray();
    	if (empty($data)) {
    		return ['status'=>1,'msg'=>'暂无收藏'];
    	}
    	foreach ($data as $key => $v) {
    		$result[] = DB::table('dx_course')
    		->where(['id'=>$v['by_collect_id']])
    		->first();
    	}
  		$re['status'] = 1;
  		$re['data'] = $result;
    	return $re;
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
