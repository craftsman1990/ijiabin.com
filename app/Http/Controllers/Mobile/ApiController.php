<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Navigation;
use App\Models\TutorStudent;
use App\Models\Video;
use App\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    //首页数据获取
    public function getIndexMessge(Request $request){
        $cid = $request->get('cid');
        $page = $request->get('page');
        if ($page != null) {
            $res = Navigation::getCateAV($cid, config('hint.m_show_num'), $page);
        }else{
            $res = Navigation::getCateAV($cid, config('hint.m_show_num'));
        }
        if($res){
            foreach ($res as $art){
                $nav = Navigation::find($art->nav_id);
                if($nav){
                    if ($nav->id==1){
                        $art->n_name = '';
                    }else{
                        $art->n_name = $nav->n_name;
                    }
                }else{
                    $art->n_name = '未知';
                }
                if ($art->type==1){
                    $art->url = url('mobile/article/id/'.$art->id);
                }else{
                    $art->url = url('mobile/video/id/'.$art->id);
                }
                $art->cover = asset($art->cover);
                $art->publish_time = Helper::getDifferenceTime($art->publish_time);
            }
        }
        return response($res);
    }

    //品牌节目数据获取
    public function getBrandMessge(Request $request){
        $nav = $request->get('nav');
        $page = $request->get('page');
        if($nav == 9){
            //企业纪录片
            $content = Video::getNavigation($nav,config('hint.m_show_num'),$page);
        }else{
            //其他内容
            $threeNav = Navigation::getNavTwo($nav);
            if ($threeNav->toArray()){
                foreach ($threeNav as $v){
                    $arrIds[] = $v->id;
                }
                $strIds = implode(',',$arrIds);
            }else{
                $strIds = $nav;
            }


            $content = Navigation::getArticleVideo($strIds,config('hint.m_show_num'),$page);
            if ($content){
                foreach ($content as $con){
                    $con->publish_time = Helper::getDifferenceTime($con->publish_time);
                    $thisNav = Navigation::find($con->nav_id);
                    $con->nav_name = $thisNav->n_name;
                    if($con->type ==1){
                        $con->url = url('mobile/article/id/'.$con->id);
                    }else{
                        $con->url = url('mobile/video/id/'.$con->id);
                    }
                    $con->cover = asset($con->cover);
                }
            }

        }
        return response($content);
    }

    //导师学员数据获取
    public function getPeopleMessge(Request $request){
        $nav = $request->get('nav');
        $page = $request->get('page');
        if($nav==11){
            $type = 1;
        }else{
            $type = 2;
        }
        if ($page != null){
            $res = TutorStudent::getPeople($type,config('hint.m_tust_num'),$page);
        }else{
            $res = TutorStudent::getPeople($type,config('hint.m_tust_num'));
        }

        if ($res){
            foreach ($res as $v){
                $v->url = url('mobile/tsDetail/id/'.$v->id);
            }
        }
        return response($res);
    }
}
