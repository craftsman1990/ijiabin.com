<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'dx_order';

    protected $fillable = ['title', 'user_id','course_id','price','status','pay_time','order_num','payment_method','payment_no'];

    /**
     * 获取用户订单列表
     * @param  [type] $user_id 用户id
     * @return [array]
     */
    public static function myOrderList($request)
    {
        //判断当前请求方式
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    	$data = DB::table('dx_order')->where(['user_id'=>$request->user_id,'status'=>1])->get()->toArray();
    	if (empty($data)) {
    		return ['status'=>1,'msg'=>'暂无订单信息'];
    	}
        $play_num = 0;
    	foreach ($data as $key => $v) {
            //获取课程信息
    		$re = DB::table('dx_course')
    		->where(['id'=>$v->course_id])
    		->first();
            //根据课程id获取该课程下所有的小节信息
            $content = DB::table('dx_course_content')
            ->where(['course_id'=>$re->id])
            ->select('id')
            ->get()->toArray();
            //获取上架小节数
            $content_nums = DB::table('dx_course_content')->where(['status'=>1,'course_id'=>$re->id])->count();
            if (empty($content_nums)) {
                $content_nums = '';
            }
            // print_r($content);die;
            foreach ($content as $k => $val) {
                $play =  DB::table('dx_learning_states')
            ->where(['content_id'=>$val->id,'user_id'=>$request->user_id])
            ->first();
              if ($play) {
                  $play_num++;
              }
            }
            $result[$key]['id'] = $re->id;
            $result[$key]['name'] = $re->name;
            $result[$key]['lengthways_cover'] = $http_type.$_SERVER['SERVER_NAME'].$re->lengthways_cover;
            $result[$key]['content_updates'] = $content_nums;
            $result[$key]['play_num'] = $play_num;
            $play_num = 0;
    	}
    	return $result;
    }

    /**
     * 判断用户是否下单购买（查询购买状态）
     * @param  [type]  $request user_id&id商品id
     * @return result          
     */
    public static function isOrder($request)
    {
        $data = DB::table('dx_order')
                ->where(['user_id'=>$request->user_id,'course_id'=>$request->course_id,'status'=>1])
                ->get()
                ->toArray();
        if (empty($data)) {
            return [];
        }
        return $data;
    }
}
