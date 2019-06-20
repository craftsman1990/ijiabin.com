<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\RecommendArticle;
use App\Models\Recommend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Article;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Choiceness;
use App\Models\Label;
use App\Models\Navigation;
use App\Services\Helper;
use App\Services\Upload;
use App\Models\DX\ArticleBlade;
use App\Models\DX\LabelArticle;
use App\Services\Compress;


class ArticleController extends Controller
{
    /**
     * 构造方法
    **/
    public function __construct()
    {
    }

    /**
     * 列表页
     **/
    public function index(Request $request)
    {

        //推荐
        $Recommend =Recommend::select('id')->where('title','精选推荐')->get()->toArray();

        $data['recommend_id'] = isset($Recommend[0]['id'])?$Recommend[0]['id']: 0;

        if ($request->all()){
            $where['cg_id'] = $request->get('cg_id');
            $like = $request->get('title');
            $list = Article::getIndex($where,$like);
            $data['cg_id'] = $where['cg_id'];
            $data['title'] = $like;
        }else{
            $list = Article::orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            $data['cg_id'] = 0;
            $data['title'] = null;
        }
        $list->setPath(config('hint.domain').'admin/jbdx/article?cg_id='.$data['cg_id'].'&title='.$data['title']);
        foreach ($list as $art){
            //分类
            $cate = Category::find($art->cg_id);
            if ($cate){
                $art->cg_name = $cate->cg_name;
            }else{
                $art->cg_name = '未知';
            }
            //精品推荐
            $rec = RecommendArticle::where('aid',$art->id)->where('recommend_id',$data['recommend_id'])->get()->toArray();
            if ($rec){
                $art->rec = 1;
            }else{
                $art->rec = 0;
            }
        }
        //分类
        $data['cate'] = Category::all();
        //推荐
        $Recommend =Recommend::select('id')->where('title','精选推荐')->get()->toArray();

        $data['recommend_id'] = isset($Recommend[0]['id'])?$Recommend[0]['id']: 0;

        return view('Admin.DX.Article.index',compact('list',$list),compact('data',$data));
    }

    /**
     * 添加
     **/
    public function create()
    {
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        return view('Admin.DX.Article.create',compact('data',$data));
    }

    /**
     * 添加视频
     **/
    public function createVideo()
    {
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        return view('Admin.DX.Article.createVideo',compact('data',$data));
    }

    /**
     * 修改视频
     **/
    public function editVideo($id)
    {

        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        $data['video'] = Article::find($id);
        $data['video_info'] = ArticleBlade::where('aid',$id)->first()->toArray();

        $data['video']->address = (json_decode($data['video_info']['video_info']))->address;

        $lables = Helper::strToArr(implode(',',json_decode($data['video']->label_id)),',',':');


        return view('Admin.DX.Article.editVideo',compact('data',$data),compact('lables'));
    }

    /**
     * 执行修改视频
     **/
    public function updateVideo(Request $request,$id)
    {
        $verif = array(
            'title'=>'required',
            'address'=>'required',
            'duration'=>'required|numeric|min:0',
            'cg_id'=>'required|numeric',
            'publish_time'=>'required',
            'content'=>'required',
            'intro'=>'required',
            'label_id'=> 'required'
        );
        $credentials = $this->validate($request,$verif);
        $credentials['address'] = Helper::checkVideoLocal($credentials['address']);
        $credentials['label_id'] = json_encode(explode(',',$credentials['label_id']));
        $credentials['type'] = 2;//标识（1：文章；2：视频）

        $credentials['updated_at'] = date('Y-m-d H:i:s',time());

        $video_info['address'] = $credentials['address'];
        $video_info['duration'] = $credentials['duration'];

        $insert_arr['video_info'] = json_encode($video_info);

        unset($credentials['address']);

        $credentials['tag'] = $request->tag;
        if ($request->author){
            $credentials['author'] = $request->author;
        }
     //  dd($credentials);
        //图像上传
//        if ($request->file('cover')){
        if ($request->cover){
            $pic_path = Upload::baseUpload($request->cover,'upload/DX/Article');
//            $pic_path = Upload::uploadOne   ('Video',$request->file('cover'));
            if ($pic_path){
                $credentials['cover'] = $pic_path;
                //创建缩略图
               // $Compress = new Compress(public_path($credentials['cover']),'0.4');
               // $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
                if (is_file(public_path($request->old_cover))){
                    unlink(public_path($request->old_cover));
                }
                if (is_file(public_path(thumbnail($request->old_cover)))){
                    unlink(public_path(thumbnail($request->old_cover)));
                }
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['cover'] = $request->old_cover;
            if (!is_file(public_path(thumbnail($credentials['cover'])))){
                //创建缩略图
                //$Compress = new Compress(public_path($credentials['cover']),'0.4');
                //$Compress->compressImg(public_path(thumbnail($credentials['cover'])));
            }
        }
        //(Article::find($id)->update($credentials));

        //补全图片url域名链接substr(string,start,length)
        $http_is = substr($credentials['cover'],0,4);
//       // dd($http_is);
        if ($http_is != 'http'){
            $credentials['cover'] =  asset($credentials['cover']);//url($credentials['cover'])
        }

        //开启事务
       // DB::beginTransaction();

        if(Article::find($id)->update($credentials)){

            ArticleBlade::where('aid',$id)->update($insert_arr);
                //提交
            return redirect('admin/jbdx/article')->with('success', config('hint.mod_success'));

        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
;
    }



    /**
     * 执行添加视频
     **/
    public function storeVideo(Request $request)
    {
        $verif = array(
            'title'=>'required',
            'address'=>'required',
            'duration'=>'required|numeric|min:0',
            'cg_id'=>'required|numeric',
            'publish_time'=>'required',
            'cover'=>'required',
            'content'=>'required',
            'intro'=>'required',
            'label_id'=>'required'
        );
        $credentials = $this->validate($request,$verif);
        $credentials['address'] = Helper::checkVideoLocal($credentials['address']);
        $credentials['label_id'] = json_encode(explode(',',$credentials['label_id']));
        $credentials['type'] = 2;//标识（1：文章；2：视频）
        $credentials['created_at'] = date('Y-m-d H:i:s',time());
        $credentials['updated_at'] = date('Y-m-d H:i:s',time());
        //dd($credentials);
        $video_info['address'] = $credentials['address'];
        $video_info['duration'] = $credentials['duration'];

        $insert_arr['video_info'] = json_encode($video_info);

        unset($credentials['address']);

        $credentials['tag'] = $request->tag;
        if ($request->author){
            $credentials['author'] = $request->author;
        }
        //上传图片
        $pic_path = Upload::baseUpload($credentials['cover'],'upload/DX/Article');
//        $pic_path = Upload::uploadOne('Video',$credentials['cover']);
        if ($pic_path){
            $credentials['cover'] = $pic_path;
            //创建缩略图
           // $Compress = new Compress(public_path($credentials['cover']),'0.4');
           // $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }

        //补全图片url域名链接substr(string,start,length)
        $http_is = substr($credentials['cover'],0,4);
//       // dd($http_is);
        if ($http_is != 'http'){
            $credentials['cover'] =  asset($credentials['cover']);//url($credentials['cover'])
        }

        //开启事务
        DB::beginTransaction();
        $article_id = Article::insertGetId($credentials);

        if ($article_id){

            $lablesData = Helper::strToArr(implode(',',json_decode($credentials['label_id'])),',',':');

            //插入标签中间表
            $insert_res = $this->insertDiff($lablesData,$lablesData,$article_id);

            $insert_arr['aid'] = $article_id;
            //插入文章附表
            $insert_blade = ArticleBlade::create($insert_arr);

             //两个相关表添加成功则提交否则回滚
            if ($insert_res && $insert_blade){
                //提交
                DB::commit();
                return redirect('admin/jbdx/article')->with('success', config('hint.add_success'));
            }else{
                //回滚
                return back()->with('hint',config('hint.add_failure'));
            }

        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    /**
     * 执行添加
     **/
    public function store(Request $request)
    {

        $verif = array(
            'title'=>'required',
            'content'=>'required',
            'cg_id'=>'required|numeric',
            'publish_time'=>'required',
            'label_id'=>'required',
            'cover'=>'required',
            'intro'=>'required'
        );
        $credentials = $this->validate($request,$verif);

        $credentials['label_id'] = json_encode(explode(',',$credentials['label_id']));


        $credentials['created_at'] = date('Y-m-d H:i:s',time());
        $credentials['updated_at'] = date('Y-m-d H:i:s',time());
        $credentials['tag'] = $request->tag;
        if ($request->author){
            $credentials['author'] = $request->author;
        }
        //上传图片
        $pic_path = Upload::baseUpload($credentials['cover'],'upload/DX/Article');
//        $pic_path = Upload::uploadOne('Article',$credentials['cover']);
        if ($pic_path){
            $credentials['cover'] = $pic_path;
            //创建缩略图
          //  $Compress = new Compress(public_path($credentials['cover']),'0.4');
          //  $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }

        //补全图片url域名链接substr(string,start,length)
        $http_is = substr($credentials['cover'],0,4);
//       // dd($http_is);
        if ($http_is != 'http'){
            $credentials['cover'] =  asset($credentials['cover']);//url($credentials['cover'])
        }

        DB::beginTransaction();
        $article_id = Article::insertGetId($credentials);

        if ($article_id) {

            $lablesData = Helper::strToArr(implode(',', json_decode($credentials['label_id'])), ',', ':');

            //插入标签中间表
            $insert_res = $this->insertDiff($lablesData, $lablesData, $article_id);
            if ($insert_res){
                DB::commit();
                return redirect('admin/jbdx/article')->with('success', config('hint.add_success'));
            }else{
                return back()->with('hint',config('hint.add_failure'));
            }
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    /**
     * 修改
     **/
    public function edit($id)
    {
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        $data['article'] = Article::find($id);
      //  var_dump(implode(',',json_decode($data['article']->label_id)));die;

        $lables = Helper::strToArr(implode(',',json_decode($data['article']->label_id)),',',':');


        return view('Admin.DX.Article.edit',compact('data',$data),compact('lables'));
    }




    /**
     * [更新交集]
     * @param  [type] $labelData [导入的数据]
     * @param  [type] $data      [交集数据]
     * @param  [type] $aid      [文章ID]
     * @return [type]   boolean         [true/false]
     */

    public function updateIntersection($labelData,$data,$aid)
    {
        $map = [];
        $keys = array_keys($data);

        foreach ($keys as $key =>$value){
              $map[$value] = $labelData[$value];
        }

        dd($map);

        $res =     LabelArticle::batchUpdate('recommend_id','rank',array_keys($map),array_values($map),$aid);

        dd($res);

    }

    /**
     * [插入差集]
     * @param  [type] $excelData [导入的数据]
     * @param  [type] $data      [差集数据]
     * @return [type]   boolean         [true/false]
     */
    public function insertDiff($labelData,$data,$aid)
    {
        $map = [];
        $keys = array_keys($data);
        //var_dump($data); echo "<br/>";
        foreach ($keys as $key =>$value)
        {
            $map[$key]['aid'] = $aid;
            $map[$key]['label_id'] = $value;
            $map[$key]['rank'] = $labelData[$keys[$key]] ;
            $map[$key]['updated_at'] = date('Y-m-d H:i:s',time());
            $map[$key]['created_at'] = date('Y-m-d H:i:s',time());
        }
       // dd($map);

        return LabelArticle::insert($map);
    }

    /**
     * [执行插入，或更新，或删除标签文章关联数据]
     * @param  [type] $request_arr [导入的数据]
     * @param  [type] $id      [数据ID]
     * @return [type]   boolean         [true/false]
     */
    public  function getDiffArr($request_arr,$id)
    {

        $new_arr = Helper::strToArr(implode(',',json_decode($request_arr)),',',':');
        echo "新";
        var_dump($new_arr);echo "<br/>";
        $old_arr =  Article::select('label_id')->where('id',$id)->get()->toArray();
        $old_arr = Helper::strToArr(implode(',',json_decode($old_arr[0]['label_id'])),',',':');
        echo "旧";
        var_dump($old_arr);echo "<br/>";

        //有交集
        $intersect_arr = array_intersect_key($new_arr,$old_arr);
        echo "交集";
        var_dump($intersect_arr);echo "<br/>";
        //差集
        echo "差集";
        $diff_arr = array_diff_key($new_arr,$old_arr);
        var_dump($diff_arr);echo "<br/>";
        echo "第二交集";
        $intersect_arr2 = '';
        var_dump($diff_arr);echo "<br/>";
        die;

        if ($intersect_arr){//有交集,交集执行更新
            //首先执行修改
           // $res = LabelArticle::batchUpdate('label_id','rank',array_keys($intersect_arr),array_values($intersect_arr),$id);
           // dd($res);
        }else{ //没有交集

        }
        dd();
        //向左差集（）
        $left_arr = array_diff($new_arr,$old_arr);
        //向右差集（）
        $right_arr = array_diff($old_arr,$new_arr);

        dd($intersect_arr);
        dd($old_arr);
        $new_arr = Helper::strToArr(implode(',',json_decode($request_arr)),',',':');
        $insert_res = $this->insertDiff($old_arr,$new_arr,$id);
        dd($insert_res);

    }
    /**
     * 执行修改
     **/
    public function update(Request $request,$id)
    {
        $verif = array(
            'title'=>'required',
            'content'=>'required',
            'cg_id'=>'required|numeric',
            'publish_time'=>'required',
            'intro'=>'required',
            'label_id'=>'required'
        );

        $credentials = $this->validate($request,$verif);

        $credentials['label_id'] = json_encode(explode(',',$credentials['label_id']));

        $credentials['updated_at'] = date('Y-m-d H:i:s',time());
        $credentials['tag'] = $request->tag;

        if ($request->author){
            $credentials['author'] = $request->author;
        }
        //图片大小
//        $size = strlen(file_get_contents($request->cover))/1024;

//        dd($size);
        //图像上传
//        if ($request->file('cover')){
        if ($request->cover){
            $pic_path = Upload::baseUpload($request->cover,'upload/DX/Article');
//            $pic_path = Upload::uploadOne('Article',$request->file('cover'));
            if ($pic_path){
                $credentials['cover'] = $pic_path;
                //创建缩略图
               // $Compress = new Compress(public_path($credentials['cover']),'0.4');
               // $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
                if (is_file(public_path($request->old_cover))){
                    unlink(public_path($request->old_cover));
                }
                if (is_file(public_path(thumbnail($request->old_cover)))){
                    unlink(public_path(thumbnail($request->old_cover)));
                }
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['cover'] = $request->get('old_cover');
            if (!is_file(public_path(thumbnail($credentials['cover'])))){
                //创建缩略图
                //$Compress = new Compress(public_path($credentials['cover']),'0.4');
                //$Compress->compressImg(public_path(thumbnail($credentials['cover'])));
            }
        }

        //补全图片url域名链接substr(string,start,length)
        $http_is = substr($credentials['cover'],0,4);
//       // dd($http_is);
        if ($http_is != 'http'){
            $credentials['cover'] =  asset($credentials['cover']);//url($credentials['cover'])
        }
        //dd('aaaaaa');

        //更新标签关联表
       // $res = $this->getDiffArr($credentials['label_id'],$id);
       // dd($res);

        if(Article::find($id)->update($credentials)){
            return redirect('admin/jbdx/article')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }

    }



    /**
     *删除
     **/
    public function destroy($id)
    {
        $Obj = Article::find($id);
        if (!$Obj){
            return back() -> with('hint',config('hint.data_exist'));
        }
        if (Article::destroy($id)){
            if (is_file(public_path($Obj->cover))){
                unlink(public_path($Obj->cover));
            }
            if (is_file(public_path(thumbnail($Obj->cover)))){
                unlink(public_path(thumbnail($Obj->cover)));
            }
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }

     /**
     * 文章导入（公众号）
     * @param category 导入文章类别
     * @param url 需要导入数据url（公总号地址）
     */
    public function add(Request $request)
    {
        //获取添加文章类别（默认是文字案例库）
        if (empty($request->url)) {
            $data['cate'] = Category::select('id','cg_name')->get()->toArray();
            return view('Admin.DX.Article.add',compact('data',$data));
        }else{
            $verif = array(
                'url'=>'required',
                'cg_id'=>'required|numeric'
                );
            $credentials = $this->validate($request,$verif);
            //获取公众号地址请求神箭手抓取内容
            $urls = urlencode($request->url);
            $url = "https://api.shenjian.io/?appid=d8e907db3941eb14c5361030110a5a7e&url=".$urls;
            //获取数据
            $data = file_get_contents($url);
            $result = json_decode($data,true);
            if ($result['error_code']!=0) {
               return back()->with('jbdx',config('jbdx.add_wx_article'));
            }
            if (empty($result['data']['article_title'])) {
                return back()->with('jbdx',config('jbdx.add_wx_article'));
            }
            $result['data']['label'] = Label::select('id','name')->get()->toArray();
            // print_r($result);die;
            return view('Admin.DX.Article.edits',compact('result',$result),compact('lables'));
        }
    }

    /**
     * 内容入库
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function content(Request $request)
    {
       $verif = array(
                'label_id'=>'required',
                );
       $credentials = $this->validate($request,$verif);
       $model = new Article();
       $model_body = new ArticleBlade();
       //获取需要处理数据
       $article['title'] = $request->title;//标题
       $article['cg_id'] = $request->cg_id;//分类id
       //根据分类检测是否有重复标题
       if(!Article::checkTitle($article['title'],$article['cg_id'])){
            return back()->with('jbdx',config('jbdx.check_article'));
       }
       $model->title = $article['title'];
       $model->cg_id = $article['cg_id'];
       $model->type = 1;//1：文章；2：视频
       $model->publish_time = $request->publish_time;//文章的发布时间
       $model->author = $request->author;//文章作者
       $model->intro = $request->intro;//文章介绍
       $model->content = $request->content;//文章内容
       $model->tag = isset($request->tag)? $request->tag : '';//关键字
       //获取标签id
       // if ($request->labels) {
       //     $model->label_id = implode(',',$request->labels);
       // }
       if ($request->label_id) {
           $model->label_id = json_encode(explode(',',$request->label_id));
       }
       $model->cover = isset($request->old_pic) ? $request->old_pic : '';//封面图
       //事务开始
       DB::beginTransaction();
       if (!$model->save()) {
           return back()->with('hint',config('hint.add_failure'));
       }
       $pic = array('cover'=>$model->cover);
       //存储正文
       $model_body->pic_info = json_encode($pic);
       $model_body->aid = $model->id;
       if(!$model_body->save()){
            //回滚事物
            DB::rollBack();
            return back()->with('hint',config('hint.add_failure'));
        }
        //处理标签权重
        $label = explode(',',$request->label_id);
        foreach ($label as $key => $v) {
            $source = explode(':',$v);
            //存储标签文章关联表
            $LabelArticle = new LabelArticle();
            $LabelArticle->aid = $model->id;
            $LabelArticle->label_id = $source[0];
            $LabelArticle->rank = $source[1];
            $LabelArticle->save();
        }
       //提交事务
       DB::commit();
       return redirect('admin/jbdx/article')->with('success', config('hint.add_success'));
    }



    //文章标签数据迁移
    public function transferLabels($id)
    {
        $data =  Article::select('label_id')->find($id)->toArray();

        $lables = Helper::strToArr(implode(',',json_decode($data['label_id'])),',',':');

        $insert_arr = array();
        foreach ($lables as $key=>$value){
            $insert_arr[] = array(
                'aid' => $id,
                'label_id' =>$key,
                'rank' => $value,
                'updated_at'=> date('Y-m-d H:i:s',time()),
                'created_at'=> date('Y-m-d H:i:s',time())
            );
        }
        $res =LabelArticle::insert($insert_arr);

        dd($res);
        //return $res;

    }

    /**
     * [删除差集]
     * @param  [type] $labelData [导入的数据]
     * @param  [type] $data      [差集数据]
     * @return [type]   boolean         [true/false]
     */

    public function deleteDiff($diffData,$aid)
    {
        $keys = array_keys($diffData);

        $res = LabelArticle::whereIn('label_id',$keys)->where('aid',$aid)->delete();

        return $res;

    }



    /**
     * 添加到精品推荐
     * @param  [type] $id [文章ID]
     * @param  [type] $recommend_id      [推荐位ID]
     * @return [type]   boolean         [true/false]
     */
    public function addRecommend($id,$recommend_id)
    {
        $insert_arr = array(
            'aid'=>$id,
            'recommend_id' =>$recommend_id,
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        );

        if(RecommendArticle::create($insert_arr)){
            return redirect('admin/jbdx/article')->with('success', config('hint.add_success'));
        }
        return back()->with('hint',config('hint.add_failure'));

    }

    /**
     * 删除精品推荐
     * @param  [type] $labelData [导入的数据]
     * @param  [type] $data      [差集数据]
     * @return [type]   boolean         [true/false]
     */
    public function delRecommend($id,$recommend_id)
    {

        $where = array(
            'aid'=>$id,
            'recommend_id' =>$recommend_id
        );

        if(RecommendArticle::where($where)->delete()){
            return redirect('admin/jbdx/article')->with('success', config('hint.del_success'));
        }
        return back()->with('hint',config('hint.del_failure'));

    }

}
