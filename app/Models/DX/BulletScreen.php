<?php
namespace App\Models\DX;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BulletScreen extends Model
{
    protected $table = 'dx_bullet_screen';
    protected $fillable = ['user_id', 'content_id','text'];
    public $timestamps = false;//屏蔽自动添加时间
    /**
     * 用户发送弹幕
     * @param  [type] $request 
     * $request :
     * user_id:	用户id
     * content_id：当前发送弹幕资源id
     * text：弹幕内容
     * @return array
     */
    public static function userBulletScreen($request)
    {
    	$screenObj = new BulletScreen();
    	$screenObj->user_id = $request->user_id;
    	$screenObj->content_id = $request->content_id;
    	$screenObj->text = $request->text;
    	if ($screenObj->save()) {
    		return ['status'=>1,'msg'=>'发送成功'];
    	}else{
    		return ['status'=>999,'msg'=>'发送失败'];
    	}
    }

    /**
     * 获取用户发送弹幕
     * @param  [type] $request
     * $request{user_id：用户id,content_id：当前发送弹幕资源id}
     * @return [type]          [description]
     */
    public static function getBulletScreen($request)
    {
        $data = BulletScreen::where(['content_id'=>$request->content_id])->select('id','text','user_id')->get()->toArray();

        if ($request->user_id) {
            foreach ($data as $key => $v) {
                if ($v['user_id']==$request->user_id) {
                   $data[$key]['current'] = 1;
                }
            }
            return $data;
        }else{
            return $data;
        }
    }
}