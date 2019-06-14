<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotbot extends Model
{
    protected $table = 'hotbot';

    protected $fillable = ['name','value'];

    /**
     * 获取热搜词列表
     * @return obj
     */
    public static function getHotBotList()
    {
    	return DB::table('hotbot')
    		->select('name')
            ->orderBy('value','desc')
            ->get()
            ->toArray();
    }
}
