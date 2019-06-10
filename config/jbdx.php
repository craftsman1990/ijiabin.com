<?php

return [
	//提示
	'yzm_error' => '验证码错误',
	'register_error' => '未知原因，注册失败，请稍后再试',
	'login_success' => '欢迎回来',
	'login_error' => '登陆失败，请稍后再试',
	'update_success' => '修改成功！',
	'update_error' => '修改失败，请稍后再试',
    'add_contentNums_fail' => '添加失败，课程小节数已满！',
    'del_failure_updated'   => '删除失败,该课程内容已上架！',
    'add_wx_article'        => '获取数据失败！',
    'check_article'         =>  '对不起，本类别已有一个完全相同的标题，请修改!',
    'upper_lower_success'   => '上下架成功！',
    'upper_lower_fail'   => '上下架失败！',


	'course_ify' => [ 1 => '公开课',
					 // 2 => '精品课',
					  2 => '企业案例课',
					 // 3 => '商业案例课'
                      3 => '主题案例课'
					],


'yqlj' => [
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/logo/kdxf.png'),'link' => 'http://www.iflytek.com'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/logo/byd.png'),'link' => 'http://www.bydauto.com.cn'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/logo/fzcm.png'),'link' => 'https://www.focusmedia.cn'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/logo/cjsxy.png'),'link' => 'http://www.ckgsb.edu.cn'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/logo/zgcmdx.png'),'link' => 'http://www.cuc.edu.cn'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/logo/zogjgsxy.png'),'link' => 'http://cn.ceibs.edu'],
]

];
?>