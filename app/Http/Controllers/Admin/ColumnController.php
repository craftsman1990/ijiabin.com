<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Column;
use App\Services\Compress;
use App\Services\Upload;
use Doctrine\DBAL\Driver\IBMDB2\DB2Driver;

class ColumnController extends Controller
{

    public function __construct()
    {
    }

    /**
     * 列表
     **/
    public function index()
    {
        $list = Column::paginate(20);

        return view('Admin.Column.index',compact('list',$list));
    }

    /**
     * 添加
     **/
    public function create()
    {
    }

    /**
     * 执行添加
     **/
    public function store(Request $request){
        //dd($request);

        $verif = array(
            'title'=>'required|unique:dx_column',
         //   'sort'=>'required|numeric',
            'status'=>'required|numeric',
            'cover'=>'required',
        );

        $credentials = $this->validate($request,$verif);

        //横图
        $cor_size = $credentials['cover']->getSize() / 1024;

        if ($cor_size < 100){
            $cor_per = 1;
        }else{
            $cor_per = 0.4;
        }
        $cro_path = Upload::uploadOne('Column',$credentials['cover']);
        if ($cro_path){
            $credentials['cover'] = $cro_path;
            //创建缩略图
            $Compress = new Compress(public_path($credentials['cover']),$cor_per);
            $Compress->compressImg(public_path(thumbnail($credentials['cover'])));
        }else{
            return back() -> with('hint',config('hint.upload_failure'));
        }

        if (Column::create($credentials)){
            return redirect('admin/column')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }
    }

    /**
     * 详情
     **/
    public function show()
    {
    }
    /**
     * 修改
     **/
    public function edit()
    {
    }

    /**
     * 执行修改
     **/
    public function update(Request $request,$id)
    {
        //验证参数
        $verif = array(
            'title'=>'required|unique:dx_column,title,'.$id,
          //  'sort'=>'required|numeric',
            'status'=>'required|numeric'
        );
        $credentials = $this->validate($request,$verif);
        //dd($credentials);
        //横图
        if ($request->new_cover){
            $cor_size = $request->new_cover->getSize() / 1024;
            if ($cor_size < 100){
                $cor_per = 1;
            }else{
                $cor_per = 0.4;
            }
            $cro_path = Upload::uploadOne('Column',$request->new_cover);
            if ($cro_path){
                $credentials['cover'] = $cro_path;
                //创建缩略图
                $Compress = new Compress(public_path($credentials['cover']),$cor_per);
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
            if($request->old_cover){
                $credentials['cover'] = $request->old_cover;
            }else{
                return back() -> with('hint','没有原图，也没有图片上传');
            }
        }
        if(Column::find($id)->update($credentials)){
            return redirect('admin/column')->with('success', config('hint.mod_success'));
        }else{
            return back()->with('hint',config('hint.mod_failure'));
        }
    }

    /**
     * 执行删除
     **/
    public function destroy($id)
    {
        if (Column::destroy($id)){
            return back() -> with('success',config('hint.del_success'));
        }else{
            return back() -> with('hint',config('hint.del_failure'));
        }
    }
}
