<?php

namespace App\Http\Controllers\Home;

use App\Http\Resources\view;
use App\Models\Advertising;
use App\Models\Article;
use App\Models\Category;
use App\Models\Choiceness;
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

        //导航
        $data['navig'] = Navigation::getNav();

        //广告
        $data['ind_vid_adv'] = Advertising::getAdver(1,1);
        $data['ind_sil_adv'] = Advertising::getAdver(2,5);
        $data['ind_rig_adv'] = Advertising::getAdver(3,3);

        //分类
        $cate = Category::all()->toArray();
        $zuixin = array('id'=>0,'cg_name'=>'最新推荐',"sort"=>100,'status'=>1,'created_at'=>'2018-08-02 08:09:54','updated_at'=>'2018-08-02 08:09:54');
        array_unshift($cate,$zuixin);
        foreach ($cate as &$c){
            if($c['id'] ==0){
                $c['content'] = Article::getArticleVideo($c['id'],config('hint.show_num'));
                foreach ($c['content'] as $cont){
                    $nav = Navigation::find($cont->nav_id);
                    if($nav['id'] == 1){
                        $cont->n_name = '';
                    }else{
                        $cont->n_name = $nav->n_name;
                    }
                }
            }else{
                $c['content'] = [];
            }

        }
        $data['cate'] = $cate;
        //精选
        $data['choi'] = Choiceness::getChoi(8);

        //导师与学员
        $data['tutor'] = TutorStudent::getIndexShow();
        /*foreach ($data['tutor'] as $tutor){
            $tutor->classic_quote= explode('；',$tutor->classic_quote);
        }*/
//        dd($data);
        return view('Home.Index.index',compact('data',$data));
    }

    //重定向
    public function transmit($oneId,$secId){
        switch ($oneId){
            case 2:
                //品牌节目
                return redirect('brand/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 5:
                //嘉宾大学
                return redirect('university/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 6:
                //嘉宾峰会
                return redirect('summit/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 3:
                //导师与学员
                return redirect('tutorStudent/oneId/'.$oneId.'/secId/'.$secId);
                break;
            case 4:
                //关于我们
                return redirect('aboutUs/oneId/'.$oneId.'/secId/'.$secId);
                break;
            default:
                //首页
                return redirect('/');
                break;
        }
    }

    //品牌节目
    public function brand($oneId,$secId){
        $data['title'] = '品牌节目';
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $twoNav) {
            if ($twoNav->id == 9) {
                //企业纪录片
//                $twoNav->video = Video::orderBy('created_at','desc')->where('nav_id', $twoNav->id)->limit(3)->get();
                $twoNav->video = Video::getNavigation($twoNav->id,3);
                //相关推荐
                $lables = '';
                foreach ($twoNav->video as $v){
                    $lables .= $v->labels.',';
                }
                $labArr = explode(',',$lables);
                array_pop($labArr);
                $labArr1 = array_flip($labArr);
                $labArr2 = array_flip($labArr1);
                $labStr = implode(',',$labArr2);
                $twoNav->like = Video::guessLike($labStr,8);
            } else {
                //其他文章部分getNavTwo
//                $threeNav = Navigation::orderBy('sort', 'desc')->orderBy('created_at')->where('parent_id', $twoNav->id)->get();
                $threeNav = Navigation::getNavTwo($twoNav->id);
                foreach ($threeNav as $art) {
                    $art->article = Navigation::getArticleVideo($art->id,3);
                    foreach ($art->article as $v){
                        $cate = Category::find($v->cg_id);
                        $v->cg_name = $cate->cg_name;
                    }
                }
                $twoNav->threeNav = $threeNav;

            }
        }
        //我有嘉宾顶部广告位 4
        $data['adver'] = Advertising::getAdver(4,1);

//        dd($data);
        return view('Home.Index.brand',compact('data',$data));
    }

    //嘉宾大学
    public function university($oneId,$secId){
        $data['title'] = '嘉宾大学';
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $twoNav) {
            $threeNav = Navigation::orderBy('sort', 'desc')->orderBy('created_at')->where('parent_id', $twoNav->id)->get();
            foreach ($threeNav as $art) {
                $art->article = Navigation::getArticleVideo($art->id,3);
                foreach ($art->article as $v){
                    $cate = Category::find($v->cg_id);
                    $v->cg_name = $cate->cg_name;
                }
            }
            $twoNav->threeNav = $threeNav;
        }
        if($oneId==5){
            //嘉宾派顶部广告位 5
            $data['adver_jbp'] = Advertising::getAdver(5,1);
            //国际课程顶部广告位 6
            $data['adver_gjkc'] = Advertising::getAdver(6,1);
            $data['adver'] = [];
        }else{
            //嘉宾峰会顶部广告位 7
            $data['adver'] = Advertising::getAdver(7,1);
        }

        return view('Home.Index.university',compact('data',$data));
    }

    //嘉宾峰会
    public function summit($oneId){
        $data['title'] = '嘉宾峰会';
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $twoNav) {
            $twoNav->article = Navigation::getArticleVideo($twoNav->id,3);
            foreach ($twoNav->article as $v){
                $cate = Category::find($v->cg_id);
                $v->cg_name = $cate->cg_name;
            }
        }
        //嘉宾峰会顶部广告位 7
        $data['adver'] = Advertising::getAdver(7,1);
//        dd($data);
        return view('Home.Index.summit',compact('data',$data));
    }

    //导师与学员
    public function tutorStudent($oneId,$secId){
        $data['title'] = '导师与学员';
        $data['secId'] = $secId;
        //导航
        $data['navig'] = Navigation::getNav();
        //二级导航
        $data['towNav'] = Navigation::getNavTwo($oneId);
        foreach ($data['towNav'] as $twoNav){
            if($twoNav->id == $data['secId']){
                if ($twoNav->id ==11){
                    $twoNav->user = TutorStudent::getPeople(1,config('hint.ts_show_tust'),0);
                }else{
                    $twoNav->user = TutorStudent::getPeople(2,config('hint.ts_show_tust'),0);
                }
            }else{
                $twoNav->user = [];
            }

        }
//        dd($data);
        return view('Home.Index.tutorStudent',compact('data',$data));
    }

    //关于我们
    public function aboutUs($oneId,$secId){
        $data['title'] = '关于我们';
        $data['secId'] = $secId;
        //导航
        $navig = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $data['navig'] = Helper::_tree_json($navig);
        //二级导航
        $data['towNav'] = Navigation::orderBy('sort','desc')->orderBy('created_at')->where('parent_id',$oneId)->get();
        foreach ($data['towNav'] as $towNav){
            $towNav->art = Article::where('nav_id',$towNav->id)->get()->toArray();
        }
        $data['hzjg'] = json_encode(config('hint.hzjg'));
        $data['hzmt'] = json_encode(config('hint.hzmt'));
//                dd($data);

        return view('Home.Index.aboutUs',compact('data',$data));
    }

    //三级列表
    public function threeList($pid,$id){
        $navObj = Navigation::find($pid);
        $data['title'] = $navObj->n_name;
        $data['id'] = $id;
        //导航
        $navig = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $data['navig'] = Helper::_tree_json($navig);
        //三级导航
        $data['thrNav'] = Navigation::orderBy('sort','desc')->orderBy('created_at')->where('parent_id',$pid)->get();
        $lables = '';
        foreach ($data['thrNav'] as $thrNav){
            $thrNav->art = Navigation::getArticleVideo($thrNav->id,10);
            foreach ($thrNav->art as $v){
                $lables .= $v->labels.',';
            }
        }
        $labArr = explode(',',$lables);
        array_pop($labArr);
        $labArr1 = array_flip($labArr);
        $labArr2 = array_flip($labArr1);
        $labStr = implode(',',$labArr2);
        $data['like'] = Article::guessLike($labStr,8);
//        dd($data);
        return view('Home.Index.threeList',compact('data',$data));
    }

    //文章详情
    public function article($id){
        //导航
        $navig = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $data['navig'] = Helper::_tree_json($navig);

        $data['article'] = Article::find($id);
        $data['article'] -> content = str_replace('http://tx3.ijiabin.net','https://www.ijiabin.com',$data['article'] -> content);
//        dd($data);
        //当前导航
        $nav = Navigation::select('n_name')->find($data['article']->nav_id)->toArray();
        $data['article'] -> nav_name = $nav['n_name'];
        //当前分类
        $cate = Category::select('cg_name')->find($data['article']->cg_id)->toArray();
        $data['article'] -> cg_name = $cate['cg_name'];
        //时间
        $data['article'] -> push = Helper::getDifferenceTime($data['article']->publish_time);
        //上一篇，下一篇
        $data['prev'] = Article::prev($id,$data['article']->nav_id);
        $data['next'] = Article::next($id,$data['article']->nav_id);

        //编辑精选
        $data['choiceness'] = Choiceness::getChoi(8);
        //猜你喜欢
        $data['like'] = Article::guessLike($data['article']->labels,3);
        $data['title'] = $data['article']->title.'_嘉宾传媒';

//        dd($data);
        return view('Home.Index.article',compact('data',$data));
    }

    //视频详情
    public function video($id){
        $data['title'] = '视频详情';
        //导航
        $navig = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $data['navig'] = Helper::_tree_json($navig);

        $data['video'] = Video::find($id);
        //当前导航
        $nav = Navigation::select('n_name')->find($data['video']->nav_id)->toArray();
        $data['video'] -> nav_name = $nav['n_name'];
        //当前分类
        $cate = Category::select('cg_name')->find($data['video']->cg_id)->toArray();
        $data['video'] -> cg_name = $cate['cg_name'];
        //时间
        $data['video'] -> push = Helper::getDifferenceTime($data['video']->publish_time);
        //猜你喜欢
        $data['like'] = Video::guessLike($data['video']->labels,3);

        $data['title'] = $data['video']->title.'_嘉宾传媒';
//        dd($data);
        return view('Home.Index.video',compact('data',$data));
    }

    //导师学员详情
    public function tsDetail($id){
        //导航
        $navig = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $data['navig'] = Helper::_tree_json($navig);

        $data['tutorStudent'] = TutorStudent::find($id);
        $data['title'] = $data['tutorStudent']->name;
        $classic_quote = explode('；',$data['tutorStudent']->classic_quote);
        $data['classic_quote']= array_filter($classic_quote);

        //相关内容
        $data['article'] = Article::search($data['tutorStudent']->name);
        //相关推荐(视频)
        $data['video'] = Video::search($data['tutorStudent']->name);
        return view('Home.Index.tsDetail',compact('data',$data));
    }

    //搜索
    public function search(){
        $data['title'] = '搜索';
        $data['hotbot'] = Hotbot::all();
        return view('Home.Index.search',compact('data',$data));
    }

    //搜索执行
    public function doSearch(Request $request){
        //导航
        $navig = Navigation::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        $data['navig'] = Helper::_tree_json($navig);

        $keybord = $request->get('keybord');
        $res = Navigation::getSearch($keybord,config('hint.show_num'));
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
//        dd($res);
//        $article =  Article::search($keybord);
//        if ($article){
//            foreach ($article as $v){
//                $nav = Navigation::find($v->nav_id);
//                if($nav){
//                    $v->n_name = $nav->n_name;
//                }else{
//                    $v->n_name = '未知';
//                }
//                $v->type = 1;
//            }
//        }
//        $video = Video::search($keybord);
//        if ($video){
//            foreach ($video as $v){
//                $nav = Navigation::find($v->nav_id);
//                if($nav){
//                    $v->n_name = $nav->n_name;
//                }else{
//                    $v->n_name = '未知';
//                }
//
//                $v->type = 2;
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
        //编辑精选
        $data['choi'] = Choiceness::getChoi(8);
//        dd($data);
        return view('Home.Index.doSearch',compact('data',$data));
    }

    //广告链接
    public function getHref($id){

        return view('Home.Index.href');
    }
    /*
     * ajax返回数据
     * */
    public function getCategoryPage(Request $request){
        $cgid = $request->get('cgid');
        $page = $request->get('page');
        $res = Article::getArticleVideo($cgid,config('hint.show_num'),$page);
        if($res){
            foreach ($res as $art){
                $nav = Navigation::find($art->nav_id);
                if ($nav->id == 1){
                    $art->n_name = '';
                }else{
                    $art->n_name = $nav->n_name;
                }

                if ($art->type==1){
                    $art->url = url('article/id/'.$art->id);
                }else{
                    $art->url = url('video/id/'.$art->id);
                }
                $art->cover = asset($art->cover);
            }
        }
        return response($res);
    }
}
