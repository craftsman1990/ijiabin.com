<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $table = 'dx_collect';

    protected $fillable = ['by_collect_id', 'type','user_id','status'];
}
