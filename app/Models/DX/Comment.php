<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $table = 'dx_comment';

    protected $fillable = ['discussion_id', 'content','user_id','praise','status','type','grade'];

    /**
     * �û�����
     * @param  [type] $request
     * $request {
     *     discussion_id�����۵�����id 
     *     content����������
     *     user_id���û�id
     *     type: 1.��������	2.�γ�����	3.�γ���������
     * @return array
     */
    public static function userComment($request)
    {
    	//��Ҫ������Ѷ�����дʹ���
    	$commentObj = new Comment();
    	$commentObj->discussion_id = $request->discussion_id;
    	$commentObj->content = $request->content;
    	$commentObj->user_id = $request->user_id;
    	$commentObj->praise = 0;
    	$commentObj->type = $request->type;
        $commentObj->grade = $request->grade;
    	$commentObj->status = 1;
    	if ($commentObj->save()) {
    		return ['status'=>1,'msg'=>'���۳ɹ�'];
    	}else{
    		return ['status'=>999,'msg'=>'����ʧ��'];
    	}
    }

    /**
     * ���ݿγ�id��ȡ������Ϣ
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function getCommentLit($request)
    {
        $source = DB::table('dx_comment')
        ->join('users','dx_comment.user_id','=','users.id')
        ->where(['discussion_id'=>$request->discussion_id,'status'=>1,'type'=>2])
        ->select('content','praise','dx_comment.id as comment_id','nickname','email','head_pic','grade')
        ->get()
        ->toArray();
       return $source;
    }
}
