<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class GuesteScore extends Model
{
    protected $table = 'dx_gueste_score';

    protected $fillable = ['user_id','score'];
}
