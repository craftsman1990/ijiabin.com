<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class ArticleBlade extends Model
{
	public $timestamps = false;//屏蔽自动添加时间
    protected $table = 'dx_article_blade';

    protected $fillable = ['aid','pic_info','video_info'];


}
