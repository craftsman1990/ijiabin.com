<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'dx_feedback';
    protected $fillable = ['user_id', 'question','contact'];

    /**
     * 用户反馈
     * @param [type] $request [description]
     */
    public static function addFeedBack($request)
    {
    	$feedObj = new Feedback();
    	$feedObj->user_id = $request->user_id;
    	$feedObj->question = $request->question;
    	$feedObj->contact = $request->contact;
    	if ($feedObj->save()) {
    		return ['status'=>1,'msg'=>'反馈成功！'];
    	}else{
    		return ['status'=>999,'msg'=>'反馈失败！'];
    	}
    }
}
