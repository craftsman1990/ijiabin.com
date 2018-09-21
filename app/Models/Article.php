<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = 'article';

    protected $fillable = ['nav_id','cg_id','labels','cover','title','intro','author','publish_time','status','content'];


    /*
     * 后台查询
     * */
    public static function getIndex($where,$like){
       if($where['cg_id'] == 0 && $where['nav_id'] == 0 && $like != null){
           $res = self::where('title','like','%'.$like.'%')->orderBy('publish_time','desc')->paginate(config('hint.a_num'));
       }elseif ($where['cg_id'] != 0 || $where['nav_id'] != 0 && $like == null){
           if ($where['cg_id'] != 0){
               $arr['cg_id'] = $where['cg_id'];
           }
           if ($where['nav_id'] != 0){
               $arr['nav_id'] = $where['nav_id'];
           }
           $res = self::where($arr)->orderBy('publish_time','desc')->paginate(config('hint.a_num'));
       }elseif($where['cg_id'] != 0 || $where['nav_id'] != 0 && $like != null){
           if ($where['cg_id'] != 0){
               $arr['cg_id'] = $where['cg_id'];
           }
           if ($where['nav_id'] != 0){
               $arr['nav_id'] = $where['nav_id'];
           }
           $res = self::where($arr)->where('title','LIKE','%'.$like.’%‘)->orderBy('publish_time','desc')->paginate(config('hint.a_num'));
       }else{
           $res = self::orderBy('publish_time','desc')->paginate(config('hint.a_num'));
       }
        return $res;
    }

    /*
     * 前端查询
     * */
    //上一篇
    public static function prev($id,$nav_id){
        $article = DB::select("SELECT id, title FROM hg_article WHERE id = (SELECT max(id) FROM hg_article WHERE id < $id AND nav_id=$nav_id)");
        return $article;
    }

    //下一篇
    public static function next($id,$nav_id){
        $article = DB::select("SELECT id, title FROM hg_article WHERE id = (SELECT min(id) FROM hg_article WHERE id > $id AND nav_id=$nav_id)");
        return $article;
    }

    //猜你喜欢
    public static function guessLike($labels,$limit=8){
//        DB::connection()->enableQueryLog(); // 开启查询日志
        $labelArr = explode(',',$labels);
        $labwhere = '';
        foreach ($labelArr as &$v){
            if ($labwhere){
                $labwhere .= 'or instr(labels, "'.$v.'") > 0 ';
            }else{
                $labwhere .= 'instr(labels,"'.$v.'") > 0 ';
            }
        }
        $art = DB::select('SELECT id,nav_id,title,cover,publish_time FROM hg_article WHERE '.$labwhere.'  ORDER BY publish_time DESC LIMIT '.$limit);
//        $art = DB::select("SELECT id,title,cover FROM hg_article WHERE labels like '%流浪汉%'");
//        dd($art);
//        $art = self::select('id','title','cover')->where('labels','like',$labelArr)->limit(8);
//        $bindings = $art->getBindings();
//        $sql = str_replace('?', '%s', $art->toSql());
//        $sql = sprintf($sql, ...$bindings);
//        $queries = DB::getQueryLog();
//        dd($queries);
//        dd($art);
        return $art;
    }

    //相关内容
    public static function search($keybord){
        $art = DB::select('SELECT id,nav_id,title,cover,intro,publish_time FROM hg_article WHERE concat(title,content) LIKE "%'.$keybord.'%"');
        return $art;
    }

    //分类获取文章
    public static function getCategory($cgid,$num,$start=0){
        $art = self::where('cg_id',$cgid)->orderBy('publish_time','desc')->limit($start,$num)->get();
        return $art;
    }

    //视频文章获取（根据分类）
    public static function getArticleVideo($cgid,$num,$start=0){
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
}
