<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/11/30
 * Time: 18:29
 */

include_once 'aliyuncs/aliyun-php-sdk-core/Config.php';
use Green\Request\V20180509 as Green;

//获取缩列图
function thumbnail($img){
    $img_arr = explode('.',$img);
    return $img_arr[0].'_min.'.$img_arr[1];
}

/*
    *封装Curl请求
    * @param string $url   要请求的url地址
    * @param bool  $https  是否是https请求
    * @param string $method 请求方式，默认为get请求
    * @param data   $data  如果是post请求，post的数据
    */
function request_curl($url,$https=true,$method='get',$data=null){
    //1.初始化url
    $ch = curl_init($url);
    //2.设置相关的参数
    //字符串不直接输出,进行一个变量的存储
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //判断是否为https请求
    if($https === true){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    //判断是否为post请求
    if($method == 'post'){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //3.发送请求
    $str = curl_exec($ch);
    //4.关闭连接,避免无效消耗资源
    curl_close($ch);
    return $str;
}

function detection($content){
    $iClientProfile = DefaultProfile::getProfile("cn-shanghai", "LTAIkIlM92Ed7aOD", "c8lFj8B8ge8budcZPU2PEg76HnHZAT");
    DefaultProfile::addEndpoint("cn-shanghai", "cn-shanghai", "Green", "green.cn-shanghai.aliyuncs.com");
    $client = new DefaultAcsClient($iClientProfile);
    $request = new Green\TextScanRequest();
    $request->setMethod("POST");
    $request->setAcceptFormat("JSON");
    $task1 = array('dataId' =>  uniqid(), 'content' => $content);

    $request->setContent(json_encode(array("tasks" => array($task1), "scenes" => array("antispam"))));
    try {
        $response = $client->getAcsResponse($request);
//            print_r($response);
        return $response;
    } catch (Exception $e) {
        print_r($e);
    }
}