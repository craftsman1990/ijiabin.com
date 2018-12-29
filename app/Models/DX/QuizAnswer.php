<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = 'dx_quiz_answer';

    protected $fillable = ['quiz_id', 'answer','card'];
}
