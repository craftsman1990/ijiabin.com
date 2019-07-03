<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notes extends Model
{
    //public $timestamps = false;//屏蔽自动添加时间

    protected $table = 'dx_notes';

    protected $fillable = ['id', 'content','record_time','content_id','user_id','praise'];
}
