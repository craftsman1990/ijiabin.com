<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'dx_order';

    protected $fillable = ['title', 'user_id','couser_id','price','status','pay_time'];
}
