<?php

namespace App\Models;

use App\Services\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Navigation extends Model
{
    protected $table = 'navigation';

    protected $fillable = ['parent_id','n_name','sort'];

    //获取全部并转为数组
    public static function getAll(){
        return self::get()->toArray();
    }

    //获取导航
    public static function getNav(){
        $nav = self::orderBy('sort','desc')->orderBy('created_at')->get()->toArray();
        return Helper::_tree_json($nav);
    }

    //获取二级导航
    public static function getNavTwo($parent_id){
        return self::orderBy('sort','desc')->orderBy('created_at')->where('parent_id',$parent_id)->get();
    }

    //同时获取文章跟视频(按导航)
    public static function getArticleVideo($nids,$num,$start=0){
        $where = 'WHERE t.nav_id IN ('.$nids.')';
        $res = DB::select('SELECT * FROM (SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type,labels FROM hg_article UNION ALL 
                                                SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type,labels FROM hg_video ) t 
                                               '.$where.' ORDER BY t.publish_time DESC LIMIT '.$start.','.$num);
        return $res;
    }

    //视频文章获取（根据分类）
    public static function getCateAV($cgid,$num,$start=0){
        if($cgid != 0){
            $where = 'WHERE t.cg_id='.$cgid;
        }else{
            $where = '';
        }
        $res = DB::select('SELECT * FROM (SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type FROM hg_article UNION ALL 
                                                SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type FROM hg_video ) t 
                                               '.$where.' ORDER BY t.publish_time DESC LIMIT '.$start.','.$num);
        return $res;
    }

    //按标题获取相关的信息
    public static function getSearchTitle($title){
        $res = DB::select('SELECT * FROM (SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type,content FROM hg_article UNION ALL 
SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type,content FROM hg_video ) t WHERE t.title LIKE "%'.$title.'%" ORDER BY t.publish_time DESC;');
        return $res;
    }

    //搜索
    public static function getSearch($keyword,$num,$start=0){
        $res = DB::select('SELECT * FROM (SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type,content FROM hg_article UNION ALL 
                                                SELECT id,nav_id,cg_id,title,cover,intro,publish_time,type,content FROM hg_video ) t 
                                                WHERE (t.title LIKE "%'.$keyword.'%" OR t.content LIKE "'.$keyword.'") ORDER BY t.publish_time DESC LIMIT '.$start.','.$num);
        return $res;
    }
}
