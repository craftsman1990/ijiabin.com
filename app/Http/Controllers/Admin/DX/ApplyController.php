<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\ApplyGjkc;
use App\Models\DX\ApplyJbp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplyController extends Controller
{
    //国际课程
    public function gjkc(){

        $list = ApplyGjkc::paginate(20);
        return view('Admin.DX.gjkc',compact('list'));
    }

    //嘉宾派
    public function jbp(){
        $list = ApplyJbp::paginate(20);
        return view('Admin.DX.jbp',compact('list'));
    }
}
