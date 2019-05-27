<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $table = 'dx_comment';

    protected $fillable = ['discussion_id', 'content','user_id','praise','status','type','grade'];

    /**
     * 用户评论
     * @param  [type] $request
     * $request {
     *     discussion_id：评论的内容id 
     *     content：评论内容
     *     user_id：用户id
     *     type: 1.议题评论 2.课程评论  3.课程内容评论
     * @return array
     */
    public static function userComment($request)
    {
        //需要调用腾讯的敏感词过滤
        $commentObj = new Comment();
        $commentObj->discussion_id = $request->discussion_id;
        $commentObj->content = $request->content;
        $commentObj->user_id = $request->user_id;
        $commentObj->praise = 0;
        $commentObj->type = $request->type;
        $commentObj->grade = $request->grade;
        $commentObj->status = 1;
        if ($commentObj->save()) {
            return ['status'=>1,'msg'=>'评论成功'];
        }else{
            return ['status'=>999,'msg'=>'评论失败'];
        }
    }

    /**
     * 根据课程id获取评论信息
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public static function getCommentLit($request)
    {
         //根据课程评论
        $source = DB::table('dx_comment')
        ->where(['discussion_id'=>$request->discussion_id,'status'=>1,'type'=>2])
        ->select('content','praise','id','grade','user_id','created_at','type')
        ->get()
        ->toArray();
        //根据课程id查询小节信息
        $course = DB::table('dx_course_content')
        ->where(['course_id'=>$request->discussion_id])
        ->select(['id'])
        ->get()
        ->toArray();
        // print_r($course);die;
        //根据小节id获取小节下面的评论信息
        
        if ($course) {
           foreach ($course as $k => $v) {
              $course_source[] = DB::table('dx_comment')
            ->where(['discussion_id'=>$v->id,'status'=>1,'type'=>3])
            ->select('content','praise','id','grade','user_id','created_at','type')
            ->get()
            ->toArray();
           }
           $arr = array_filter($course_source);
         foreach ($arr as $key => $val) {
            foreach ($val as $ks => $vs) {
                array_push($source,$vs);
            }
        }
        $id = array_column($source,'id');
        array_multisort($id,SORT_DESC,$source);
        if ($source) {
                  foreach ($source as $keys => $vals) {
                   $user = DB::table('users')
                   ->where(['id'=>$vals->user_id])
                   ->select('nickname','email','head_pic','authentication')
                   ->first();
                    $result[$keys]['id'] = $vals->id;
                    $result[$keys]['content'] = $vals->content;
                    $result[$keys]['praise'] = $vals->praise;
                    $result[$keys]['grade'] = $vals->grade;
                    $result[$keys]['created_at'] = $vals->created_at;
                    $result[$keys]['nickname'] = $user->nickname;
                    $result[$keys]['authentication'] = $user->authentication;
                    $result[$keys]['head_pic'] = $user->head_pic;
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
       return $result;
    }
}
