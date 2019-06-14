<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recommend extends Model
{
    protected $table = 'dx_recommend';

    protected $fillable = ['id','title','status','rank','created_at','updated_at'];
}
