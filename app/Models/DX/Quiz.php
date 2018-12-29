<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'dx_quiz';

    protected $fillable = ['content_id', 'title','answer','analysis'];
}
