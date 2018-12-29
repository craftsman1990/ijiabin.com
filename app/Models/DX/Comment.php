<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'dx_comment';

    protected $fillable = ['discussion_id', 'content','user_id','praise','status'];
}
