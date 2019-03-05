<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $list = Order::paginate(20);
        foreach ($list as $v){
            $user = User::find($v->user_id);
            if ($user){
                $v->user = $user->nickname;
            }else{
                $v->user = '该用户已注销';
            }
        }
        return view('Admin.DX.order',compact('list'));
    }


}
