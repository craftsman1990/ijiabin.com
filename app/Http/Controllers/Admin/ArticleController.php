<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\Choiceness;
use App\Models\Label;
use App\Models\Navigation;
use App\Services\Helper;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Compress;

class articleController extends Controller
{
    //首页
    public function index(Request $request){
        if ($request->all()){
            $where['cg_id'] = $request->get('cg_id');
            $where['nav_id'] = $request->get('nav_id');
            $like = $request->get('title');
            $list = Article::getIndex($where,$like);
            $data['cg_id'] = $where['cg_id'];
            $data['nav_id'] = $where['nav_id'];
            $data['title'] = $like;

        }else{
            $list = Article::orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            $data['cg_id'] = 0;
            $data['nav_id'] = 0;
            $data['title'] = null;
        }
        $list->setPath(config('hint.domain').'admin/article?cg_id='.$data['cg_id'].'&nav_id='.$data['nav_id'].'&title='.$data['title']);
        foreach ($list as $art){
            //导航
            $nav = Navigation::find($art->nav_id);
            if ($nav){
                $art->nav_name = $nav->n_name;
            }else{
                $art->nav_name = '未知';
            }
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
        //导航
        $all = Navigation::getAll();
        $nav_tree = Helper::_tree_json($all);
        $data['nav'] = Helper::getBottomLayer($nav_tree);
//        dd($data);
        return view('Admin.Article.index',compact('list',$list),compact('data',$data));
    }

    //展示(单条)
    public function show($id){

    }

    //添加
    public function create(){
        //echo phpinfo();die;
        $nav = Navigation::getAll();
        $nav_tree = Helper::_tree_json($nav);
        $data['nav'] = Helper::getBottomLayer($nav_tree);
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        return view('Admin.Article.create',compact('data',$data));
    }

    //执行添加
    public function store(Request $request){
//        dd($request->all());
        $verif = array('title'=>'required',
            'content'=>'required',
            'cg_id'=>'required|numeric',
            'nav_id'=>'required|numeric',
            'publish_time'=>'required',
            'labels'=>'required',
            'cover'=>'required',
            'intro'=>'required');
        $credentials = $this->validate($request,$verif);
        $credentials['labels'] = implode(',',$credentials['labels']);
        if ($request->author){
            $credentials['author'] = $request->author;
        }
//        dd($credentials);die;
        //上传图片
        $pic_path = Upload::baseUpload($credentials['cover'],'upload/Article');
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
            return redirect('admin/article')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id){
        $nav = Navigation::getAll();
        $nav_tree = Helper::_tree_json($nav);
        $data['nav'] = Helper::getBottomLayer($nav_tree);
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        $data['article'] = Article::find($id);
        $lables = explode(',',$data['article']->labels);
        return view('Admin.Article.edit',compact('data',$data),compact('lables'));
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('title'=>'required',
            'content'=>'required',
            'cg_id'=>'required|numeric',
            'nav_id'=>'required|numeric',
            'publish_time'=>'required',
            'intro'=>'required');
        $credentials = $this->validate($request,$verif);
        if ($request->labels){
            $credentials['labels'] = implode(',',$request->labels);
        }else{
            $credentials['labels'] = $request->old_labels;
        }
        if ($request->author){
            $credentials['author'] = $request->author;
        }

        //图像上传
//        if ($request->file('cover')){
        if ($request->cover){
            $pic_path = Upload::baseUpload($request->cover,'upload/Article');
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
            return redirect('admin/article')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
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
}
