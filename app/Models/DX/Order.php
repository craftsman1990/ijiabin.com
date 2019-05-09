<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'dx_order';

    protected $fillable = ['title', 'user_id','course_id','price','status','pay_time','order_num','payment_method','payment_no'];

    /**
     * ��ȡ�û������б�
     * @param  [type] $user_id �û�id
     * @return [array]
     */
    public static function myOrderList($request)
    {
    	$data = DB::table('dx_order')->where(['user_id'=>$request->user_id,'status'=>1])->get()->toArray();
    	if (empty($data)) {
    		return ['status'=>1,'msg'=>'���޶�����Ϣ'];
    	}
    	foreach ($data as $key => $v) {
    		$result[] = DB::table('dx_course')
    		->where(['id'=>$v->course_id])
    		->first();
    	}
    	return $result;
    }

    /**
     * �ж��û��Ƿ��µ����򣨲�ѯ����״̬��
     * @param  [type]  $request user_id&id��Ʒid
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
