<?php	
 namespace App\Models\DX;	
 use Illuminate\Database\Eloquent\Model;	
 class Content extends Model	
{	
    protected $table = 'dx_course_content';	
    protected $fillable = ['title', 'intro','time','video','audio','content','type','course_id','chapter'];	
}