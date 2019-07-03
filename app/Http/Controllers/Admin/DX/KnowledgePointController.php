<?php

namespace App\Http\Controllers\Admin\DX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\KnowledgePoint;

class KnowledgePointController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index()
    {
        dd('知识点首页');
    }

    public function show($id)
    {
        dd('知识点首页'.$id);
    }

}
