<?php

namespace App\Http\Controllers\Admin\DX;

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
        $list->setPath(config('hint.domain').'admin/article?cg_id='.$data['cg_id'].'&title='.$data['title']);
        foreach ($list as $art){
            //分类
            $cate = Category::find($art->cg_id);
            if ($cate){
                $art->cg_name = $cate->cg_name;
            }else{
                $art->cg_name = '未知';
            }
            //精选
            $cho = Choiceness::where('type',1)->where('cho_id',$art->id)->get()->toArray();
            if ($cho){
                $art->cho = $cho[0]['id'];
            }else{
                $art->cho = 0;
            }
        }
        //分类
        $data['cate'] = Category::all();

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
                $Compress = new Compress(public_path($credentials['cover']),'0.4');
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
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
                $Compress = new Compress(public_path($credentials['cover']),'0.4');
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
            }
        }
        //(Article::find($id)->update($credentials));

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
            $Compress = new Compress(public_path($credentials['cover']),'0.4');
            $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        //开启事务
        //开启事务
        DB::beginTransaction();
        $article_id = Article::insertGetId($credentials);

        if ($article_id){

            $insert_arr['aid'] = $article_id;
            if (ArticleBlade::create($insert_arr)){
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

      //  $credentials['label_id'] = json_decode($credentials['label_id']);

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
            $Compress = new Compress(public_path($credentials['cover']),'0.4');
            $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        if (Article::create($credentials)){
            return redirect('admin/jbdx/article')->with('success', config('hint.add_success'));
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

        $credentials['tag'] = $request->tag;

        if ($request->labels){
            $credentials['labels'] = implode(',',$request->labels);
        }else{
            $credentials['labels'] = $request->old_labels;
        }
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
                $Compress = new Compress(public_path($credentials['cover']),'0.4');
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
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
                $Compress = new Compress(public_path($credentials['cover']),'0.4');
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
            }
        }
        if(Article::find($id)->update($credentials)){
            return redirect('admin/jbdx/article')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }

    }



    /**
     *删除
     **/
    public function destory($id)
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
       if ($request->labels) {
           $model->label_id = implode(',',$request->labels);
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
       //提交事务
       DB::commit();
       return redirect('admin/jbdx/article')->with('success', config('hint.add_success'));
    }

}
