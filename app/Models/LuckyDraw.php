<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyDraw extends Model
{
    protected $table = 'metting_lucky_draw';

    protected $fillable = ['title', 'time','screening','status'];
}
