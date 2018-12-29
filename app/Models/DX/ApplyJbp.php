<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class ApplyJbp extends Model
{
    protected $table = 'dx_apply_jbp';

    protected $fillable = ['name', 'sex','mobile','weixin','company','position','establish','income','market_value'];
}
