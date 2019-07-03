<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blackboard extends Model
{
    //public $timestamps = false;//屏蔽自动添加时间

    protected $table = 'dx_blackboard';

    protected $fillable = ['id', 'type','show_time','content_id','possess_id'];

}
