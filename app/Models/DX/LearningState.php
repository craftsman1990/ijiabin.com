<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class LearningState extends Model
{
    //
    protected $table = 'dx_learning_states';

    protected $fillable = ['user_id','content_id','state','learning_time','quiz_state'];

    /**
     * 记录用户播放进度
     * @param  user_id  用户id
     * @param  content_id 播放内容id
     * @param  learning_time 播放进度单位（s/秒）
     * @return [type]          [description]
     */
    public static function learningState($request)
    {
    	//验证用户是否播放过
    	$learning = LearningState::where(['user_id'=>$request->user_id,'content_id'=>$request->content_id])->first();
    	if (empty($learning)) {
    	   $learnings = new Collect();
    	   $learnings->user_id = $request->user_id;
    	   $learnings->content_id = $request->content_id;
    	   $learnings->state = 0;
    	   $learnings->learning_time = $request->learning_time;
    	   $learnings->quiz_state = 0;
    	   if ($learnings->save()) {
    	   		return ['status'=>1,'msg'=>'记录成功'];
    	   }
    	}else{
    		$learning->learning_time = $request->learning_time;
    		if ($learning->save()) {
    			return ['status'=>1,'msg'=>'操作成功'];
    		}
    	}
    }
}
