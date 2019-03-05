<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class ScoreRecord extends Model
{
    protected $table = 'dx_score_record';

    protected $fillable = ['gs_id','score','type','old_score','behavior'];
}
