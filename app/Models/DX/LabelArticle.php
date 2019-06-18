<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class LabelArticle extends Model
{
   // public $timestamps = false;//屏蔽自动添加时间
    protected $table = 'dx_label_article';

    protected $fillable = ['label_id','aid','rank'];
}