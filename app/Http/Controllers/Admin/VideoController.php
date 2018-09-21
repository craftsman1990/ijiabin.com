<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Choiceness;
use App\Models\Label;
use App\Models\Navigation;
use App\Models\Video;
use App\Services\Helper;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    //首页
    public function index(Request $request){
        if ($request->all()){
            $where['cg_id'] = $request->get('cg_id');
            $where['nav_id'] = $request->get('nav_id');
            $like = $request->get('title');
            $list = Video::getIndex($where,$like);
            $data['cg_id'] = $where['cg_id'];
            $data['nav_id'] = $where['nav_id'];
            $data['title'] = $like;

        }else{
            $list = Video::orderBy('publish_time','desc')->paginate(config('hint.a_num'));
            $data['cg_id'] = 0;
            $data['nav_id'] = 0;
            $data['title'] = null;
        }
        $list->setPath(config('hint.domain').'admin/video?cg_id='.$data['cg_id'].'&nav_id='.$data['nav_id'].'&title='.$data['title']);

        foreach ($list as $art){
            //导航
            $nav = Navigation::find($art->nav_id);
            if ($nav){
                $art->nav_name = $nav->n_name;
            }else{
                $art->nav_name = '未知';
            }
            $cate = Category::find($art->cg_id);
            if ($cate){
                $art->cg_name = $cate->cg_name;
            }else{
                $art->cg_name = '未知';
            }

            $cho = Choiceness::where('type',2)->where('cho_id',$art->id)->get()->toArray();
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
        return view('Admin.Video.index',compact('list',$list),compact('data',$data));
    }

    //展示(单条)
    public function show(){

    }

    //添加
    public function create(){
        $nav = Navigation::getAll();
        $nav_tree = Helper::_tree_json($nav);
        $data['nav'] = Helper::getBottomLayer($nav_tree);
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        return view('Admin.Video.create',compact('data',$data));
    }

    //执行添加
    public function store(Request $request){
        $verif = array('title'=>'required',
            'address'=>'required',
            'duration'=>'required',
            'cg_id'=>'required|numeric',
            'nav_id'=>'required|numeric',
            'publish_time'=>'required',
            'labels'=>'required',
            'cover'=>'required',
            'content'=>'required',
            'intro'=>'required');
        $credentials = $this->validate($request,$verif);
        $credentials['address'] = Helper::checkVideoLocal($credentials['address']);
        $credentials['labels'] = implode(',',$credentials['labels']);
        if ($request->post('author')){
            $credentials['author'] = $request->post('author');
        }
        //上传图片
        $pic_path = Upload::baseUpload($credentials['cover'],'upload/Video');
        if ($pic_path){
            $credentials['cover'] = $pic_path;
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        if (Video::create($credentials)){
            return redirect('admin/video')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id){
        $data['video'] = Video::find($id)->toArray();
        $nav = Navigation::getAll();
        $nav_tree = Helper::_tree_json($nav);
        $data['nav'] = Helper::getBottomLayer($nav_tree);
        $data['cate'] = Category::select('id','cg_name')->get()->toArray();
        $data['label'] = Label::select('id','name')->get()->toArray();
        $lables = explode(',',$data['video']['labels']);
//        dd($data);
        return view('Admin.Video.edit',compact('data',$data),compact('lables',$lables));
    }

    //执行修改
    public function update(Request $request,$id){
        $verif = array('title'=>'required',
            'address'=>'required',
            'duration'=>'required',
            'cg_id'=>'required|numeric',
            'nav_id'=>'required|numeric',
            'publish_time'=>'required',
            'content'=>'required',
            'intro'=>'required');
        $credentials = $this->validate($request,$verif);
        $credentials['address'] = Helper::checkVideoLocal($credentials['address']);
        if ($request->post('labels')){
            $credentials['labels'] = implode(',',$request->post('labels'));
        }else{
            $credentials['labels'] = $request->post('old_labels');
        }
        if ($request->post('author')){
            $credentials['author'] = $request->post('author');
        }
//        dd($credentials);
        //图像上传
        if ($request->post('cover')){
            $pic_path = Upload::baseUpload($request->get('cover'),'upload/Video');
            if ($pic_path){
                $credentials['cover'] = $pic_path;
                @unlink(public_path($request->get('old_cover')));
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['cover'] = $request->get('old_cover');
        }
        if(Video::find($id)->update($credentials)){
            return redirect('admin/video')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){
        $videoObj = Video::find($id);
        if (!$videoObj){
            return back() -> with('hint',config('hint.data_exist'));
        }
        $video = $videoObj->toArray();
        if (Video::destroy($id)){
            unlink(public_path($video['cover']));
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
