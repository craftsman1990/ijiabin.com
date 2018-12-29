<?php

use Illuminate\Support\Facades\Cache;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前端
Route::get('/','Home\IndexController@index');
Route::get('transmit/oneId/{oneId}/secId/{secId}','Home\IndexController@transmit');
Route::get('brand/oneId/{oneId}/secId/{secId}','Home\IndexController@brand');
Route::get('university/oneId/{oneId}/secId/{secId}','Home\IndexController@university');
Route::get('summit/oneId/{oneId}','Home\IndexController@summit');
Route::get('tutorStudent/oneId/{oneId}/secId/{secId}','Home\IndexController@tutorStudent');
Route::get('aboutUs/oneId/{oneId}/secId/{secId}','Home\IndexController@aboutUs');
Route::get('threeList/pid/{pid}/id/{id}','Home\IndexController@threeList');
Route::get('article/id/{id}','Home\IndexController@article');
Route::get('video/id/{id}','Home\IndexController@video');
Route::get('tutorStudent/detail/id/{id}','Home\IndexController@tsDetail');
Route::get('search','Home\IndexController@search');
Route::get('doSearch','Home\IndexController@doSearch');

//API
Route::get('getCategoryPage','Home\IndexController@getCategoryPage');       //首页数据获取
Route::get('getIndexCate','Home\ApiController@getIndexCate');       //首页分类数据获取
Route::get('getPeopleMessge','Home\ApiController@getPeopleMessge');       //导师学员分页数据获取
Route::get('getThereMessge','Home\ApiController@getThereMessge');       //三级列表数据获取
//公共链接PC
Route::get('getHref/id/{id}','Home\IndexController@getHref');
Route::group(['prefix'=>'page'],function (){
    Route::get('pageTop40','Home\PageController@pageTop40');
    Route::get('meeting_2018','Home\PageController@meeting_2018');
    Route::get('meeting_2018_map','Home\PageController@meeting_2018_map');
});

//移动端
Route::group(['prefix'=>'mobile'],function (){
    Route::get('index','Mobile\IndexController@index');
    Route::get('transmit/oneId/{oneId}/secId/{secId}','Mobile\IndexController@transmit');
    Route::get('brand/oneId/{oneId}/secId/{secId}','Mobile\IndexController@brand');
    Route::get('university/oneId/{oneId}/secId/{secId}','Mobile\IndexController@university');
    Route::get('summit/oneId/{oneId}/secId/{secId}','Mobile\IndexController@summit');
    Route::get('tutorStudent/oneId/{oneId}/secId/{secId}','Mobile\IndexController@tutorStudent');
    Route::get('aboutUs/oneId/{oneId}/secId/{secId}','Mobile\IndexController@aboutUs');

    Route::get('search','Mobile\IndexController@search');
    Route::get('doSearch','Mobile\IndexController@doSearch');

    Route::get('tsDetail/id/{id}','Mobile\IndexController@tsDetail');
    Route::get('article/id/{id}','Mobile\IndexController@article');
    Route::get('video/id/{id}','Mobile\IndexController@video');
    //API
    Route::get('getIndexMessge','Mobile\ApiController@getIndexMessge');         //首页数据获取
    Route::get('getBrandMessge','Mobile\ApiController@getBrandMessge');         //品牌页数据获取
    Route::get('getPeopleMessge','Mobile\ApiController@getPeopleMessge');       //导师学员分页数据获取

    //公共链接M
    Route::group(['prefix'=>'page'],function (){
        Route::get('meeting_2018','Mobile\PageController@meeting_2018');
        Route::get('meeting_2018_map','Mobile\PageController@meeting_2018_map');
        Route::get('test','Mobile\PageController@test');
    });
    //年会
    Route::group(['prefix'=>'metting'],function (){
        Route::get('luckyDraw','Mobile\MettingController@luckyDraw');
        Route::get('register','Mobile\MettingController@register');
        Route::post('doRegister','Mobile\MettingController@doRegister');
        Route::get('myAward/uid/{uid}','Mobile\MettingController@myAward');
        Route::post('clickOne','Mobile\MettingController@clickOne');
        Route::get('wxLogin','Mobile\MettingController@wxLogin');
        Route::get('getInfo','Mobile\MettingController@getInfo');

        Route::get('control','Mobile\MettingController@control');   //控制活动开始页
        Route::get('doControl/status/{status}/ldid/{ldid}','Mobile\MettingController@doControl');   //控制
    });
});

//嘉宾大学
/*Route::group(['prefix'=>'university'],function(){
    Route::resource('index','University\IndexController');
});*/

//Route::get('upload','Home\IndexController@getCategoryPage');

//测试
Route::get('/test', function () {
//   $abc = \App\Models\Admin::where('email','>','?')->toSql();
//   dd(asset('123'));
//   dd($abc);
    $ip = $_SERVER['REMOTE_ADDR'];
    dd($ip);
});

//后台
Route::group(['prefix'=>'admin'],function(){
    //网站
    Route::get('index','Admin\IndexController@index');			//首页
    Route::get('home','Admin\IndexController@home');			//首页内容
    Route::get('login','Admin\IndexController@login');			//登陆界面
    Route::post('login','Admin\IndexController@store');			//执行登陆
   	Route::get('loginout','Admin\IndexController@loginOut');	//退出

//    Route::resource('index','Admin\IndexController');           //管理员

    Route::resource('admin','Admin\AdminController');           //管理员
    Route::resource('category','Admin\CategoryController');     //分类
    Route::resource('navigation','Admin\NavigationController'); //导航
    Route::resource('label','Admin\LabelController');           //标签
    Route::resource('user','Admin\UserController');             //用户
    Route::resource('tutorStudent','Admin\TutorStudentController');  //导师学员
    Route::resource('video','Admin\VideoController');           //视频
    Route::resource('article','Admin\ArticleController');       //文章
    Route::resource('advertising','Admin\AdvertisingController');//广告
    Route::resource('hotbot','Admin\HotbotController');         //热搜

    Route::get('choiceness/setting/type/{type}/id/{id}','Admin\ChoicenessController@setting');                  //设置精选
    Route::get('choiceness/cancel/id/{id}','Admin\ChoicenessController@cancel');                                //取消精选
    Route::get('tutorStudent/showIndex/id/{id}','Admin\TutorStudentController@showIndex');                      //首页展示（导师学员）
    Route::get('tutorStudent/changeSort/id/{id}/sort/{sort}','Admin\TutorStudentController@changeSort');        //修改排序（导师学员）


    //嘉宾大学
    Route::group(['prefix'=>'jbdx'],function (){
        Route::resource('course','Admin\DX\CourseController');         //课程列表
        Route::resource('content','Admin\DX\ContentController');       //课程内容
        Route::get('content/create/course_id/{course_id}','Admin\DX\ContentController@create');       //课程内容添加
        Route::resource('quiz','Admin\DX\QuizController');                 //自测题
        Route::resource('answer','Admin\DX\AnswerController');             //自测题答案
        Route::get('getQuiz','Admin\DX\QuizController@getQuiz');           //获取自测题信息;
        Route::get('getAnswer','Admin\DX\AnswerController@getAnswer');     //获取问题列表;

        Route::resource('order','Admin\DX\OrderController');                //订单列表
        Route::resource('discussion','Admin\DX\DiscussionController');      //议题列表

        Route::get('gjkc','Admin\DX\ApplyController@gjkc');  //国际课程报名
        Route::get('jbp','Admin\DX\ApplyController@jbp');    //嘉宾派报名

    });




    //年会活动
    Route::resource('metting','Admin\MettingController');                            //年会
    Route::get('metting/award/ldid/{ldid}','Admin\MettingController@award');         //年会奖品列表
    Route::post('metting/awardStore','Admin\MettingController@awardStore');          //年会奖品添加
    Route::put('metting/awardUpdate/id/{id}','Admin\MettingController@awardUpdate'); //年会奖品修改
    Route::delete('metting/awardDestroy/{id}','Admin\MettingController@awardDestroy'); //年会奖品修改
    Route::get('metting/winners/ldid/{ldid}','Admin\MettingController@winners');         //中奖名单

    Route::get('metting/winners/ldid/{ldid}','Admin\MettingController@winners');      //年会中奖名单
    Route::get('metting/winnersDistribute/wid/{wid}','Admin\MettingController@winnersDistribute');      //派发



});

//后台辅助功能
Route::get('/assist',function (){
    return view('layouts.assist');
});
