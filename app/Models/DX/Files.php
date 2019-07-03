<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Files extends Model
{
    //public $timestamps = false;//屏蔽自动添加时间

    protected $table = 'dx_files';

    protected $fillable = ['id', 'type','url','own_id'];
}
