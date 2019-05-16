<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
	protected $table = 'dx_code';

    protected $fillable = ['mobile','code'];

}