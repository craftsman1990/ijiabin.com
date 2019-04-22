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