<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class LearningState extends Model
{
    //
    protected $table = 'dx_learning_states';

    protected $fillable = ['user_id','content_id','state','learning_time','quiz_state'];
}
