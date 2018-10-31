<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winners extends Model
{
    protected $table = 'metting_winners';

    protected $fillable = ['nickname', 'award_name','user_id','award_id','time','is_receive','ld_id'];
}
