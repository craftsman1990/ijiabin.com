<?php

namespace App\Http\Controllers\Home;

use App\Services\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    //TOP40
    public function pageTop40(){
        $data['top40_pc'] = json_encode(config('hint.top40_pc'));
        $data['top40_yd'] = json_encode(config('hint.top40_yd'));
        $signPackage = Helper::getJSSDK();
//        $signPackage = array('appId'=>'wx87a51989fd90054d ','timestamp'=>'1537237991','nonceStr'=>'QS69mHIz3AwodX4T','signature'=>'913ec1d34f2e3529f9ca9fedadb7a7863b63c20d');
        return view('Home.Page.pageTop40',compact('data',$data),compact('signPackage',$signPackage));
    }

    //年会2018
    public function meeting_2018(){
        return view('Home.Page.meeting_2018');
    }

    //年会2018地图
    public function meeting_2018_map(){
        return view('Home.Page.meeting_2018_map');
    }
}
