<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/7/20
 * Time: 15:23
 */

return [
    //当前域名
    'domain'                => 'https://www.ijiabin.com/',
    //后台列表展示条数
    'a_num'                 => 20,
    //设置提示信息
    'account_null'          => '账号不存在！',
    'password_error'        => '密码错误！',

    //上传限制 10M
    'images_size_big'       => 10000*1024,
    'images_type_error'     => '上传图片类型错误',
    'images_size_error'     => '上传图片大小超出允许范围',
    'images_null'           => '没有文件上传',
    'upload_failure'        => '上传失败',

    //增删改提示
    'add_success'           => '添加成功！',
    'add_failure'           => '添加失败！',
    'mod_success'           => '修改成功！',
    'mod_failure'           => '修改失败！',
    'del_success'           => '删除成功！',
    'del_failure'           => '删除失败！',
    'del_failure_exist'     => '删除失败,该层级下存在子级，请先删除子级后再试！',
    'password_error'        => '密码错误！',
    'password_two'          => '密码两次输入不一致！',
    'detail_null'           => '暂无详情，请在操作中添加！',
    'detail_exist'          => '详情已经存在，无需再添加！',
    'data_exist'            => '数据不存在！',

    'del_other'             => '暂不提供删除功能！',

    'video_exist'           => '视频位置地址不能为空',
    'href_exist'            => '其他位置跳转地址不能为空',
    'is_set'                => '该条已经设置',
    'set_suss'              => '设置成功！',
    'set_fail'              => '设置失败！',
    'cancel_suss'           => '取消成功！',
    'cancel_fail'           => '取消失败！',



    //设置固定数组
    'location'              => [1 => '首页视频广告位',
                                2 => '首页轮播广告位',
                                3 => '首页纵向小广告位',
                                4 => '我有嘉宾顶部广告位',
                                5 => '嘉宾派顶部广告位',
                                6 => '国际课程顶部广告位',
                                7 => '嘉宾峰会顶部广告位'],
    //首页广告位设置
    'index_show_adv'        => 1,       //1:视频；2：轮播；
    //首页导师学员展示设置
    'index_show_tust'       => 8,
    //导师学员页展示条数
    'ts_show_tust'          => 8,
    //首页文章推荐 展示几条
    'show_num'              => 10,
    //手机端默认展示条数
    'm_show_num'            => 10,
    //手机端导师学员默认展示
    'm_tust_num'            => 8,

    //截图比例(通用) 宽*高
    'scre_gm_width'   => 268,
    'scre_gm_height'  => 151,
    //输出比例(通用) 宽*高
    'opt_gm_width'   => 402,
    'opt_gm_height'  => 226,

    //截图比例(导师/学员) 宽*高
    'scre_ts_width'   => 285,
    'scre_ts_height'  => 395,
    //输出比例(导师/学员) 宽*高
    'opt_ts_width'   => 285,
    'opt_ts_height'  => 395,

    //合作机构
    'hzjg' => [
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/kdxf.png'),'link' => 'http://www.iflytek.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/zww.png'),'link' => 'http://www.ftchinese.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/zfb.png'),'link' => 'https://www.alipay.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ksjgs.png'),'link' => 'http://www.kaishustory.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/vipkid.png'),'link' => 'https://www.vipkid.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/xgdq.png'),'link' => 'http://www.xgdq.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/jj.png'),'link' => 'http://www..nz-jiejing.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/pmffs.png'),'link' => 'http://www.pmagroup.cn/info.asp?base_id=2'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/cjsxy.png'),'link' => 'http://www.ckgsb.edu.cn/alumni/club/detail/33/448'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/zyzn.png'),'link' => 'https://www.jyu.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/fxtx.png'),'link' => 'http://www.soshare.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/rsd.png'),'link' => 'http://www.rsdznjj.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ft.png'),'link' => 'https://www.ford.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/tj.png'),'link' => 'http://www.tujia.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/md.png'),'link' => 'https://www.midea.cn'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/afyl.png'),'link' => 'http://www.gdalpha.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/fcz.png'),'link' => 'http://www.variflight.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/qk.png'),'link' => 'http://www.zero2ipo.com.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ry.png'),'link' => 'http://www.royole.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/sqhy.png'),'link' => 'http://www.37wan.net/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ybx.png'),'link' => 'http://www.ubtrobot.com/cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/cjsys.png'),'link' => 'http://www.context.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/sct.png'),'link' => 'http://www.szvc.com.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/sgcm.png'),'link' => 'http://www.gimc.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/wxcm.png'),'link' => 'http://www.wxm.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/htjy.png'),'link' => 'http://www.huatu.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/hdys.png'),'link' => 'http://www.handu.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/lkk.png'),'link' => 'http://www.lkkdesign.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/lmm.png'),'link' => 'http://www.lvmama.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ryjy.png'),'link' => 'http://www.rongyiedu.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/boss.png'),'link' => 'https://www.zhipin.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/sdds.png'),'link' => 'http://www.sdiread.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/brsj.png'),'link' => 'http://www.beyou.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ykgc.png'),'link' => 'https://www.urwork.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/zgjj.png'),'link' => 'http://www.zhenfund.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/txcy.png'),'link' => 'http://tech.qq.com/startup.htm'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/xme.png'),'link' => 'http://www.xmr100.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/xhld.png'),'link' => 'http://www.cnxhld.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/xdljy.png'),'link' => 'http://www.itxdl.cn/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/lpjt.png'),'link' => 'http://www.lapelgroup.com/index.html'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/dtzb.png'),'link' => 'http://www.dtcap.com/cn/home.asp'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/ks.png'),'link' => 'http://www.vstonecapital.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/zmwh.png'),'link' => 'http://www.zhuomogroup.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/zllssws.png'),'link' => 'http://www.zhonglun.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/qszb.png'),'link' => 'https://www.hwazing.com/'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/bzn.png'),'link' => 'http://www.baozhunniu.com/index'],
        ['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/lxty.png'),'link' => 'http://www.lanxiongsports.com/'],
	['img' => PHP_SAPI === 'cli' ? false : asset('Home/images/img/jobs.png'),'link' => 'http://www.jobshaigui.com/'],
    ],
    //合作媒体
    'hzmt' => [
        ['name' => '爱奇艺','link' => 'http://www.iqiyi.com/'],
        ['name' => '优酷','link' => 'https://www.youku.com/'],
        ['name' => 'PP视频','link' => 'http://www.pptv.com/'],
        ['name' => 'DoNews','link' => 'http://www.donews.com/'],
        ['name' => '腾讯视频','link' => 'https://v.qq.com/'],
        ['name' => '新浪科技','link' => 'http://tech.sina.com.cn/'],
        ['name' => '航美传媒','link' => 'http://www.airmedia.net.cn/'],
        ['name' => '今日头条','link' => 'https://www.toutiao.com/'],
        ['name' => '36氪','link' => 'https://36kr.com/'],
        ['name' => '一点资讯','link' => 'http://www.yidianzixun.com/'],
        ['name' => '凤凰网科技','link' => 'https://tech.ifeng.com/'],
        ['name' => '新浪网','link' => 'https://www.sina.com.cn/'],
        ['name' => '快报','link' => 'http://kuaibao.qq.com/'],
        ['name' => '微信','link' => 'http://www.wechat.com/zh_TW/'],
        ['name' => '界面新闻','link' => 'https://www.jiemian.com/'],
        ['name' => '搜狐','link' => 'http://www.sohu.com/'],
        ['name' => '网易','link' => 'https://www.163.com/'],
        ['name' => '投资界','link' => 'http://www.pedaily.cn/'],
        ['name' => '喜马拉雅FM','link' => 'https://www.ximalaya.com/'],
        ['name' => '投中集团','link' => 'https://www.chinaventure.com.cn/'],
        ['name' => '中金网','link' => 'http://www.cngold.com.cn/'],
        ['name' => '融资中国','link' => 'http://thecapital.com.cn/'],
        ['name' => '创业家','link' => 'http://www.chuangyejia.vip/'],
        ['name' => 'i黑马','link' => 'http://www.iheima.com/'],
        ['name' => '中国网','link' => 'http://www.china.com.cn/'],
        ['name' => '百度','link' => 'https://www.baidu.com/'],
        ['name' => 'Wifi万能钥匙','link' => 'https://www.wifi.com/'],
        ['name' => '知乎','link' => 'https://www.zhihu.com'],
        ['name' => '海航航空','link' => 'http://www.hnair.com'],
        ['name' => '响巢看看','link' => 'http://www.kankan.com'],
        ['name' => '乐视网 ','link' => 'https://www.letv.com/'],
        ['name' => '一直播','link' => 'http://www.yizhibo.com/'],
        ['name' => '搜悦直播','link' => 'http://www.51souyue.com/'],
        ['name' => '视秀直播','link' => 'http://www.shixiutv.com/'],
        ['name' => '长江商业评论','link' => 'http://www.ckreview.cn/'],
        ['name' => '财经网','link' => 'http://www.caijing.com.cn/'],
        ['name' => '腾讯财经','link' => 'https://finance.qq.com/'],
        ['name' => '经济日报','link' => 'http://paper.ce.cn/jjrb/html/2018-08/23/node_2.htm'],
        ['name' => '经济观察报','link' => 'http://www.eeo.com.cn/'],
        ['name' => '南方都市报','link' => 'http://www.oeeee.com/'],
        ['name' => '证券之星','link' => 'https://www.stockstar.com/'],
        ['name' => '南方财富网','link' => 'http://www.southmoney.com/'],
        ['name' => '野马财经','link' => 'https://www.yemacaijing.com/'],
        ['name' => '和讯','link' => 'http://www.hexun.com/'],
        ['name' => '证券时报','link' => 'http://www.stcn.com/'],
        ['name' => '互动百科','link' => 'http://www.baike.com/'],
        ['name' => '速途网络','link' => 'http://www.sootoo.com/'],
        ['name' => '亿欧','link' => 'https://www.iyiou.com/']
    ],
    //top40
    'top40_pc' => [
        'one'=> [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ],'two' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ],'three' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ],'four' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ],'five' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ]
    ],
    'top40_yd' => [
        'one' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ],'two' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ],'three' => [
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com    ",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ],
            ['url' => "https://www.baidu.com",'img' => PHP_SAPI === 'cli' ? false : asset('Home/images/imgTop/1@2x.png') ]
        ]
    ],

    //公众号
    'appId' => 'wx87a51989fd90054d',
    'appSecret' => 'f07cd74efc91a6d8e4ddb7dede68647e',
];