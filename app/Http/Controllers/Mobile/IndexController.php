<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Advertising;
use App\Models\Article;
use App\Models\Category;
use App\Models\Hotbot;
use App\Models\Navigation;
use App\Models\TutorStudent;
use App\Models\Video;
use App\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //首页
    public function index(){
        $data['title'] = '我有嘉宾-遍访天下公司、纪录时代商业';
        $data['oneId'] = 1;
        $data['secId'] = 1;
        //导航
        $data['navig'] = Navigation::getNav();

        //广告
        $data['ind_vid_adv'] = Advertising::getAdver(1,1);
        $data['ind_sil_adv'] = Advertising::getAdver(2,5);

        //分类
        $cate = Category::all()->toArray();
        $zuixin = array('id'=>0,'cg_name'=>'最新推荐',"sort"=>100,'status'=>1,'created_at'=>'2018-08-02 08:09:54','updated_at'=>'2018-08-02 08:09:54');
        array_unshift($cate,$zuixin);
        foreach ($cate as &$c){
            if ($c['id']==0){
                $c['content'] = Article::getArticleVideo($c['id'],config('hint.m_show_num'));
                foreach ($c['content'] as $cont){
                    $nav = Navigation::find($cont->nav_id);
                    if($nav->id == 1){
                        $cont->n_name = '';
                    }else{
                        $cont->n_name = $nav->n_name;
                    }
                    $cont->publish_time = Helper::getDifferenceTime($cont->publish_time);
                }
            }else{
                $c['content'] = [];
            }
        }
        $data['cate'] = $cate;
        //导师与学员
        $data['tutor'] = TutorStudent::getIndexShow();
        foreach ($data['tutor'] as $tutor){
            $tutor->classic_quote= explode('；',$tutor->classic_quote);
        }
        //dd($data);
        //分享(判断是不是微信浏览器)
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            $signPackage = Helper::getJSSDK();
            $share['cover'] = 'Home/images/jiabindaxue_logo.png';
            $share['title'] = '我有嘉宾-遍访天下公司、纪录时代商业';
            $share['intro'] = '领先的新经济产业服务平台';
        }else{
            $signPackage = array('appId'=>'wx87a51989fd90054d ','timestamp'=>'1537237991','nonceStr'=>'QS69mHIz3AwodX4T','signature'=>'913ec1d34f2e3529f9ca9fedadb7a7863b63c20d');
            $share['cover'] = 'Home/images/jiabindaxue_logo.png';
            $share['title'] = '我有嘉宾-遍访天下公司、纪录时代商业';
            $share['intro'] = '领先的新经济产业服务平台';
        }

        return view('Mobile.Index.index',compact('data','signPackage','share'));
    }

    //重定向
    public function transmit($oneId,$secId){
        switch ($oneId){
            case 2:
                //品牌节目
                return redirect('mobile/brand/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 5:
                //嘉宾大学
                return redirect('mobile/university/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 6:
                //嘉宾峰会
                return redirect('mobile/summit/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 3:
                //导师与学员
                return redirect('mobile/tutorStudent/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 4:
                //关于我们
                return redirect('mobile/aboutUs/oneId/'.$oneId.'/secId/'.$secId);
                break;
            default:
                //首页
                return redirect('mobile/index');
                break;
        }
    }

    //品牌节目
    public function brand($oneId,$secId){
        $data['title'] = '品牌节目';
        $data['oneId'] = $oneId;
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);

        //内容
        foreach ($data['towNav'] as $towNav){
            if ($towNav->id == 9){
                //企业纪录片
                $towNav->content = Video::getNavigation($towNav->id,config('hint.m_show_num'));
            }else{
                //其他内容
                $threeNav = Navigation::getNavTwo($towNav->id);
                if ($threeNav->toArray()){
                    foreach ($threeNav as $v){
                        $arrIds[] = $v->id;
                    }
                    $strIds = implode(',',$arrIds);
                }else{
                    $strIds = $towNav->id;
                }

                $towNav->content = Navigation::getArticleVideo($strIds,config('hint.m_show_num'));
                foreach ($towNav->content as $con){
                    $con->publish_time = Helper::getDifferenceTime($con->publish_time);
                    $thisNav = Navigation::find($con->nav_id);
                    $con->nav_name = $thisNav->n_name;
                }
            }
        }
        //我有嘉宾顶部广告位 4
        $data['adver'] = Advertising::getAdver(4,1);
//        dd($data);
        return view('Mobile.Index.brand',compact('data',$data));
    }

    //嘉宾大学
    public function university($oneId,$secId){
        $data['title'] = '嘉宾大学';
        $data['oneId'] = $oneId;
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $towNav){
            $threeNav = Navigation::getNavTwo($towNav->id);
            if ($threeNav->toArray()){
                foreach ($threeNav as $v){
                    $arrIds[] = $v->id;
                }
                $strIds = implode(',',$arrIds);
            }else{
                $strIds = $towNav->id;
            }
            $towNav->content = Navigation::getArticleVideo($strIds,config('hint.m_show_num'));
            foreach ($towNav->content as $con){
                $con->publish_time = Helper::getDifferenceTime($con->publish_time);
                $thisNav = Navigation::find($con->nav_id);
                $con->nav_name = $thisNav->n_name;
            }
            //广告
            if ($towNav->id ==7){
                //嘉宾派顶部广告
                $adver = Advertising::getAdver(5,1);
                $towNav->adver = $adver[0];
            }elseif($towNav->id == 10){
                //国际课程顶部广告
                $adver = Advertising::getAdver(6,1);
                $towNav->adver = $adver[0];
            }else{

            }
        }
//        dd($data);
        return view('Mobile.Index.university',compact('data',$data));
    }

    //嘉宾峰会
    public function summit($oneId,$secId){
        $data['title'] = '嘉宾峰会';
        $data['oneId'] = $oneId;
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $towNav){
            $towNav->content = Navigation::getArticleVideo($towNav->id,config('hint.m_show_num'));
            foreach ($towNav->content as $con){
                $con->publish_time = Helper::getDifferenceTime($con->publish_time);
                $thisNav = Navigation::find($con->nav_id);
                $con->nav_name = $thisNav->n_name;
            }
            //广告
            if ($towNav->id ==19){
                //嘉宾峰会顶部广告
                $adver = Advertising::getAdver(7,1);
                $towNav->adver = $adver[0];
            }else{

            }
        }
        return view('Mobile.Index.summit',compact('data',$data));
    }

    //导师与学员
    public function tutorStudent($oneId,$secId){
        $data['title'] = '导师与学员';
        $data['oneId'] = $oneId;
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $towNav){
            if($towNav->id == $data['secId']){
                if ($towNav->id == 11){
                    $towNav->people = TutorStudent::getPeople(1,config('hint.m_tust_num'));
                }else{
                    $towNav->people = TutorStudent::getPeople(2,config('hint.m_tust_num'));
                }
            }else{
                $towNav->people = [];
            }
        }
//        dd($data);
        return view('Mobile.Index.tutorStudent',compact('data',$data));
    }

    //关于我们
    public function aboutUs($oneId,$secId){
        $data['title'] = '关于我们';
        $data['oneId'] = $oneId;
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);

        return view('Mobile.Index.aboutUs',compact('data',$data));
    }

    //导师详情
    public function tsDetail($id){
        $data['prople'] = TutorStudent::find($id);
        $data['title'] = $data['prople'] -> name;
        $classic_quote = explode('；',$data['prople']->classic_quote);
        $data['classic_quote']= array_filter($classic_quote);

        //相关内容
        $data['about'] = Navigation::getSearchTitle($data['prople']->name);
        foreach ($data['about'] as $about){
            $about->publish_time = Helper::getDifferenceTime($about->publish_time);
            $thisNav = Navigation::find($about->nav_id);
            $about->nav_name = $thisNav->n_name;
        }
//        dd($data);
        return view('Mobile.Index.tsDetail',compact('data',$data));
    }

    //文章详情
    public function article($id){
        $data['article'] = Article::find($id);
        $data['title'] = $data['article']->title;
        //当前导航
        $nav = Navigation::select('n_name')->find($data['article']->nav_id)->toArray();
        $data['article'] -> nav_name = $nav['n_name'];
        //当前分类
        $cate = Category::select('cg_name')->find($data['article']->cg_id)->toArray();
        $data['article'] -> cg_name = $cate['cg_name'];
        //正式服需要替换的
        $data['article'] -> content = str_replace('http://tx3.ijiabin.net','https://www.ijiabin.com',$data['article'] -> content);
        //时间
        $data['article'] -> push = Helper::getDifferenceTime($data['article']->publish_time);

        //相关内容
        $data['like'] = Article::guessLike($data['article']->labels);
        foreach ($data['like'] as $like){
            $like->publish_time = Helper::getDifferenceTime($like->publish_time);
            $thisNav = Navigation::find($like->nav_id);
            $like->nav_name = $thisNav->n_name;
        }

        //分享(判断是不是微信浏览器)
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            $signPackage = Helper::getJSSDK();
            $share['cover'] = $data['article']->cover;
            $share['title'] = $data['article']->title;
            $share['intro'] = $data['article']->intro;
        }else{
            $signPackage = array('appId'=>'wx87a51989fd90054d ','timestamp'=>'1537237991','nonceStr'=>'QS69mHIz3AwodX4T','signature'=>'913ec1d34f2e3529f9ca9fedadb7a7863b63c20d');
            $share['cover'] = $data['article']->cover;
            $share['title'] = $data['article']->title;
            $share['intro'] = $data['article']->intro;
        }
        return view('Mobile.Index.article',compact('data','signPackage','share'));
    }

    //视频详情
    public function video($id){
        $data['video'] = Video::find($id);
        $data['title'] = $data['video']->title;

        //当前导航
        $nav = Navigation::select('n_name')->find($data['video']->nav_id)->toArray();
        $data['video'] -> nav_name = $nav['n_name'];
        //当前分类
        $cate = Category::select('cg_name')->find($data['video']->cg_id)->toArray();
        $data['video'] -> cg_name = $cate['cg_name'];
        //时间
        $data['video'] -> push = Helper::getDifferenceTime($data['video']->publish_time);

        //相关内容
        $data['like'] = Video::guessLike($data['video']->labels);
        foreach ($data['like'] as $like){
            $like->publish_time = Helper::getDifferenceTime($like->publish_time);
            $thisNav = Navigation::find($like->nav_id);
            $like->nav_name = $thisNav->n_name;
        }

        //分享(判断是不是微信浏览器)
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            $signPackage = Helper::getJSSDK();
            $share['cover'] = $data['video']->cover;
            $share['title'] = $data['video']->title;
            $share['intro'] = $data['video']->intro;
        }else{
            $signPackage = array('appId'=>'wx87a51989fd90054d ','timestamp'=>'1537237991','nonceStr'=>'QS69mHIz3AwodX4T','signature'=>'913ec1d34f2e3529f9ca9fedadb7a7863b63c20d');
            $share['cover'] = $data['video']->cover;
            $share['title'] = $data['video']->title;
            $share['intro'] = $data['video']->intro;
        }
        return view('Mobile.Index.video',compact('data','signPackage','share'));
    }

    //搜索
    public function search(){
        $data['title'] = '搜索';
        $data['hotbot'] = Hotbot::all();
        return view('Mobile.Index.search',compact('data',$data));
    }

    //搜索执行
    public function doSearch(Request $request){
        $data['title'] = '搜索';
        $keybord = $request->get('keybord');
        $res = Navigation::getSearch($keybord,config('hint.m_show_num'));
        if ($res){
            foreach ($res as $v){
                $nav = Navigation::find($v->nav_id);
                if ($nav){
                    $v->n_name = $nav->n_name;
                }else{
                    $v->n_name = '未知';
                }
            }
        }
//        $article =  Article::search($keybord);
//        if ($article){
//            foreach ($article as $v){
//                $nav = Navigation::find($v->nav_id);
//                $v->n_name = $nav->n_name;
//                $v->type = 1;
//                $v->publish_time = Helper::getDifferenceTime($v->publish_time);
//            }
//        }
//        $video = Video::search($keybord);
//        if ($video){
//            foreach ($video as $v){
//                $nav = Navigation::find($v->nav_id);
//                $v->n_name = $nav->n_name;
//                $v->type = 2;
//                $v->publish_time = Helper::getDifferenceTime($v->publish_time);
//            }
//        }
//        $data['res'] = array_merge($article,$video);
        $data['res'] = $res;
        $data['keybord'] = $keybord;

        $hotbot = Hotbot::where('name',$keybord)->first();
        if ($hotbot){
            $update['value'] = $hotbot->value + 1;
            Hotbot::find($hotbot->id)->update($update);
        }
    //    dd($data);
        return view('Mobile.Index.doSearch',compact('data',$data));
    }
}
