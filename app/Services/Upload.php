<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/7/20
 * Time: 17:42
 */
namespace App\Services;


use File;

class Upload
{

    //单个文件上传
    public static function uploadOne($table,$image){
        $file = isset($image) ? $image : NULL;
        //没有图片上传
        if (is_null($file)) {
            return 1;
        }
        $file_ex = $file->getClientOriginalExtension();
        //过滤图片
        if (!in_array($file_ex, array('jpg', 'gif', 'png','jpeg','JPG','GIF','PNG','JPEG'))) {
            return 2;
        }
        $size = $file->getSize();
        //过滤大小
        if ($size > config('hint.images_size_big')) {
            return 3;
        }
        //资源路径
        $Resource_path  = public_path('upload/'.$table.'/');
        if (! File::exists($Resource_path)){
            mkdir($Resource_path, 0755, true);
        }
        //图片名
        $newName = md5(time().mt_rand(10, 99));
        $file_name = $newName.'.'.$file_ex;
        $res = $file->move($Resource_path, $file_name);
        return 'upload/'.$table.'/'.$file_name;
    }

    //base64上传
    public static function baseUpload($base64_image_content,$path)
    {
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
            $type = $result[2];
            $new_file = $path . "/" . date('Ymd', time()) . "/";
            if (!file_exists($new_file)) {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0755,true);
            }
            $new_file = $new_file . time() . ".{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
                return '/' . $new_file;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}