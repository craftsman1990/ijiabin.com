<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'dx_order';

    protected $fillable = ['title', 'user_id','course_id','price','status','pay_time','order_num','payment_method','payment_no'];
}
