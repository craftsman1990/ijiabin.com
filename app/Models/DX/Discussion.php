<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'dx_discussion';

    protected $fillable = ['title', 'content','author','time','cover'];
}
