<?php

namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\User;
use App\Models\DX\Course;
use App\Models\DX\Article;

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

    /**
     * 获取三大课程数据 （案例课，公开课，案例库）
     * @param type 课程类别
     * @param page  页码数
     * @param limit 分页条数
     * @param Request $request [description]
     */
    public function getCourse(Request $request)
    {
        if (empty($request->type)) {
            return response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        $page = isset($request->page) ? (int)$request->page : 1;
        $limit = isset($request->limit) ? (int)$request->limit : 10;//默认10条
        $data = Article::getCourseList($request->type,$page,$limit);
        return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
    }

    /**
     * 课程详情
     * @param  $aid 课程id
     * @param  Request $request [description]
     * @return json
     */
    public function getCourseDetail(Request $request)
    {
       if (empty($request->aid)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']);
       }
       $data = Article::getCourseDetail($request->aid);
       return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
    }

    /**
     * 关键字搜索
     * @param  key  关键字
     * @param page  页码数
     * @param limit 分页条数
     * @param type 类别：1：文章；2：视频
     * @param 注意：type 默认为空（查询全部混合数据）
     * @return json
     */
    public function search(Request $request)
    {
        if (empty($request->key)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']); 
        }
        $page = isset($request->page) ? (int)$request->page : 1;
        $limit = isset($request->limit) ? (int)$request->limit : 10;//默认10条
        $data = Article::keysSearch($request->key,$limit,$page,$request->type);
        return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
    }

    /**
     * 相关推荐
     * @param  aid  课程id
     * @return json
     */
    public function recommendAtions(Request $request)
    {
        if (empty($request->aid)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']); 
        }
        $data = Article::recommendAtionsList($request->aid);
        return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
    }

    /**
     * 记录课程播放量
     * @param Request $request [description]
     */
    public function addLooks(Request $request)
    {
        if (empty($request->aid)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']); 
        }
        $data = Article::addLooks($request->aid);
        return response()->json($data);
    }

    /**
     * 精品推荐
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function recommenDation(Request $request)
    {
        if (empty($request->type)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']); 
        }
        $data = Article::recommenDation($request->type);
        return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
    }
    /**
     * 根据图片地址获取base64视频流
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getBase64Img(Request $request)
    {
        if (empty($request->img)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']); 
        }
        $lengthways_cover = file_get_contents($request->img);
        $lengthways_cover = base64_encode($lengthways_cover);
        return $lengthways_cover;
    }
     /**
     * 根据栏目id获取课程
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function column(Request $request)
    {
       if (empty($request->column_id)) {
           return response()->json(['status'=>999,'msg'=>'参数错误！']); 
        }
        $page = isset($request->page) ? (int)$request->page : 1;
        $limit = isset($request->limit) ? (int)$request->limit : 10;//默认10条
        $column_list = Article::ColumnList($request->column_id,$page,$limit);
        return response()->json(['status'=>1,'msg'=>'success','data'=>$column_list]);
    }
}
