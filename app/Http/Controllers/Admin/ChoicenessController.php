<?php

namespace App\Http\Controllers\Admin;

use App\Models\Choiceness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChoicenessController extends Controller
{
    //设置精选
    public function setting($type,$id){
        if (Choiceness::where('cho_id',$id)->where('type',$type)->get()->toArray()){
            return back()->with('hint',config('hint.is_set'));
        }
        $data = array('type'=>$type,'cho_id'=>$id);
        if (Choiceness::create($data)){
            return back()->with('success',config('hint.set_suss'));
        }else{
            return back()->with('hint',config('hint.set_fail'));
        }
    }

    //取消精选
    public function cancel($id){
        if (Choiceness::destroy($id)){
            return back() -> with('success',config('hint.cancel_suss'));
        }else{
            return back() -> with('hint',config('hint.cancel_fail'));
        }
    }
}
