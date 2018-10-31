<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'metting_award';

    protected $fillable = ['name', 'pic','ld_id','num'];
}
