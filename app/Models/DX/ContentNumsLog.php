<?php
namespace App\Models\DX;
use Illuminate\Database\Eloquent\Model;

class ContentNumsLog extends Model
{
    protected $table = 'dx_content_nums_log';

    protected $fillable = ['courseid_contentnums', 'nums'];
}