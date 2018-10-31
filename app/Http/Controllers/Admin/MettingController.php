<?php

namespace App\Http\Controllers\Admin;

use App\Models\Award;
use App\Models\LuckyDraw;
use App\Models\Winners;
use App\Services\Upload;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MettingController extends Controller
{
    //首页
    public function index(){
        $list = LuckyDraw::paginate(20);
        return view('Admin.Metting.index',compact('list',$list));
    }

    //展示(单条)
    public function show(){

    }

    //添加
    public function create(){

    }

    //执行添加
    public function store(Request $request){
        $credentials = $this->validate($request,['title'=>'required','time'=>'required','screening'=>'required']);
        if (LuckyDraw::create($credentials)){
            return back()->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //修改
    public function edit(){

    }

    //执行修改
    public function update(Request $request,$id){
        $credentials = $this->validate($request,['title'=>'required','time'=>'required','screening'=>'required']);
        if (LuckyDraw::find($id)->update($credentials)){
            return back()->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function destroy($id){

    }

    /*
     * 奖品
    */
    public function award($ldid){
        $metting = LuckyDraw::find($ldid);
        $list = Award::where('ld_id',$ldid)->get();
        return view('Admin.Metting.award',compact('list',$list),compact('metting',$metting));
    }

    //奖品添加
    public function awardStore(Request $request){
        $verif = array('name'=>'required',
            'ld_id'=>'required',
            'num'=>'required|numeric',
            'pic'=>'required');
        $credentials = $this->validate($request,$verif);
        $pic_path = Upload::uploadOne('Metting',$credentials['pic']);
        if ($pic_path){
            $credentials['pic'] = $pic_path;
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }
        if (Award::create($credentials)){
            return back()->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    //执行修改
    public function awardUpdate(Request $request,$id){
        $verif = array('name'=>'required',
            'num'=>'required|numeric');
        $credentials = $this->validate($request,$verif);
        if ($request->file('pic')){
            $pic_path = Upload::uploadOne('Metting',$request->file('pic'));
            if ($pic_path){
                $credentials['pic'] = $pic_path;
                @unlink(public_path($request->post('oldpic')));
            }else{
                return back() -> with('hint',config('hint.upload_failure'));
            }
        }else{
            $credentials['pic'] = $request->post('oldpic');
        }
        if (Award::find($id)->update($credentials)){
            return back()->with('success',config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    //删除
    public function awardDestroy($id){
        $Obj = Award::find($id);
        if (!$Obj){
            return back() -> with('hint',config('hint.data_exist'));
        }
        if (Award::destroy($id)){
            @unlink(public_path($Obj->pic));
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }

    //中将名单
    public function winners($ldid){
        $metting = LuckyDraw::find($ldid);
        $list = Winners::where('ld_id',$ldid)->get();
        foreach ($list as $v){
            $user = User::find($v->user_id);
//            dd($v->user_id);
            $v->mobile = $user->mobile;
            $v->truename = $user->truename;
            $v->address = $user->address;
        }
        return view('Admin.Metting.winners',compact('list'),compact('metting',$metting));
    }

    //派发奖品
    public function winnersDistribute($wid){
        $winners = Winners::find($wid);
        if ($winners->is_receive ==1){
            $data['is_receive'] = 0;
        }else{
            $data['is_receive'] = 1;
        }
        if ($winners->update($data)){
            return back()->with('success',config('hint.set_suss'));
        }else{
            return back()->with('hint',config('hint.set_fail'));
        }
    }
}
