<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/7/26
 * Time: 9:59
 */

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Request;
use App\Models\Article;


class Helper
{
    //横向树形
    public static function _tree($arr,$pid=0,$level=0){
        static $tree = array();
        foreach ($arr as $v){
            if ($v['parent_id'] == $pid){
                $v['level'] = $level;
                $tree[] = $v;
                self::_tree($arr,$v['id'],$level+1);
            }
        }
        return $tree;
    }

    //树形
    public static function _tree_json($arr,$pid=0){
        $tree = array();
        foreach ($arr as $v){
            if ($pid == $v['parent_id']){
                $father['id'] = $v['id'];
                $father['text'] = $v['n_name'];
                $father['parent_id'] = $v['parent_id'];
                $father['sort'] = $v['sort'];
                $father['href'] = url('admin/navigation/'.$v['id']);
                $father['nodes'] = self::_tree_json($arr,$v['id']);
                $num = count($father['nodes']);
                $father['tags'] = ["$num"];
                $tree[] = $father;
            }
        }
        return $tree;
    }

    //获取最底层节点
    public static function getBottomLayer($arr){
        static $newArr = array();
        foreach ($arr as $v){
            if(!$v['nodes']){
                //剔除首页跟导师学员,关于我们
                if ($v['parent_id'] != 3 && $v['parent_id'] != 4){
                    $newArr[] = $v;
                }
            }else{
               self::getBottomLayer($v['nodes']);
            }
        }
        return $newArr;
    }

    //检查视频地址
    public static function checkVideoLocal($url){
        $arr = explode(':',$url);
        if ($arr[0] != 'https'){
            $arr[0] = 'https';
        }
        $str = implode(':',$arr);
        return $str;
    }

    //判断时间
    public static function getDifferenceTime($date){
        $time = strtotime($date);
        $difference = time() - $time;
        if($difference < 60){
            $diffTime = '刚刚';
        }elseif($difference > 60 && $difference < 60*60){
            $diff = floor($difference/60);
            $diffTime = $diff.'分钟前';
        }elseif($difference > 60*60 && $difference < 60*60*24){
            $diff = floor($difference/3600);
            $diffTime = $diff.'小时前';
        }elseif($difference > 60*60*24 && $difference < 60*60*24*4){
            $diff = floor($difference/86400);
            $diffTime = $diff.'天前';
        }else{
            $diffTime = substr($date,0,10);
        }
        return $diffTime;
    }

    //JSSDK
    public static function getJSSDK(){
        //获取参数
        $appid = config('hint.appId');
        $secret = config('hint.appSecret');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //缓存内是否存在accessToken
        $accessToken = Cache::remember('accessToken11',120,function () use ($appid,$secret){
            //获取access_token的请求地址
            $accessTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
            //请求地址获取access_token
            $accessTokenJson = file_get_contents($accessTokenUrl);
            $accessTokenObj = json_decode($accessTokenJson);
            $accessToken = $accessTokenObj->access_token;
            return $accessToken;

        });

        //获取jsapi_ticket的请求地址
        $ticketUrl = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";
        $jsapiTicketJson = file_get_contents($ticketUrl);
        $jsapiTicketObj = json_decode($jsapiTicketJson);
        $jsapiTicket = $jsapiTicketObj->ticket;

        //随机生成16位字符
        $noncestr = str_random(16);
        //时间戳
        $time = time();
        //拼接string1
        $jsapiTicketNew = "jsapi_ticket=$jsapiTicket&noncestr=$noncestr&timestamp=$time&url=$url";
        //对string1作sha1加密
        $signature = sha1($jsapiTicketNew);
        //存入数据
        $data = [
            'appId' => $appid,
            'timestamp' => $time,
            'nonceStr' => $noncestr,
            'signature' => $signature,
            'jsapiTicket' => $jsapiTicket,
            'url' => $url,
            'jsApiList' => [
                'api' => '#'
            ]
        ];
        //返回
        return $data;
    }
    //获取客户端ip地址
    public static function get_client_ip(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }
        if($ip == '') $ip = null;
        return($ip);
    }
}

?>

