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
//查询网站状态
// $website = DB::table('website')->select('status')->where('keywords','=', 'jbdx')->first();
if (1){
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
    Route::group(['prefix'=>'university'],function(){
        Route::get('index','University\IndexController@index');
        Route::get('jbp','University\IndexController@jbp');
        Route::any('jbp_apply','University\IndexController@jbp_apply');
        Route::get('jbp_success','University\IndexController@jbp_success');
        Route::get('gjkc','University\IndexController@gjkc');
        Route::any('gjkc_apply','University\IndexController@gjkc_apply');
        Route::get('gjkc_success','University\IndexController@gjkc_success');

        Route::get('courseCategory/cgid/{cgid}','University\IndexController@courseCategory');

        //课程部分
        Route::group(['prefix'=>'course'],function (){
            Route::get('video/{id}/{cid?}/{audio?}','University\CourseController@show')->name('video');
            Route::get('audio/{id}/{cid?}','University\CourseController@audio')->name('audio');
            Route::get('test','University\CourseController@test')->name('test');
            Route::get('buy/id/{id}','University\CourseController@buy');
            Route::post('quizForm','University\CourseController@quizForm');
            Route::post('learningPut','University\CourseController@learningPut');
            Route::post('collect','University\CourseController@collect');
        });

        //议题部分
        Route::group(['prefix'=>'discussion'],function (){
            Route::get('index','University\DiscussionController@index');    //议题列表
            Route::get('content/id/{id}/source/{source}','University\DiscussionController@content');//评论议题
            Route::post('putContent','University\DiscussionController@putContent');     //添加评论
            Route::get('detail/id/{id}','University\DiscussionController@detail');      //议题详情
            Route::get('reply/cid/{cid}/type/{type}','University\DiscussionController@reply');      //回复评论
            Route::get('discussionPoster/did/{did}','University\DiscussionController@discussionPoster');      //议题海报
            Route::get('commentPoster/cid/{cid}','University\DiscussionController@commentPoster');      //评论海报
            Route::post('putReply','University\DiscussionController@putReply');     //添加回复
            Route::delete('delReply','University\DiscussionController@delReply');     //删除回复
            Route::delete('delComment','University\DiscussionController@delComment');     //删除评论
            Route::get('commentDetail/id/{id}','University\DiscussionController@commentDetail'); //评论详情

            Route::post('collect','University\DiscussionController@collect');     //添加收藏
            Route::post('praise','University\DiscussionController@praise');     //点赞

        });

        //我的
        Route::group(['prefix'=>'my'],function(){
            Route::get('index','University\MyController@index');
            Route::get('guesteScore','University\MyController@guesteScore');
            Route::get('aboutGuesteScore','University\MyController@aboutGuesteScore');
            Route::get('comment','University\MyController@comment');
            Route::get('order','University\MyController@order');
            Route::get('collect','University\MyController@collect');
            Route::post('cancelCollect','University\MyController@cancelCollect');
            Route::any('feedback','University\MyController@feedback');
            Route::get('setting','University\MyController@setting');
            Route::get('accountManagement','University\MyController@accountManagement');
            Route::any('editMobile','University\MyController@editMobile');
            Route::any('editPassWord','University\MyController@editPassWord');
            Route::get('aboutUs','University\MyController@aboutUs');
            Route::get('replenish','University\MyController@replenish');
            Route::get('doReplenish','University\MyController@doReplenish');
            Route::any('fillInfo','University\MyController@fillInfo');
            Route::get('getOpenId','University\MyController@getOpenId');
        });

        //登陆
        Route::get('login','University\LoginController@passwordLogin');
        Route::post('login','University\LoginController@doPasswordLogin');
        Route::get('quickLogin','University\LoginController@quickLogin');
        Route::post('quickLogin','University\LoginController@doQuickLogin');
        Route::get('loginOut','University\LoginController@loginOut');

        Route::get('serviceAgreement','University\LoginController@serviceAgreement');
        Route::get('privacyPolicy','University\LoginController@privacyPolicy');

        Route::get('getCode','University\LoginController@getCode');
        Route::get('register','University\LoginController@register');

        //支付
//    Route::

    });


//Route::get('upload','Home\IndexController@getCategoryPage');
//微信支付
    Route::get('payment/wechat', 'PaymentController@payByWechat')->name('payment.wechat');
    Route::post('payment/wechat/notify', 'PaymentController@wechatNotify')->name('payment.wechat.notify');
//测试
    Route::get('/test', function () {
//   $abc = \App\Models\Admin::where('email','>','?')->toSql();
//   dd(asset('123'));
//   dd($abc);
        $ip = $_SERVER['REMOTE_ADDR'];
        dd($ip);
    });
}else{
    //关闭
    Route::get('/', function () {
        return view('waiting');
    });
}



//后台
Route::group(['prefix'=>'admin'],function(){
    //网站
    Route::get('index','Admin\IndexController@index');			//首页
    Route::get('home','Admin\IndexController@home');			//首页内容
    Route::get('login','Admin\LoginController@showLoginForm')->name('admin.login');	//登陆界面
    Route::post('dologin','Admin\LoginController@store')->name('admin.dologin');			//执行登陆
   	Route::get('loginout','Admin\LoginController@logout');	//退出

   // Route::resource('index','Admin\IndexController');           //管理员

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
        Route::resource('comment','Admin\DX\CommentController');       //评论列表
        Route::resource('content/bulletScreen','Admin\DX\BulletScreenController');       //弹幕列表
        Route::get('content/bulletScreen/create/content_id/{content_id}/time/{time}','Admin\DX\BulletScreenController@create');       //课程内容添加
       // Route::get('content/bulletScreen/{ldid}','Admin\MettingController@list');      //年会中奖名单
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
