<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'dx_course';

    protected $fillable = ['name', 'cover','teacher','professional','intro','ify','is_pay','looks'];
}
