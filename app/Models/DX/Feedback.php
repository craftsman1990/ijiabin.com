<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'dx_feedback';
    protected $fillable = ['user_id', 'question','contact'];

}
