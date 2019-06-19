<?php

namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LabelArticle extends Model
{
   // public $timestamps = false;//屏蔽自动添加时间
    protected $table = 'dx_label_article';

    protected $fillable = ['label_id','aid','rank'];

    /**
     * 批量更新表的值，防止阻塞
     * @note 生成的SQL语句如下：
     * update mj_node set sort = case id
     *      when 13 then 1
     *      when 1 then 4
     *      when 7 then 5
     *      when 8 then 6
     *      when 9 then 7
     *      when 10 then 8
     *      when 11 then 9
     *      when 12 then 10
     * end where id in (13,1,7,8,9,10,11,12)
     * @param $conditions_field 条件字段
     * @param $values_field  需要被更新的字段
     * @param $conditions
     * @param $values
     * @param $aid
     * @return int
     */
    public static function batchUpdate($conditons_field,$values_field,$conditions,$values,$aid)
    {
        dd($values);

        $table ='hg_dx_label_article'; //返回表明

        $sql = 'update '.$table.' set ' .$values_field .' = case '.$conditons_field;

        foreach ($conditions as $key =>$condition){
            $sql .= ' when ' . $condition .' then  ?';
        }

        $sql .= ' end where label_id in ( '.implode(',',$conditions).') and aid ='.$aid;

        return DB::update($sql,$values);
    }
}