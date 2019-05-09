<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class LearningState extends Model
{
    //
    protected $table = 'dx_learning_states';

    protected $fillable = ['user_id','content_id','state','learning_time','quiz_state'];

    /**
     * ��¼�û����Ž���
     * @param  user_id  �û�id
     * @param  content_id ��������id
     * @param  learning_time ���Ž��ȵ�λ��s/�룩
     * @return [type]          [description]
     */
    public static function learningState($request)
    {
        //��֤�û��Ƿ񲥷Ź�
        $learning = LearningState::where(['user_id'=>$request->user_id,'content_id'=>$request->content_id])->first();
        if (empty($learning)) {
           $learnings = new Collect();
           $learnings->user_id = $request->user_id;
           $learnings->content_id = $request->content_id;
           $learnings->state = 0;
           $learnings->learning_time = $request->learning_time;
           $learnings->quiz_state = 0;
           if ($learnings->save()) {
                return ['status'=>1,'msg'=>'��¼�ɹ�'];
           }
        }else{
            $learning->learning_time = $request->learning_time;
            if ($learning->save()) {
                return ['status'=>1,'msg'=>'�����ɹ�'];
            }
        }
    }
}
