<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = 'dx_article';

    protected $fillable = ['title','type','duration','label_id','tag','looks','cg_id','nav_id','author','status','author','publish_time','intro','content','cover'];


    /**
     * 方法描述：检查$category_id下今天是否有同样标题的新闻，有则返回false
     * @param $title
     * @param $category_id
     * @param string $news_id
     * @return bool
     * 注意：
     */
    public static function checkTitle($title,$category_id,$news_id=''){
        $query = Article::where(['cg_id'=>$category_id,'title'=>$title,'status'=>1])->first();
        if ($query) {
            return false;
        }
        return true;
    }

    /**
     * 根据类别获取课程列表
     * @param  $cg_id 分类id
     * @param  $page  页码数
     * @param  $limit 分页条数
     * @return array
     */
    public static function getCourseList($cg_id,$page,$limit)
    {
        $offset = ($page-1)*$limit;
        $data = DB::table('dx_article')
            ->select('id','cover','title','intro','label_id','duration','looks')
            ->where(['cg_id'=>$cg_id,'status'=>1])
            ->orderBy('created_at','desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
            if (empty($data)) {
                return [];
            }
            //根据标签id获取标签集合
        foreach ($data as $key => $v) {
            $label_id = explode(',', $v->label_id);
            foreach ($label_id as $val) {
                $labels[] = DB::table('labels')
                ->select('id','name')
                ->where('id','=',$val)
                ->first();
            }
            $result[$key]['id'] = $v->id;
            $result[$key]['cover'] = $v->cover;
            $result[$key]['title'] = $v->title;
            $result[$key]['intro'] = $v->intro;
            $result[$key]['duration'] = $v->duration;
            $result[$key]['looks'] = $v->looks;
            $result[$key]['labels'] = $labels;
            $labels = [];
        }
        return $result;
    }

    /**
     * 获取课程详情
     * @param  [type] $aid 课程id
     * @return array
     */
    public static function getCourseDetail($aid)
    {
       $data = DB::table('dx_article')
            ->join('dx_article_blade', 'dx_article.id', '=', 'dx_article_blade.aid')
            ->select('aid','cover','title','content','label_id','duration','looks','pic_info','video_info','created_at','cg_id','intro')
            ->where('dx_article.id','=',$aid)
            ->first();
            if (empty($data)) {
                return [];
            }
            $label_id = explode(',', $data->label_id);
            $i = 0;
            foreach ($label_id as $k => $val) {
                if ($i>5) {
                    continue;
                }
                $labels[] = DB::table('labels')
                ->select('id','name')
                ->where('id','=',$val)
                ->first();
                $i++;
        }
        //获取视频地址
        if (!empty($data->video_info)) {
            $video_url = json_decode($data->video_info,true)[0]['address'];
        }else{
            $video_url = '';
        }
        $result['id'] = $data->aid;
        $result['cover'] = $data->cover;
        $result['title'] = $data->title;
        $result['content'] = $data->content;
        $result['duration'] = $data->duration;
        $result['type'] = $data->cg_id;
        $result['intro'] = $data->intro;
        $result['created_at'] = $data->created_at;
        $result['video_url'] = $video_url;
        $result['labels'] = $labels;
        return $result;
    }

    /**
     * 根据标签id查询课程列表
     * @param  int $label_id 标签id
     * @param  int $page     页码数
     * @param  int $limit    分页条数
     * @param  string $type   类型：1：文章；2：视频  
     * @return obj
     */
    public static function labelSearch($label_id,$page,$limit,$type='')
    {
        $offset = ($page-1)*$limit;
        if ($type) {
           $where = ['type'=>$type,'status'=>1];
        }else{
           $where = [];
        }
        $data = DB::table('dx_article')
            ->select('id','cover','title','intro','duration','looks','created_at')
            ->whereRaw('FIND_IN_SET(?,label_id)',[$label_id])
            ->where($where)
            ->orderBy('created_at','desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
        return $data; 
    }

    /**
     * 根据关键字搜索
     * @param  [type] $key   关键字
     * @param  [type] $limit 分页条数
     * @param  [type] $page  分页页码数
     * @param  [type] $type 类型：1：文章；2：视频  
     * @return array
     */
    public static function keysSearch($key,$limit,$page,$type='')
    {
        $offset = ($page-1)*$limit;
        if ($type) {
           $where = ['type'=>$type,'status'=>1];
        }else{
           $where = [];
        }
        $ret = Article::where($where)
        ->where(function($query) use($key){
        $query->where('title','like',"%{$key}%")
        ->orWhere(function($query) use($key){
            $query->where('intro','like',"%{$key}%")
            ->orWhere(function($query) use($key){
            $query->where('content','like',"%{$key}%");
        });
        });
    })->orderBy('created_at','desc')
              ->select('id','title','intro','content','created_at','type','cover')
              ->offset($offset)
              ->limit($limit)
              ->get();
      return $ret;
    }
    /**
     * 相关推荐（最多只能返回16条）
     * @param  [type] $aid 课程id
     * @return array
     */
    public static function recommendAtionsList($aid)
    {
        //根据课程id查询标签
        $ret = Article::where(['id'=>$aid,'status'=>1])->select('label_id','id','type')->first();
        $label_id = explode(',',$ret->label_id);
        if (empty($label_id)) {
            return [];
        }
        //根据标签获取推荐内容
        foreach ($label_id as $v) {
          $data[] = DB::table('dx_article')
            ->select('id','cover','title','intro','duration','looks','created_at','label_id','type')
            ->where('id','!=',$ret->id)
            ->where('label_id','LIKE','%'.$v.'%')
            ->orderBy('created_at','desc')
            ->limit(16)
             ->get()
            ->toArray();
        }
        $arr = [];
        //数组去重
        foreach ($data as $key => $value) {
            $arr = array_merge_recursive($arr,$value);
        }
        $new_arr = array_unique($arr,SORT_REGULAR);
        //数组排序
        $id = array_column($new_arr,'id');
        array_multisort($id,SORT_DESC,$new_arr);
        $result = array_slice($new_arr,0,15);
        return $result;
    }

    /**
     * 增加课程播放量
     * @param [type] $aid [description]
     */
    public static function addLooks($aid)
    {
        //获取播放量
        $look = Article::where(['id'=>$aid])->first();
        $look->looks = $look->looks+1;
        if ($look->save()) {
            return ['status'=>1,'msg'=>'记录成功'];
        }
    }
    /**
     * 精品推荐
     * @return array
     */
    public static function recommenDation($type)
    {
        //获取精品推荐id
        $recommend_ids = DB::table('dx_recommend')
            ->join('dx_recommend_article', 'dx_recommend.id', '=', 'dx_recommend_article.recommend_id')
            ->select('aid','rank')
            ->where(['dx_recommend.status'=>1])
            ->orderBy('rank','desc')
            ->limit(16)
             ->get()
            ->toArray();
        // print_r($recommend_ids);die;
        //根据推荐id获取推荐内容
        $arr = [];
        foreach ($recommend_ids as $k => $v) {
            $article = Article::where(['id'=>$v->aid,'status'=>1,'type'=>$type])->select('id','title','duration','cover','looks','intro')->get()->toArray();;
            $arr = array_merge_recursive($arr,$article);
        }
        return $arr;
    }
}
