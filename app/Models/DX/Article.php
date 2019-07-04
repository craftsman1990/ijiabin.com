<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = 'dx_article';

    protected $fillable = ['title','type','duration','label_id','tag','looks','column_id','cg_id','author','status','author','publish_time','intro','content','cover'];


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
            ->select('id','cover','title','intro','label_id','duration','looks','column_id')
            ->where(['cg_id'=>$cg_id,'status'=>1])
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
            if (empty($data)) {
                return [];
            }
            //根据标签id获取标签集合
        foreach ($data as $key => $v) {
            //获取标签排序
            $labels = DB::table('dx_label_article')
            ->select('aid','label_id')
            ->where('aid','=',$v->id)
            ->orderBy('rank','desc')
            ->get()
            ->toArray();
            if (empty($labels)) {
               $label = [];
            }else{
                //循环遍历标签
              $i = 0;
              foreach ($labels as $keys => $val) {
                  if ($i>5) {
                      continue;
                  }
                  $label[] = DB::table('labels')
                  ->select('id','name')
                  ->where('id','=',$val->label_id)
                  ->first();
                $i++;
              }
            }
            //判断图片是否是绝对路径
            if (preg_match('/(http:\/\/)|(https:\/\/)/i',$v->cover)) {
                $cover = $v->cover;
            }else{
                $cover = url($v->cover);

            }
            if (!preg_match('/(https:\/\/)/i',$cover)) {
              $cover = str_replace("http","https",$cover);
            }
            //根据栏目id获取栏目
            $column[] = DB::table('dx_column')
            ->select('id','title')
            ->where(['id'=>$v->column_id,'status'=>1])->first();
            $result[$key]['id'] = $v->id;
            $result[$key]['cover'] = $cover;
            $result[$key]['title'] = $v->title;
            $result[$key]['intro'] = $v->intro;
            $result[$key]['duration'] = $v->duration;
            $result[$key]['looks'] = $v->looks;
            $result[$key]['labels'] = $label;
            $result[$key]['column'] = empty($column[0])?[]:$column;
            $label = [];
            $column = [];
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
            ->leftJoin('dx_article_blade', 'dx_article.id', '=', 'dx_article_blade.aid')
            ->select('aid','cover','title','content','label_id','duration','looks','pic_info','video_info','dx_article.created_at','cg_id','intro','tag','column_id')
            ->where('dx_article.id','=',$aid)
            ->first();
            if (empty($data)) {
                return [];
            }
            //获取标签排序
            $labels = DB::table('dx_label_article')
            ->select('aid','label_id')
            ->where('aid','=',$aid)
            ->orderBy('rank','desc')
            ->get()
            ->toArray();
            //循环遍历标签
            if (empty($labels)) {
               $label = [];
            }else{
                //循环遍历标签
              $i = 0;
              foreach ($labels as $keys => $val) {
                  if ($i>5) {
                      continue;
                  }
                  $label[] = DB::table('labels')
                  ->select('id','name')
                  ->where('id','=',$val->label_id)
                  ->first();
                $i++;
              }
            }
        //获取视频地址
        if (!empty($data->video_info)) {
            $video_url = json_decode($data->video_info,true)['address'];
        }else{
            $video_url = '';
        }
        //判断图片是否是绝对路径
        if (preg_match('/(http:\/\/)|(https:\/\/)/i',$data->cover)) {
            $cover = $data->cover;
        }else{
            $cover = url($data->cover);

        }
        if (!preg_match('/(https:\/\/)/i',$cover)) {
              $cover = str_replace("http","https",$cover);
        }
        //根据栏目id获取栏目
        $column[] = DB::table('dx_column')
        ->select('id','title','cover')
        ->where(['id'=>$data->column_id,'status'=>1])->first();
        $result['id'] = $data->aid;
        $result['cover'] = $cover;
        $result['title'] = $data->title;
        $result['content'] = $data->content;
        $result['duration'] = $data->duration;
        $result['type'] = $data->cg_id;
        $result['looks'] = $data->looks;
        $result['intro'] = $data->intro;
        $result['created_at'] = $data->created_at;
        $result['video_url'] = $video_url;
        $result['tag'] = $data->tag;
        $result['labels'] = $label;
        $result['column'] = empty($column[0])?[]:$column;
        $label = [];
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
           $where = ['status'=>1];
        }
        // DB::connection()->enableQueryLog();
         $data = DB::table('dx_label_article')
            ->join('dx_article', 'dx_label_article.aid', '=', 'dx_article.id')
            ->select('id','cover','title','content','duration','looks','dx_article.created_at','intro')
            ->where('dx_label_article.label_id','=',$label_id)
            ->where($where)
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
        foreach ($data as $key => $v) {
            //判断图片是否是绝对路径
            if (preg_match('/(http:\/\/)|(https:\/\/)/i',$v->cover)) {
                $cover = $v->cover;
            }else{
                $cover = url($v->cover);
            }
            if (!preg_match('/(https:\/\/)/i',$cover)) {
              $cover = str_replace("http","https",$cover);
            }
            $data[$key]->cover = $cover;
        }
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
           $where = ['status'=>1];
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
    })->orderBy('id','desc')
              ->select('id','title','intro','content','created_at','type','cover','duration')
              ->offset($offset)
              ->limit($limit)
              ->get();
      //获取图片路径
      if ($ret) {
           foreach ($ret as $key => $v) {
            //判断图片是否是绝对路径
            if (preg_match('/(http:\/\/)|(https:\/\/)/i',$v->cover)) {
                $cover = $v->cover;
            }else{
                $cover = url($v->cover);
            }
            if (!preg_match('/(https:\/\/)/i',$cover)) {
              $cover = str_replace("http","https",$cover);
            }
            $ret[$key]->cover = $cover;
        }
      }
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
         $labels = DB::table('dx_label_article')
            ->select('aid','label_id')
            ->where('aid','=',$aid)
            ->orderBy('rank','desc')
            ->get()
            ->toArray();
        if (empty($labels)) {
            return [];
        }
        $arr = [];
        foreach ($labels as $key => $v) {
            $label = DB::table('dx_label_article')
            ->select('aid')
            ->where('label_id','=',$v->label_id)
            ->orderBy('rank','desc')
            ->get()
            ->toArray();
            $arr = array_merge_recursive($arr,$label);
        }
        $arr = array_unique($arr,SORT_REGULAR);
        //根据标签获取推荐内容
        $article = [];
        foreach ($arr as $k => $val) {
          $articles = Article::where(['id'=>$val->aid,'status'=>1])->select('id','title','duration','cover','looks','intro','label_id','type','created_at')
          ->where('id','!=',$aid)
          ->get()
          ->toArray();
            $article = array_merge_recursive($article,$articles);
        }
        //数组排序
        $id = array_column($article,'id');
        array_multisort($id,SORT_DESC,$article);
        $result = array_slice($article,0,16);
        foreach ($result as $ks => $value) {
           if (preg_match('/(http:\/\/)|(https:\/\/)/i',$value['cover'])) {
                $cover = $value['cover'];
            }else{
                $cover = url($value['cover']);
            }
            if (!preg_match('/(https:\/\/)/i',$cover)) {
              $cover = str_replace("http","https",$cover);
            }
            $result[$ks]['cover'] = $cover;
        }
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
       $recommend_id = 1;
        //获取精品推荐id
        $recommend_ids = DB::table('dx_recommend_article')
            // ->join('dx_recommend_article', 'dx_recommend.id', '=', 'dx_recommend_article.recommend_id')
            ->select('aid','created_at')
            ->where(['recommend_id'=>$recommend_id])
            ->orderBy('created_at','desc')
            // ->limit(16)
             ->get()
            ->toArray();
        //根据推荐id获取推荐内容
        $arr = [];
        foreach ($recommend_ids as $k => $v) {
            $article = Article::where(['id'=>$v->aid,'status'=>1,'type'=>$type])->select('id','title','duration','cover','looks','intro','label_id')->get()->toArray();
            $arr = array_merge_recursive($arr,$article);
        }
        $arr = array_slice($arr,0,16);
        $i = 0;
        foreach ($arr as $key => $value) {
            //获取标签排序
            $labels = DB::table('dx_label_article')
            ->select('aid','label_id')
            ->where('aid','=',$value['id'])
            ->orderBy('rank','desc')
            ->get()
            ->toArray();
            if (empty($labels)) {
                $label = [];
            }else{
                //循环遍历标签
              $i = 0;
              foreach ($labels as $keys => $val) {
                  if ($i>5) {
                      continue;
                  }
                  $label[] = DB::table('labels')
                  ->select('id','name')
                  ->where('id','=',$val->label_id)
                  ->first();
                $i++;
              }
            }
            //判断图片是否是绝对路径
            if (preg_match('/(http:\/\/)|(https:\/\/)/i',$value['cover'])) {
                $cover = $value['cover'];
            }else{
                $cover = url($value['cover']);
            }
            if (!preg_match('/(https:\/\/)/i',$cover)) {
              $cover = str_replace("http","https",$cover);
            }
            $arr[$key]['cover'] = $cover;
            $arr[$key]['labels'] = $label;
            $label = [];
        }
        return $arr;
    }

     /*
    * 后台查询
    * */
        public static function getIndex($where,$like){
            if($where['cg_id'] == 0  && $like != null){
                $res = self::where('title','like','%'.$like.'%')->orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            }elseif ($where['cg_id'] != 0  && $like == null){
                if ($where['cg_id'] != 0){
                    $arr['cg_id'] = $where['cg_id'];
                }

                $res = self::where($arr)->orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            }elseif($where['cg_id'] != 0  && $like != null){
                if ($where['cg_id'] != 0){
                    $arr['cg_id'] = $where['cg_id'];
                }

                $res = self::where($arr)->where('title','LIKE','%'.$like.'%')->orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            }else{
                $res = self::orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            }
            return $res;
        }

        /*
        * 后台推荐位查询
        * */
        public static function getRecommendList($where,$like)
        {
            if($where['rec_id'] == 0 && $where['type'] == 0  && $like != null){
                $res = DB::table('dx_recommend_article')
                    ->Join('dx_article','dx_article.id','=','dx_recommend_article.aid')
                    ->Join('dx_recommend','dx_recommend.id','=','dx_recommend_article.recommend_id')
                    ->Join('category','dx_article.cg_id','=','category.id')
                    ->select('dx_article.id','dx_recommend_article.recommend_id','dx_article.title','category.cg_name','dx_article.status','dx_article.type','dx_recommend.title as re_name','dx_article.created_at')
                    ->where('dx_article.title','like','%'.$like.'%')
                    ->orderBy('dx_article.created_at','desc')
                    ->paginate(config('hint.a_num'));
            }elseif ( ($where['rec_id'] != 0 || $where['type']!=0)  && $like == null){

                if ($where['rec_id'] != 0 ){
                    $arr['dx_recommend_article.recommend_id']= $where['rec_id'];
                }

                if ($where['type']!=0){
                    $arr['dx_article.type'] = $where['type'];
                }
                $res = DB::table('dx_recommend_article')
                    ->Join('dx_article','dx_article.id','=','dx_recommend_article.aid')
                    ->Join('dx_recommend','dx_recommend.id','=','dx_recommend_article.recommend_id')
                    ->Join('category','dx_article.cg_id','=','category.id')
                    ->select('dx_article.id','dx_recommend_article.recommend_id','dx_article.title','category.cg_name','dx_article.status','dx_article.type','dx_recommend.title as re_name','dx_article.created_at')
                    ->where($arr)
                    ->orderBy('dx_article.created_at','desc')
                    ->paginate(config('hint.a_num'));
            }elseif(($where['rec_id'] != 0 || $where['type'] !=0)  && $like != null){
                if ($where['rec_id'] != 0 ){
                    $arr['dx_recommend_article.recommend_id']= $where['rec_id'];
                }

                if ($where['type']!=0){
                    $arr['dx_article.type'] = $where['type'];
                }

                $res = DB::table('dx_recommend_article')
                    ->Join('dx_article','dx_article.id','=','dx_recommend_article.aid')
                    ->Join('dx_recommend','dx_recommend.id','=','dx_recommend_article.recommend_id')
                    ->Join('category','dx_article.cg_id','=','category.id')
                    ->select('dx_article.id','dx_recommend_article.recommend_id','dx_article.title','category.cg_name','dx_article.status','dx_article.type','dx_recommend.title as re_name','dx_article.created_at')
                    ->where($arr)
                    ->where('dx_article.title','like','%'.$like.'%')
                    ->orderBy('dx_article.created_at','desc')
                    ->paginate(config('hint.a_num'));
            }else{
                $res = DB::table('dx_recommend_article')
                    ->Join('dx_article','dx_article.id','=','dx_recommend_article.aid')
                    ->Join('dx_recommend','dx_recommend.id','=','dx_recommend_article.recommend_id')
                    ->Join('category','dx_article.cg_id','=','category.id')
                    ->select('dx_article.id','dx_recommend_article.recommend_id','dx_article.title','category.cg_name','dx_article.status','dx_article.type','dx_recommend.title as re_name','dx_article.created_at')
                    ->orderBy('dx_article.created_at','desc')
                    ->paginate(config('hint.a_num'));
            }
            return $res;

        }
                //根据栏目id查询相应课程
        public static function ColumnList($column_id,$page,$limit)
        {
          //获取栏目信息
          $column = DB::table('dx_column')
            ->select('id','title','cover')
            ->where(['status'=>1,'id'=>$column_id])->first();
          if (empty($column)) {
            return [];
          }
          //根据栏目id获取课程
           $offset = ($page-1)*$limit;
           $where = ['column_id'=>$column_id,'status'=>1];
           $data = DB::table('dx_article')
              ->select('id','cover','title','content','duration','looks','created_at','intro')
              ->where($where)
              ->orderBy('id','desc')
              ->offset($offset)
              ->limit($limit)
              ->get()
              ->toArray();
          if (empty($data)) {
             $data = [];
          }
          foreach ($data as $key => $v) {
              //判断图片是否是绝对路径
              if (preg_match('/(http:\/\/)|(https:\/\/)/i',$v->cover)) {
                  $cover = $v->cover;
              }else{
                  $cover = url($v->cover);
              }
              if (!preg_match('/(https:\/\/)/i',$cover)) {
                $cover = str_replace("http","https",$cover);
              }
              $data[$key]->cover = $cover;
          }
          if (preg_match('/(http:\/\/)|(https:\/\/)/i',$column->cover)) {
                  $column_cover = $column->cover;
              }else{
                  $column_cover = url($column->cover);
          }
          $result['id'] = $column->id;
          $result['title'] = $column->title;
          $result['cover'] = $column_cover;
          $result['column_list'] = $data;
         return $result;
        }
}
