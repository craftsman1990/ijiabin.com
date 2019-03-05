<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'dx_replies';

    protected $fillable = ['relevance_id', 'user_id','content','type','status'];
}
