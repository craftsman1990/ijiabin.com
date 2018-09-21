<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    protected $table = 'video';

    protected $fillable = ['title','address','duration','cover','cg_id','nav_id','labels','status','author','publish_time','content','intro'];

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
    //猜你喜欢
    public static function guessLike($labels,$limit=8){
        $labelArr = explode(',',$labels);
        $labwhere = '';
        foreach ($labelArr as &$v){
            if ($labwhere){
                $labwhere .= 'or instr(labels, "'.$v.'") > 0 ';
            }else{
                $labwhere .= 'instr(labels,"'.$v.'") > 0 ';
            }
        }
        $vid = DB::select('SELECT id,nav_id,title,cover,publish_time FROM hg_video WHERE '.$labwhere.' ORDER BY publish_time DESC LIMIT '.$limit);
        return $vid;
    }

    //相关内容
    public static function search($keybord){
        $vid = DB::select('SELECT id,nav_id,title,cover,intro,publish_time FROM hg_video WHERE concat(title,intro) LIKE "%'.$keybord.'%"');
        return $vid;
    }

    //分类获取视频
    public static function getCategory($cgid,$num,$start=0){
        $vid = self::where('cg_id',$cgid)->orderBy('publish_time','desc')->limit($start,$num)->get();
        return $vid;
    }

    //根据导航获取(参数：导航id，获取条数，第几条开始)
    public static function getNavigation($nav_id,$num,$start=0){
        return self::orderBy('created_at','desc')->where('nav_id', $nav_id)->skip($start)->take($num)->get();
    }
}
