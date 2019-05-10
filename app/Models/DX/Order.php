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
        $data = DB::table('dx_order')->where(['user_id'=>$request->user_id,'status'=>1])->get()->toArray();
        if (empty($data)) {
            return ['status'=>1,'msg'=>'暂无订单信息'];
        }
        foreach ($data as $key => $v) {
            $result[] = DB::table('dx_course')
            ->where(['id'=>$v->course_id])
            ->first();
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
