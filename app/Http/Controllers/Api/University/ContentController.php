<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\User;
use App\Models\DX\Course;

class ContentController extends Controller
{
    /**
     * 展示首页body列表
     * @return json
     */
    public function getContentList(Request $request)
    {
        //默认显示5条
        $pageSize = 5;
        $page = 1;//默认显示展示第一页
        // $ify = 3;
        if (empty($request->ify)) {
            return response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        $result = Course::getCourseList($page,$pageSize,$request->ify);
        if (empty($result)) {
           return response()->json(['status'=>1,'msg'=>'暂无数据！']);
        }
        $data['status'] = 1;
        $data['data'] = $result;
    	return response()->json($data);
    }

    /**
     * 获取课程详情
     * @param  Request $request obj
     * $request{course_id:课程id user_id:用户id}
     * @return json
     */
    public function getContentDetails(Request $request)
    {
        if (empty($request->course_id)) {
            return response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        if (!$user = User::isToken($request->header('token'))) {
            $request->user_id = '';
        }else{  
            $request->user_id = $user->id;  
        }
        $result = Course::getCourseDetail($request);
        return response()->json(['status'=>1,'msg'=>'获取成功','data'=>$result]);
    }
     //获取网站底部的合作媒体
    public function aboutUs()
    {
        return response()->json(['status'=>1,'msg'=>'获取成功','data'=>config('hint.hzjg')]);
    }
}
