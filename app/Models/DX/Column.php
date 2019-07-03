<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Column extends Model
{
    //public $timestamps = false;//屏蔽自动添加时间

    protected $table = 'dx_column';

    protected $fillable = ['id', 'title','cover','sort','status'];
}

