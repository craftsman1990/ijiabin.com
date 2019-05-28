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
        $pageSize = isset($request->pageSize)? $request->pageSize : 5;
        $page =  isset($request->page)? $request->page : 1;//默认显示展示第一页
        $request->pageSize = $pageSize;
        $request->page = $page;
        if (empty($request->ify)) {
            return response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        if (!$user = User::isToken($request->header('token'))) {
            $request->user_id = '';
        }else{  
            $request->user_id = $user->id;  
        }
        $result = Course::getCourseList($request);
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
        return response()->json(['status'=>1,'msg'=>'获取成功','data'=>config('jbdx.yqlj')]);
    }

    /**
     * 获取wap站首页列表
     * @param  Request $request [description]
     * 分类：ify不为空根据分类查询，为空则查询全部
     * @return 
     */
    public function getWapContent(Request $request)
    {
       //默认显示5条
        $pageSize = isset($request->pageSize)? $request->pageSize : 5;
        $page =  isset($request->page)? $request->page : 1;//默认显示展示第一页
        $result = Course::getWapContentList($page,$pageSize,$request->ify);
        if (empty($result)) {
           return response()->json(['status'=>1,'msg'=>'暂无数据！']);
        }
        $data['status'] = 1;
        $data['data'] = $result;
        return response()->json($data);
    }
}
