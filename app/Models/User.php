<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Roche\Trainings\Models\Training;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = ['username', 'password','nickname','truename','head_pic','mobile','email','address','remember_token','open_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    //�����Ñ�id�@ȡ�Ñ���Ϣ
    public static function getUserDetails($user_id)
    {
    	$user = DB::table('users')
        ->select('id','username','nickname','truename','head_pic','mobile','email','address')
        ->where('id',$user_id)
        ->get();
    	return $user;
    }
    //�޸��û�����
    public static function upUser($result)
    {
    	$users = User::find($result['user_id']);
    	//��̎���޸��ܴa
        $users->password = $result['password'];
        $users->nickname = $result['nickname'];
        $users->username = $result['username'];
        $users->head_pic = $result['head_pic'];
        $users->mobile = $result['mobile'];
        $users->email = $result['email'];
        $users->address = $result['address'];
    	$users->truename = $result['truename'];
    	if ($users->save()) {
    		return ['status'=>1,'msg'=>'�޸ĳɹ���'];
    	}else{
    		return ['status'=>999,'msg'=>'�޸�ʧ�ܣ�'];
    	}
    }
     /**
     * ����token
     * @return mixed|string
     */
    public static function generateToken($user_id) {
        $users = User::find($user_id);
        $users->remember_token = str_random(60);
        $users->save();

        return $users->remember_token;
    }
    /**
     * ��֤token�Ƿ���Ч
     * @param  [type]  $token tokenֵ
     * @return �ɹ������û���Ϣ��ʧ���������û���¼
     */
    public static function isToken($token)
    {
        //������֤token�Ƿ����
        if ($token) {
            $user = DB::table('users')
            ->where('remember_token',$token)->first();
            if (empty($user)) {
                return [];
            }
            return $user;
        }else{
            return [];
        }
    }
}
