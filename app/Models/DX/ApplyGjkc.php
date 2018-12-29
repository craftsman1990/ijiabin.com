<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class ApplyGjkc extends Model
{
    protected $table = 'dx_apply_gjkc';

    protected $fillable = ['name', 'sex','mobile','weixin','email','is_stu','company','position','industry','is_visa','channel'];
}
