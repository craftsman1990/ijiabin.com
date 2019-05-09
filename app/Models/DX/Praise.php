<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Praise extends Model
{
    protected $table = 'dx_praises';

    protected $fillable = ['by_praise_id', 'type','user_id','status'];

    /**
     * �û�����/ȡ������
     * @param  [obj] $request
     * user_id:�û�id��by_praise_id�������޵�ID��type��1�������ۣ�2���γ�����
     * @return   array
     */
    public static function userPraise($request)
    {
        //��֤�û��Ƿ���޹�
        $praise = Praise::where(['user_id'=>$request->user_id,'type'=>$request->type,'by_praise_id'=>$request->by_praise_id])->first();
        if (empty($praise)) {
           $praises = new Praise();
           $praises->user_id = $request->user_id;
           $praises->by_praise_id = $request->by_praise_id;
           $praises->type = $request->type;
           $praises->status = 1;
           if ($praises->save()) {
                return ['status'=>1,'msg'=>'���޳ɹ�'];
           }
        }else{
            if ($praise->status==0) {
                $praise->status = 1;
            }else{
                $praise->status = 0;
            }
            if ($praise->save()) {
                return ['status'=>1,'msg'=>'�����ɹ�'];
            }
        }
    }
    /**
     * ��ȡ��������
     * @param  [type] $request [by_praise_id type]
     * @return [type]          [description]
     */
    public static function getPraiseNum($by_praise_id)
    {
        $praise = Praise::where(['type'=>2,'by_praise_id'=>$by_praise_id,'status'=>1])->count();
        return $praise;
    }
}
