<!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:16:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>嘉宾传媒</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href={{asset("Admin/favicon.ico")}}>
    <link href={{asset("Admin/css/bootstrap.min14ed.css?v=3.3.6")}} rel="stylesheet">
    <link href={{asset("Admin/css/font-awesome.min93e3.css?v=4.4.0")}} rel="stylesheet">
    <link href={{asset("Admin/css/animate.min.css")}} rel="stylesheet">
    <link href={{asset("Admin/css/style.min862f.css?v=4.1.0")}} rel="stylesheet">
    <style type="text/css">
    	.img-circle{
    		width: 60px;
    	}
    </style>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始 session('a_logo') ? asset("session('a_logo')") : "img/profile_small.jpg"-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="{{thumbnail($admin->admin_pic)}}" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{{$admin->nickname}}</strong></span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="javascript:;">修改头像</a>
                                </li>
                                <li><a class="J_menuItem" href="javascript:;">个人资料</a>
                                </li>
                                <li><a class="J_menuItem" href="javascript:;">联系我们</a>
                                </li>
                                <li><a class="J_menuItem" href="javascript:;">信箱</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{url('admin/loginout')}}">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">嘉
                        </div>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{url('admin/home')}}" data-index="0">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">首页</span>
                            <span class="fa arrow"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-lock"></i>
                            <span class="nav-label">权限管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="admin">管理员列表</a></li>
                            <li><a class="J_menuItem" href="javascript:;">权限列表</a></li>
                            <li><a class="J_menuItem" href="javascript:;">角色列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">用户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="user">用户列表</a></li>
                            <li><a class="J_menuItem" href="tutorStudent">导师学员</a></li>
                            <!-- <li><a class="J_menuItem" href="javascript:;">导师列表</a></li> -->
                            <!-- <li><a class="J_menuItem" href="javascript:;">学员列表</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-file-excel-o"></i>
                            <span class="nav-label">内容管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="video">视频列表</a></li>
                            <li><a class="J_menuItem" href="article">文章列表</a></li>
                            <li><a class="J_menuItem" href="advertising">广告列表</a></li>
                            <li>
                                <a href="#">
                                    <span class="nav-label">新文章管理</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level">
                                    <li><a class="J_menuItem" href="jbdx/article">新文章列表</a></li>
                                    <li><a class="J_menuItem" href="jbdx/article/recommend">新文章推荐列表</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-gear"></i>
                            <span class="nav-label">设置管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="category">分类列表</a>
                                <a class="J_menuItem" href="navigation">导航列表</a>
                                <a class="J_menuItem" href="label">标签列表</a>
                                <a class="J_menuItem" href="hotbot">热搜列表</a>
                                <a class="J_menuItem" href="recommend">推荐位列表</a>
                                <a class="J_menuItem" href="column">栏目列表</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-tachometer"></i>
                            <span class="nav-label">活动管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="metting">年会活动</a>
                                <!-- <a class="J_menuItem" href="navigation">导航列表</a> -->
                                <!-- <a class="J_menuItem" href="label">标签列表</a> -->
                                <!-- <a class="J_menuItem" href="hotbot">热搜列表</a> -->
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span class="nav-label">课程管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="jbdx/course">课程列表</a>
                                <a class="J_menuItem" href="jbdx/order">课程订单</a>
                                <a class="J_menuItem" href="jbdx/gjkc">线下报名</a>
                                <a class="J_menuItem" href="jbdx/discussion">议题列表</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                    	<!-- 邮件 -->
                        <!-- <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="m-t-xs">
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right">46小时前</small>
                                            <strong>小四</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                            <br>
                                            <small class="text-muted">3天前 2014.11.8</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy">25小时前</small>
                                            <strong>国民岳父</strong> 如何看待“男子不满自己爱犬被称为狗，刺伤路人”？——这人比犬还凶
                                            <br>
                                            <small class="text-muted">昨天</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> -->
                        <!-- 通知 -->
                        <!-- <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-qq fa-fw"></i> 3条新回复
                                            <span class="pull-right text-muted small">12分钟钱</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> -->
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- 选项卡定位 -->
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="{{url('admin/home')}}">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="{{url('admin/loginout')}}" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <!-- 内容页 -->
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="home" frameborder="0" data-id="home" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2018-2021 <a href="http://www.wcs21.top/" target="_blank">www.wcs21.top</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定宽度</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                                <span class="skin-name ">
		                         	<a href="#" class="s-skin-0">默认皮肤</a>
                    			</span>
                            </div>
                            <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                                	<a href="#" class="s-skin-1">蓝色主题</a>
                    			</span>
                            </div>
                            <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        			<a href="#" class="s-skin-3">黄色/紫色主题</a>
                    			</span>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
        <!--mini聊天窗口开始-->
        <div id="small-chat">
            <span class="badge badge-warning pull-right"></span>
            <a class="open-small-chat" >
                <i class="fa fa-comments"></i>

            </a>
        </div>
    </div>
    <script src={{asset("Admin/js/jquery.min.js?v=2.1.4")}}></script>
    <script src={{asset("Admin/js/bootstrap.min.js?v=3.3.6")}}></script>
    <script src={{asset("Admin/js/plugins/metisMenu/jquery.metisMenu.js")}}></script>
    <script src={{asset("Admin/js/plugins/slimscroll/jquery.slimscroll.min.js")}}></script>
    <script src={{asset("Admin/js/plugins/layer/layer.min.js")}}></script>
    <script src={{asset("Admin/js/hplus.min.js?v=4.1.0")}}></script>
    <script type="text/javascript" src={{asset("Admin/js/contabs.min.js")}}></script>
    <script src={{asset("Admin/js/plugins/pace/pace.min.js")}}></script>
</body>
</html>
