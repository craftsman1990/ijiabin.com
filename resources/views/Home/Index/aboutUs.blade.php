@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/program.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/program_1.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/aboutUs.css')}}">
<body>
    <div class="wrapper">
        @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <div class="main-left">
                     <ul class="left-list">
                        <li class="{{$data['secId'] == 24 ? 'active seled' : ''}}">
                            <a href="#home" data-toggle="tab">公司简介</a>
                        </li>
                        <li class="{{$data['secId'] == 25 ? 'active seled' : ''}}">
                            <a href="#ios1" data-toggle="tab">创始人吴婷</a>
                        </li>
                        <li class="{{$data['secId'] == 26 ? 'active seled' : ''}}">
                            <a href="#ios2" data-toggle="tab">合作伙伴</a>
                        </li>
                        <li class="{{$data['secId'] == 27 ? 'active seled' : ''}}">
                            <a href="#ios3" data-toggle="tab">合作联系</a>
                        </li>
                        <li class="{{$data['secId'] == 28 ? 'active seled' : ''}}">
                            <a href="#ios4" data-toggle="tab">加入我们</a>
                        </li>
                        <!-- <li class="{{$data['secId'] == 29 ? 'active seled' : ''}}">
                            <a href="#ios5" data-toggle="tab">寻求报道</a>
                        </li> -->
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade {{$data['secId'] == 24 ? 'in active' : ''}}" id="home">
                            <div class="main-right">
                                <p class="text-company-profile"><b>公司简介</b></p>
                                <div class="Company-profile">
                                    <p class="logo">
                                        <img class="logo_img" src="{{asset('Home/images/logo.jpg')}}" alt="">
                                    </p>
                                    <h4 class="jj_tit">
                                        遍访天下公司、纪录时代商业。
                                    </h4>
                                    <div class="con">
                                            深圳嘉宾传媒有限公司创立于2016年，是新时代下新商业与新商学的生态打造者，出品优质商业内容、提供商学教育服务，目前已创 立《我有嘉宾》全媒体产品、嘉宾大学教育平台。每年公司陪跑与服务全球范围内500+商业领袖，优质内容触达与影响 中高端人群达6亿人次；同时公司为诸多高速成长中的企业提供战略咨询、品牌服务、价值管理、投融资服务等，帮助企 业打开见识、重构认知、链接价值，并将见识转化为生产力。嘉宾传媒创办以来获得深创投、同创伟业等顶尖投资机构， 以及阎焱、吴军、李斌、倪正东等商界知名人士投资，与美的、奥飞、58集团、科大讯飞、奇瑞、比亚迪、蔚来汽车、 BOSS直聘、一下科技、首汽移动出行、京东、百度、小米、VIPKID、华大基因、柔宇科技、优客工场、永安行、洛可可 等数百家企业达成长期战略合作关系，共建新商业生态；并与芜湖市人民政府、中国人民大学商学院、中国人民大学创业 学院、中国青年天使会、中国国际青年交流中心等政府机关、组织机构成为战略伙伴，共同在商业、传媒、教育、投资、 研究等多个领域探索与尝试。
                                    </div>
                                    <div class="second_tit">
                                        <span>业务介绍</span>
                                    </div>
                                    <div class="third_tit">
                                        传媒
                                    </div>
                                    <p class="logo">
                                        <img src="{{asset('Home/images/wyjb_logo.png')}}" alt="">
                                    </p>
                                    <div class="fouth_tit_cen">
                                        新商业媒体品牌—「我有嘉宾」
                                    </div>
                                    <div class="fouth_tit">
                                        「我有嘉宾」商业纪实访谈节目
                                    </div>
                                    <div class="second_con">
                                            「我有嘉宾」节目以纪实的手法走访和对话了国内外近百位顶级商界领袖与新兴产业造物者，如周鸿祎、刘庆峰、姚劲波、 冯仑、吴军、马东、吴声、王煜全、毛大庆、米雯娟、周剑、胡海泉、赵普、周航、贾伟等。节目在广东卫视、山东电视 台等电视渠道，腾讯、爱奇艺、优酷、PPTV等网络视频平台，及北上深等一线城市各大机场同步播放，每年触达中高端 用户超过3.5亿人次。
                                    </div>
                                    <div class="fouth_tit">
                                        「我有嘉宾」品牌峰会&案例榜单发布
                                    </div>
                                    <div class="second_con">
                                            我有嘉宾」品牌峰会旗下有商界领袖年度峰会、独角兽峰会、行业公开课、商界歌王争霸赛等，已在北京、上海、深圳、 广州、三亚、合肥、芜湖等地举办。来自国内外人工智能、大数据、移动出行、新零售新消费、智能制造、前沿科技、文 创教育、金融投资等行业领袖到场授课、分享、思辨、交流，数万名创业者和投资人前来参会及高密度学习，峰会跨界、 开环，累计传播影响过亿人次，是商界一大主流盛会与独特风景。
                                    </div>
                                    <div class="second_con">
                                            2017年，嘉宾传媒联合FT中文网（Financial Times）共同推出“时代影响力·中国商业案例榜单TOP30”，旨在为新时代 下的优秀商业案例作注。评委团由国际知名经济学家、院士、教授、产业与投资界专家共同组成，京东、小米生态链、微 信、华为消费者BG、蚂蚁金服、华大基因、得到等企业案例都登上榜单。
                                    </div>
                                    <div class="fouth_tit">
                                        「我有嘉宾」商业案例与人物特稿
                                    </div>
                                    <div class="second_con">
                                            「我有嘉宾」聚焦新商业，挖掘新案例，每天讲述一个零距离商业故事，为时代著书、为企业立传，传承企业家精神、传 递正向的企业价值观。「我有嘉宾」在微信公众平台、小程序、微博、今日头条、搜狐、网易、界面、大鱼号、一点资讯、 百度百家、企鹅号、新浪财经、凤凰号、天天快报、WIFI万能钥匙、财经头条等全媒体矩阵精准覆盖用户超2亿，每月文 章阅读数超6000万。
                                    </div>
                                    <div class="second_tit">
                                        教育
                                    </div>
                                    <p class="logo">
                                        <img src="{{asset('Home/images/jbdx_logo.png')}}" alt="">
                                    </p>
                                    <div class="fouth_tit_cen">
                                        新商学教育品牌—嘉宾大学
                                    </div>
                                    <div class="second_con">
                                        嘉宾大学致力于打造国际化的新商学教育品牌，服务于高成长、高科技的新商业企业，以“全案例实战教学”为特色，集合 标杆企业深度访学、标杆案例实战学习、视频案例教学等创新模式，打通线上与线下课程，帮助新商业企业家和投资者重 构认知、打开见识、链接价值。
                                    </div>
                                    <h5 class="lit_tit">
                                        办学理念
                                    </h5>
                                    <ul class="list">
                                        <li>【轴翻转】从案例实战到学术理论</li>
                                        <li>【开环学习】破除茧房、跨界习得；使命驱动、终身学习 </li>
                                        <li>【校友共建】自由生长、价值共享，帮助校友几何级实现社会发展责任</li>
                                    </ul>
                                    <h5 class="lit_tit">
                                        课程体系
                                    </h5>
                                    <div class="class">
                                        <div class="class_left">
                                            <p class="s_class"><span></span>线上课程——</p>
                                            <div class="class_top">
                                                <p class="t_class"><em>公开课：</em>嘉宾故事</p>
                                                <p class="t_class">嘉宾预测</p>
                                                <p class="t_class">嘉宾观点</p>
                                            </div>
                                            <div class="class_bot">
                                                <p class="t_class"><em>会员课：</em>超级提问力</p>
                                                <p class="t_class">商业案例课</p>
                                                <p class="t_class">大师课</p>
                                            </div>
                                        </div>
                                        <div class="class_right">
                                            <p class="s_class"><span></span>线上课程——</p>
                                            <div class="class_top">
                                                <p class="s_class">嘉宾派</p>
                                                <p class="s_class">国际课程 </p>
                                                <p class="s_class">大师班 </p>
                                                <p class="s_class">产业加速院 </p>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="lit_tit">
                                        服务体系
                                    </h5>
                                    <div class="list">
                                        <p class="s_class"><span></span>以优质内容打造品牌影响力</p>
                                        <p class="s_class"><span></span>与地方政府联动合作</p>
                                        <p class="s_class"><span></span>地方校友会链接服务</p>
                                        <p class="s_class"><span></span>嘉宾大学发展基金助力加速</p>
                                        <p class="s_class"><span></span>校友共建产业研究院</p>
                                    </div>
                                    <div class="fouth_tit">
                                        标杆企业深度访学课程「嘉宾派」
                                    </div>
                                    <div class="second_con">
                                        获破界之识、行价值之旅、得莫逆之交。嘉宾大学旗下的标杆企业深度访学课程「嘉宾派」，带领学员深入到企业内部， 学习鲜活案例、复盘自我成长，先后进入美的、华大基因、比亚迪、58集团、360、科大讯飞、奥飞、三一重工、BOSS 直聘、柔宇科技、奇瑞汽车等逾百家知名企业。百余名高成长、高科技公司，独角兽企业，上市公司，知名投资机构投资 人成为嘉宾派校友。更有多位校友在嘉宾派的帮助下合作共赢、成功融资、晋升为独角兽企业。
                                    </div>
                                    <div class="list">
                                        <p class="s_class"><span></span>参与伟大产品的共建与迭代</p>
                                        <p class="s_class"><span></span>见证标杆企业成长的隐秘故事</p>
                                        <p class="s_class"><span></span>和高速成长的新经济独角兽亲密接触</p>
                                        <p class="s_class"><span></span>纪录每一位校友的商业案例</p>
                                        <p class="s_class"><span></span>感同身受关于未来、竞争、机遇、价值、冒险、争议、责任</p>
                                    </div>
                                    <div class="third_tit">
                                        价值管理
                                    </div>
                                    <div class="fouth_tit_cen">
                                        新商学教育品牌—嘉宾大学
                                    </div>
                                    <div class="fouth_tit">定制化服务</div>
                                    <div class="list">
                                        <p class="s_class"><span></span>战略咨询</p>
                                        <p class="s_class"><span></span>整合营销</p>
                                        <p class="s_class"><span></span>内容定制</p>
                                        <p class="s_class"><span></span>财务顾问</p>
                                    </div>
                                    <div class="second_tit">
                                        <span>公司荣誉</span>
                                    </div>
                                    <div class="honor_list">
                                        <p class="s_class"><span></span>嘉宾传媒：</p>
                                        <p class="b_list">
                                            2017南方周末•年度新锐品牌
                                        </p>
                                    </div>
                                    <div class="honor_list">
                                        <p class="s_class"><span></span>节目《我有嘉宾》：</p>
                                        <p class="b_list">
                                            PP视频2017“聚能嗨”PGC大赏最受欢迎奖
                                        </p>
                                    </div>
                                    <div class="honor_list">
                                        <p class="s_class"><span></span>纪录片《一棵知道很多故事的树》：</p>
                                        <p class="b_list">
                                            中国第二届中国民族学学会影视人类学分会“学会奖”入围
                                        </p>
                                        <p class="b_list">
                                            2017 中国（广州）国际纪录片节“金红棉”评优单元复评环节入围
                                        </p>
                                    </div>
                                    <div class="honor_list">
                                        <p class="s_class"><span></span>纪录片《黑蜂的群舞》：</p>
                                        <p class="b_list">
                                            2015“金熊猫”国际纪录片节自然及环境类特别评委奖
                                        </p>
                                        <p class="b_list">
                                            2017 2015光影纪年——中国纪录片学院奖入围
                                        </p>
                                    </div>
                                    <div class="honor_list">
                                        <p class="s_class"><span></span>创始人吴婷：</p>
                                        <p class="b_list">
                                            猎云网最佳女性创业者
                                        </p>
                                        <p class="b_list">
                                            ECI中国商业创意人
                                        </p>
                                        <p class="b_list">
                                            中国人民大学创业导师
                                        </p>
                                        <p class="b_list">
                                            芜湖城市发展顾问
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade {{$data['secId'] == 25 ? 'in active' : ''}}" id="ios1">
                            <div class="main-right">
                                <p class="text-company-profile"><b>创始人吴婷</b></p>
                                <div class="Company-profile">
                                    <dl class="wt">
                                        <dt class="img"><img src="{{asset('Home/images/wt.jpg')}}" alt=""></dt>
                                        <dd class="wu_name">
                                            <h5>吴婷</h5>
                                            <p class="con_list">嘉宾传媒创始人,「我有嘉宾」出品人</p>
                                            <p class="con_list">嘉宾大学创办人</p>
                                        </dd>
                                    </dl>
                                    <p class="con">
                                        创始人吴婷具备12年以上传媒行业经验，毕业于长江商学院，现为中国人民大学创业导师、芜湖城市发展顾问、ECI商业 创意人、南方周末新锐品牌缔造人、猎云最佳女性创业者、金熊猫国际纪录片等奖项获得者。曾任职于安徽电视台，曾任 2004、2008年雅典、北京奥运会火炬手。吴婷在职业生涯的前期以调查记者、主持人身份奔走在民生一线、为百姓发声， 奠定了强大的群众基础。在转型后以纪录时代商业为己任，通过睿智犀利的风格对话阎焱、熊晓鸽、倪泽望、徐小平、冯 仑、毛大庆、郑伟鹤、刘庆峰、周鸿祎、姚劲波、马东、吴声、米雯娟、林斌、樊纲等数百位商界领袖与行业先锋人物， 做船头瞭望者与价值风向标。目前每年仍以主持人身份活跃在各大商界峰会，曾受邀主持全球移动互联网大会GMIC鸟巢 盛典、58集团年会、深创投国际化战略发布会、新京报寻找中国创客峰会、ECI国际数字商业创新节、经纬十周年、中国 青年天使会慈善晚宴等大型活动，并长期受邀担任投资界、投资中国、新浪、网易、凤凰、36氪、虎嗅等平台的重量级主 持，是业界公认的“创投界最牛女主持”。
                                    </p>
                                    <p class="csr_tit">
                                        <span></span>2016年至今
                                    </p>
                                    <p class="csr_titi_con">创办嘉宾传媒，出品制作《我有嘉宾》系列节目与案例，创办嘉宾大学与见识研究院，每年纪录和陪跑500+领袖级企 业家成长。</p>
                                    <ul class="csr_list">
                                        <li>获得猎云网最佳女性创业者；ECI中国商业创意人；</li>
                                        <li>带领嘉宾传媒获得南方周末2017年度新锐品牌；</li>
                                        <li>带领《我有嘉宾》获得PPTV 2017 PGC最受欢迎节目；</li>
                                        <li>带领公司出品纪录片《一棵知道很多故事的树》，获人类学大奖、入围广州纪录片“金红棉奖”。</li>
                                    </ul>
                                    <p class="csr_tit">
                                        <span></span>2006年~2015年
                                    </p>
                                    <p class="csr_titi_con">出品制作纪录片《黑蜂的群舞》，获“金熊猫”国际纪录片节评委特别奖、中国纪录片学院奖；</p>
                                    <p class="csr_titi_con">就职于安徽电视台，创办与主持《安徽年度经济人物》《帮女郎 帮你忙》《当红不让》等栏目，获得年度节目、安徽 新闻奖等。</p>                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$data['secId'] == 26 ? 'in active' : ''}}" id="ios2">
                            <div class="main-right">
                                <p class="text-company-profile"><b>合作伙伴</b></p>
                                <div class="Company-profile">
                                    <p class="hb_tit">
                                        <span></span>合作机构
                                    </p>
                                    <ul id="oranization">
                                    </ul>
                                    <p class="hb_tit">
                                            <span></span>合作媒体
                                        </p>
                                    <ul id="media">
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$data['secId'] == 27 ? 'in active' : ''}}" id="ios3">
                            <div class="main-right">
                                <p class="text-company-profile"><b>合作联系</b></p>
                                <div class="Company-profile">
                                    <div class="cooperation_top">
                                        <p class="coop_top_list">品牌/市场/媒体合作：<span>pr@wetalktv.cn</span></p>
                                        <p class="coop_top_list"> 电 话：<span>400-992-0420</span>（工作时间：周一至周五9:30-18:30）</p>
                                        <p class="coop_top_list">地 址： <span>北京市朝阳区光华路SOHO2期A座6-7嘉宾传媒</span></p>
                                    </div>
                                    <div class="cooperation_bot">
                                        <p class="media_list">新浪微博：@我有嘉宾WETALK</p>
                                        <p class="media_list">微信订阅号：我有嘉宾</p>
                                        <p class="media_list_img">
                                            <img src="{{asset('Home/images/wyjb.png')}}" alt="">
                                        </p>
                                        <p class="media_list">微信服务号：嘉宾大学</p>
                                        <p class="media_list_img">
                                            <img src="{{asset('Home/images/jbdx_code.png')}}" alt="">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$data['secId'] == 28 ? 'in active' : ''}}" id="ios4">
                            <div class="main-right">
                                <p class="text-company-profile"><b>加入我们</b></p>
                                <div class="Company-profile">
                                    <div class="second_tit join_se">
                                        你所不知道的嘉宾传媒
                                    </div>
                                    <ul class="poetry">
                                        <li class="li_first">我是如何俘获大咖的?</li>
                                        <li>爱TA，视如己出。</li>
                                        <li>细节，决定爱恨。</li>
                                        <li>每一个人都很重要。</li>
                                    </ul>
                                    <ul class="poetry">
                                        <li class="li_first">我们的价值观：</li>
                                        <li>作品如人品。</li>
                                        <li>誓死捍卫每一部作品。</li>
                                        <li>使命必达。</li>
                                        <li>拥抱变化。</li>
                                    </ul>
                                    <ul class="poetry">
                                        <li class="li_first">我们的美好愿景：</li>
                                        <li>遍访天下公司，</li>
                                        <li>纪录时代商业。</li>
                                    </ul>
                                    <ul class="poetry">
                                        <li class="li_first">我们的使命：</li>
                                        <li>为企业赋能，</li>
                                        <li>为社会增智。</li>
                                    </ul>
                                    <ul class="poetry">
                                        <li class="li_first">我们的目标方法论：</li>
                                        <li>做品质 </li>
                                        <li>做头部 </li>
                                        <li>灭绝型采访</li>
                                        <li>与其更好，不如不同</li>
                                    </ul>
                                    <p class="poetry_bot">这样的嘉宾传媒你有神马理由拒绝！！！</p>
                                    <p class="poetry_bot">欢迎有想法、有创意、有追求的你带上简历、带上作品投递我们邮箱：hr@wetalktv.cn</p>
                                    <div class="second_tit">
                                        <span>招聘岗位</span>
                                    </div>
                                    <div id="shrink">
                                        <dl>
                                            <dt judeg='1'>导演<span>+</span></dt>
                                            <dd>
                                                <li>1.3年以上相关工作经验，有人物纪录片、电视台人物访谈、微电影、TVC等项目经验优先考虑；</li>
                                                <li>2.有较好的文字功底，思路清晰，能写能拍能剪，享受创作过程；</li>
                                                <li>3.对娱乐明星等内容高度关注，对社会热点、潮流风向敏感，有对接明星艺人经验优先；</li>
                                                <li>4.沟通能力、协调能力、应变能力、团队合作能力强；</li>
                                                <li>5.具备很强的学习能力、抗压能力和责任心。</li>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt judeg='1'>记者<span>+</span></dt>
                                            <dd>
                                                <li class="job_tit">工作职责</li>
                                                <li>负责商业、科技、金融等新经济领域人物及公司案例稿采写；</li>
                                                <li>能独立完成选题、策划并产出深度内容。</li>
                                                <li>参与节目、案例、出版物等策划与文案工作。</li>
                                                <li class="job_tit">工作要求</li>
                                                <li>1.一年以上科技、财经、人物媒体工作经验，能独立完成深度选题策划及报道。</li>
                                                <li>2.有良好的沟通能力，知识面广，有一定的新闻敏感性，对科技、财经热点事件信息能迅速感知。</li>
                                                <li>3.靠谱，主动，能接受高强度工作者优先。</li>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt judeg='1'>策划经理<span>+</span></dt>
                                            <dd>
                                                <li class="job_tit">岗位职责</li>
                                                <li>1.独立策划、撰写品牌活动、营销策划方案，并跟进落地执行；</li>
                                                <li>2.能够整合公司产品、分析客户需求，为客户定制整合营销方案，并推进个产品部门执行，为效果负责；</li>
                                                <li>3.能够协助各产品部门进行产品策划，在内容、形式、商业化包装上给出建议；</li>
                                                <li>4.能够与客户经理配合，面对面与客户交流，挖掘客户需求，并在执行项目过程中，帮助客户解决项目相关问题</li>
                                                <li class="job_tit">任职资格：</li>
                                                <li>1.2年以上工作经验，有独立成案能力，对创新创业有一定了解；</li>
                                                <li>2.有科技或财经类媒体工作经验者优先；</li>
                                                <li>3.良好的语言沟通能力及文字表达能力，乐于与同事及客户沟通交流；</li>
                                                <li>4.本科以上学历，服务过创新科技企业、大型传统企业者优先；</li>
                                                <li>5.能用英文作为工作语言者优先（不作为硬性规定）。</li>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt judeg='1'>高级设计师<span>+</span></dt>
                                            <dd>
                                                <li class="job_tit">岗位职责</li>
                                                <li>1.三年以上互联网行业或者广告企业视觉设计经验，平面设计、工业设计、广告等相关专业本科学历优先；</li>
                                                <li>2.具有优秀的平面设计能力和较高审美，能够敏锐把握设计流行趋势，能独立承担项目决策和风格制定；</li>
                                                <li>3.具备严谨的思辨和学习创新能力、自驱能力、工作热情，有良好的团队沟通能力和项目推进能力；</li>
                                                <li>4.日常负责，banner、H5、专题页、热点海报、活动主视觉、线下物料等；</li>
                                                <li>5.具备多样设计手段，有3D、动效设计能力者优先；</li>
                                                <li>6.对教育及传媒感兴趣，并有一定理解；</li>
                                                <li>7.请感兴趣的小伙伴随简历附作品集。</li>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade {{$data['secId'] == 29 ? 'in active' : ''}}" id="ios5">
                            <div class="main-right">
                                <p class="text-company-profile"><b>寻求报道</b></p>
                                <div class="Company-profile">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="hzjg" value="{{$data['hzjg']}}">
    <input type="hidden" name="hzmt" value="{{$data['hzmt']}}">
        @include('layouts._footer')
        <!-- <script src="{{asset('Home/js/aboutUs.js')}}"></script> -->
        <script type="text/javascript">
            $('.left-list li').on('click',function(){
                $(this).addClass("seled").siblings().removeClass("seled");
            });

            // $('dl dt').on('click',function(){
            //     $(this).children('span').html('-');
            //     $(this).parent().siblings().children('dt').children('span').html('+');
            //     $(this).next().slideToggle();//点击展开
            //     $(this).parent().siblings().children('dd').slideUp();//只展开点击的其余的收起
            // })
            $('#shrink dl dt').on('click',function(){
                // var judeg = $(this).attr('judeg');
                // console.log($('#shrink dl dt').children('span').html())
                $(this).parent().siblings().children('dt').children('span').html('+');
                if($(this).attr('judeg') == 1){
                    
                    $(this).parent().siblings().children('dt').attr('judeg',1);
                    $(this).attr('judeg',0);
                    $(this).children('span').html('-');

                }else{
                    $(this).attr('judeg',1);
                    $(this).children('span').html('+');
                }

                $(this).next().slideToggle();//点击展开
                $(this).parent().siblings().children('dd').slideUp();//只展开点击的其余的收起
            })

            $(function(){
                var oranization = $.parseJSON($('[name=hzjg]').val());
                var media = $.parseJSON($('[name=hzmt]').val());
                $.each(oranization, function (index, ora_obj) {
                    var newli = '<li><a href="'+ora_obj.link+'" target="_blank"><img src="'+ora_obj.img+'" alt=""></a></li>'  
                    $('#oranization').append(newli);
                });
                $.each(media, function (index, med_obj) {
                    // console.log(med_obj.name+"..."+med_obj.link);
                    var newli = '<li><a href="'+med_obj.link+'" target="_blank">'+med_obj.name+'</a></li>'  
                    $('#media').append(newli);
                });
            })
        </script>

@stop