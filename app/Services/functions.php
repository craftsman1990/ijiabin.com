<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/11/30
 * Time: 18:29
 */
//获取缩列图
function thumbnail($img){
    $img_arr = explode('.',$img);
    return $img_arr[0].'_min.'.$img_arr[1];
}