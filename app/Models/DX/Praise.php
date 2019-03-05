<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Praise extends Model
{
    protected $table = 'dx_praises';

    protected $fillable = ['by_praise_id', 'type','user_id','status'];
}
