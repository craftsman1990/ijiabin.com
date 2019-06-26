<?php


namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;

class RecommendArticle extends Model
{
    protected $table = 'dx_recommend_article';

    protected $fillable = ['recommend_id','aid','created_at','updated_at'];
}