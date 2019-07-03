<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    echo 'api';die;
    return $request->user();
});

//上传
Route::post('upload','Api\commonController@upload');
Route::post('imgDelete','Api\commonController@imgDelete');
//搜索
Route::get('getSearch','Api\commonController@getSearch');

Route::get('getSms','Api\commonController@getSms');


//微信接口
Route::group(['prefix'=>'weixin'],function (){
    Route::get('getShare','Api\WxController@getShare');
    Route::get('wxLogin','Api\WxController@wxLogin');
    Route::get('getInfo','Api\WxController@getInfo');

    Route::get('getOpenId','Api\WxController@getOpenId');
    Route::get('callBack','Api\WxController@callBack');

    Route::get('test','Api\WxController@test');


});

//嘉宾大学api
Route::group(['prefix'=>'jbcm'],function(){
	Route::post('collect','Api\University\CollectController@collect');//用户收藏
	Route::get('reCollect','Api\University\CollectController@reCollect');//取消收藏
	Route::get('myCollect','Api\University\CollectController@myCollect');//我的收藏列表
	Route::post('delCollect','Api\University\CollectController@delCollect');//删除我的收藏
	Route::post('praises','Api\University\PraisesController@praises');//用户点赞
	Route::get('rePraises','Api\University\PraisesController@rePraises');//用户取消点赞
	Route::post('comment','Api\University\CommentController@comment');//用户评论
	Route::get('getCommentList','Api\University\CommentController@getCommentList');//用户评论
	Route::get('myOrder','Api\University\OrderController@myOrder');//我的购买列表
	Route::get('getUser','Api\University\UserController@getUser');//我的购买列表
	Route::post('upUser','Api\University\UserController@upUser');//用戶信息修改
	Route::post('sendScreen','Api\University\ScreenController@sendScreen');//发弹幕
	Route::get('getContentList','Api\University\ContentController@getContentList');//內容列表
	Route::get('getWapContent','Api\University\ContentController@getWapContent');//wap內容列表
	Route::get('getContentDetails','Api\University\ContentController@getContentDetails');//內容詳情
	Route::post('sendCode','Api\University\UserController@sendCode');//发送手机验证码
	Route::post('login','Api\University\LoginController@login');//用户登录验证码或者密码登录
	Route::get('test','Api\University\UserController@test');//用户登录验证码或者密码登录
	Route::post('playStates','Api\University\PlayController@playStates');//记录用户播放进度
	Route::post('playNum','Api\University\PlayController@playNum');//记录播放量
	Route::get('getScreen','Api\University\ScreenController@getScreen');//获取弹幕列表
	Route::get('aboutUs','Api\University\ContentController@aboutUs');//获取合作媒体
	Route::post('getWxUser','Api\University\UserController@getWxUser');//微信授权用户信息
	Route::post('feedBack','Api\University\UserController@feedBack');//用户反馈
	Route::post('wxPay','Api\University\PayController@wxPay');//微信支付
	Route::get('PayOrder','Api\University\PayController@PayOrder');//支付完成订单查询
	Route::get('wapPay','Api\University\PayController@wapPay');//支付完成订单查询
	Route::get('getCourse','Api\University\ContentController@getCourse');//获取三大课程数据
	Route::get('getCourseDetail','Api\University\ContentController@getCourseDetail');//获取课程详情
	Route::get('getBase64Img','Api\University\ContentController@getBase64Img');//根据图片地址转为图片流
	Route::get('addLooks','Api\University\ContentController@addLooks');//记录课程播放量
	Route::get('search','Api\University\ContentController@search');//根据关键字搜索
	Route::get('recommendAtions','Api\University\ContentController@recommendAtions');//相关推荐
	Route::get('recommenDation','Api\University\ContentController@recommenDation');//精品推荐
	Route::get('labelSearch','Api\University\LabelsController@labelSearch');//获取标签聚合页列表
	Route::get('hotBot','Api\University\LabelsController@hotBot');//获取热搜词列表
	Route::get('column','Api\University\ContentController@column');//根据栏目获取列表
});