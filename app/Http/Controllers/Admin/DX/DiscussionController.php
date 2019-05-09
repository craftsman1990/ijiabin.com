<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Comment;
use App\Models\DX\Discussion;
use App\Models\User;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Compress;

class DiscussionController extends Controller
{

    public function index(){
        $list = Discussion::paginate(20);
        return view('Admin.DX.Discussion.index',compact('list'));
    }

    //修改议题的评论列表跳转路径为CommentController.php中show方法
//    public function show($id){
//        $list = Comment::where('discussion_id',$id)->paginate(20);
//        foreach ($list as $v){
//            $user = User::find($v->user_id);
////            dd($user);
//            if ($user){
//                $v->user_name = $user->nickname;
//            }else{
//                $v->user_name = '该用户已经注销';
//            }
//        }
////        dd($list);
//        return view('Admin.DX.Discussion.show',compact('list'));
//    }

    public function create(){
        return view('Admin.DX.Discussion.create');
    }

    public function store(Request $request){
        $verif = [
            'title'=>'required|max:30',
            'time'=>'required',
            'author'=>'required|max:10',
            'cover'=>'required',
            'content'=>'required'
        ];
        $message = [
            'author.required'=> '出题人 不能为空',
            'author.max'=> '出题人 不能超过10个字符',
        ];
        $credentials = $this->validate($request,$verif,$message);

//        dd($credentials);
        $pic_path = Upload::uploadOne('Discussion',$credentials['cover']);
        if ($pic_path){
            $credentials['cover'] = $pic_path;
            //创建缩略图
            $Compress = new Compress(public_path($credentials['cover']),'0.4');
            $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
//        dd($credentials);
        if (Discussion::create($credentials)){
            return redirect('admin/jbdx/discussion')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    public function edit($id){
        $discussion = Discussion::find($id);
        return view('Admin.DX.Discussion.edit',compact('discussion'));
    }

    public function update(Request $request,$id){
        $verif = [
            'title'=>'required|max:30',
            'time'=>'required',
            'author'=>'required|max:10',
            'content'=>'required'
        ];
        $message = [
            'author.required'=> '出题人 不能为空',
            'author.max'=> '出题人 不能超过10个字符',
        ];
        $credentials = $this->validate($request,$verif,$message);
//        dd($credentials);
        //图像上传
        if ($request->cover){
            $pic_path = Upload::uploadOne('Discussion',$request->file('cover'));
            if ($pic_path){
                $credentials['cover'] = $pic_path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['cover']),'0.4');
                $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
                if (is_file(public_path($request->old_cover))){
                    unlink(public_path($request->old_cover));
                    if (is_file(public_path(thumbnail($request->old_cover)))){
                        unlink(public_path(thumbnail($request->old_cover)));
                    }
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
        if (Discussion::find($id)->update($credentials)){
            return redirect('admin/jbdx/discussion')->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    public function destroy($id){
        $discussion = Discussion::find($id);
        if (!$discussion){
            return back() -> with('hint',config('hint.data_exist'));
        }

        if (Discussion::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
