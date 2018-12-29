<?php

namespace App\Http\Controllers\Admin\DX;

use App\Models\DX\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $list = Order::paginate(20);
        return view('Admin.DX.order',compact('list'));
    }


}
