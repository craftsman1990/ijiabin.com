<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotbot extends Model
{
    protected $table = 'hotbot';

    protected $fillable = ['name','value'];
}
