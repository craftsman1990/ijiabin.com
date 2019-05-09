<?php


namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\BulletScreen;
use App\Models\DX\Content;
use App\Models\User;
use App\Services\Compress;
use App\Services\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BulletScreenController extends Controller
{
    //首页
    public function index()
    {
        $list = BulletScreen::paginate(20);
        return view('Admin.bulletScreen.index', compact('list', $list));
    }

    //列表
    public function show($id)
    {
        $content = Content::find($id);
//        dd($content['id']);
        $list = BulletScreen::where('content_id',$id)->get();

        foreach ($list as $bullet){
                $bullet->userDetail = User::where('id',$bullet->user_id)->first();
        }
        return view('Admin.DX.Course.bulletScreenShow', compact('list','content'));

    }

    public function create(Request $request){
          $data['content_id'] = $request->content_id;
          $data['user'] = User::all();
//          dd($data['user']);
//        dd($request->course_id);
        return view('Admin.DX.Course.bulletScreenCreate',compact('data'));
    }

    //执行添加
    public function store(Request $request){
        $verif = [
            'text'=>'required|max:155',
            'content_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
        $message = [
            'text.required'=>'弹幕内容 不能为空',
            'content_id'=>'内容ID 不能为空',
            'user_id'=>'用户ID 不能为空',
        ];
        $credentials = $this->validate($request,$verif,$message);
//        dd($credentials);
        if (BulletScreen::create($credentials)){
            return redirect('admin/jbdx/content/bulletScreen/'.$credentials['content_id'])->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit($id)
    {
        $content = Content::find($id);
        $bulletScreen = BulletScreen::find($id);

        return view('Admin.DX.Course.bulletScreenEdit',compact('bulletScreen','content'));
    }

    //执行修改
    public function update(Request $request,$id)
    {
        $verif = [
            'text'=>'required|max:155',
            'content_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
        $message = [
            'text.required'=>'弹幕内容 不能为空',
            'content_id'=>'内容ID 不能为空',
            'user_id'=>'用户ID 不能为空',
        ];
        $credentials = $this->validate($request,$verif,$message);

        if (BulletScreen::find($id)->update($credentials)){
            return redirect('admin/jbdx/content/bulletScreen/'.$credentials['content_id'])->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id)
    {
        $BulletScreen = BulletScreen::find($id);
        if (!$BulletScreen) {
            return back()->with('hint', config('hint.data_exist'));
        }

        if (BulletScreen::destroy($id)) {
            return back()->with('success', config('hint.del_success'));
        } else {
            return back()->with('hint', config('hint.del_failure'));
        }
    }

}