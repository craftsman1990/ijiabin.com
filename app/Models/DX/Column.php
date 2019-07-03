<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
	protected $table = 'dx_column';

    protected $fillable = ['title','cover'];

}