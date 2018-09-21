<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>POWER2018新时代新经济嘉宾峰会</title>
  <link rel="stylesheet" href="{{asset('Mobile/fonts/iconfont.css')}}">  
  <link rel="stylesheet" href="{{asset('Mobile/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('Mobile/css/meeting.css')}}">
</head>
<script src={{asset("Home/js/jquery.min.js")}}></script>
  <script>
		var wid = $(window).width();
		if(wid>750){
			window.location.href="{{url('page/meeting_2018')}}"
		}
		$(window).resize(function () {          //当浏览器大小变化时
			var wida = $(window).width();
			if(wida>750){
				window.location.href="{{url('page/meeting_2018')}}"
			}
		});
	</script>
<style>
.centera{
  background:url("{{asset('Mobile/images/imgMeeting/bg.png')}}") no-repeat;
  background-size:cover;
}
</style>
<body>
    <div data-role="page" id="pageone">
      <div data-role="panel" id="myPanel"> 
          <p class="nav_top"><img src="{{asset('Mobile/images/imgMeeting/nav_icon.png')}}" alt=""></p>
          <h4 id="home" class="list1">峰会简介</h4>
          <h4 class="list2">商业盛典</h4>
          <h4 class="list3">新时代商业案例榜单</h4>
          <h4 class="list4">互动展区</h4>
          <h4 class="list5">合作伙伴</h4>
          <h4 class="list6">相关问题</h4>
          <h4 class="list6">地点</h4>
          <h4 class="list7">联系我们</h4>
          </ul>
      </div> 
      <div  data-role="header"  class="header">
        <a><img src="{{asset('Mobile/images/imgMeeting/h_logo.png')}}" alt=""></a>
        <a href="javascript:;" id="pagehide"><i class="icon iconfont icon-mulu"></i></a>
      </div>
      <div class="centera">
        <div class="banner">
          <img src="{{asset('Mobile/images/imgMeeting/ban.png')}}" alt="">
        </div>
        <p class="all_synopsis">
            “改革 破界 共生 · POWER2018 新时代新经济嘉宾峰会”是嘉宾大学、「我有嘉宾」联手改革破局地——深圳，为世界呈现的2018高峰会议，聚集国内外千余位政商产学研界顶级领袖与行业先锋、并力邀国内外多地市长齐聚，全天候高浓度洞见、探讨、分析、预测中国未来商业新趋势，更与FT（英国金融时报）中文网等专业媒体联合发布重量级榜单。
        </p>
        <div class="figure">
          <img src="{{asset('Mobile/images/imgMeeting/figure.png')}}" alt="">
        </div>
        <div class="boxs">
          <div class="new">
            <div class="list_titer">
              <img src="{{asset('Mobile/images/imgMeeting/list-titer1.png')}}" alt="">
            </div>
            <p class="list_synopsis">
                峰会将以三个篇章-“改革”、“破界”、“共生”探讨中国以及全球商业在政策、技术、产业、科学的推动下，带来的变革、跨界、迭代与融合；在开放思想与创新思维的激发下，带来的新可能性与新规则，以及对中国未来商业趋势的预测。
            </p>
            <div class="guests">
              <img src="{{asset('Mobile/images/imgMeeting/guests1.png')}}" alt="">
              <img src="{{asset('Mobile/images/imgMeeting/guests2.png')}}" alt="">
              <img src="{{asset('Mobile/images/imgMeeting/guests3.png')}}" alt="">
            </div>
          </div>
          <div class="2018">
            <div class="list2_titer">
              <img src="{{asset('Mobile/images/imgMeeting/2018.png')}}" alt="">
            </div>
            <p class="list_synopsis">
                新时代商业盛典将发布新时代商业案例榜单、举办颁奖典礼，并同期举办商界歌王争霸赛。
            </p>
            <div class="img_2018">
              <img src="{{asset('Mobile/images/imgMeeting/2018_img.png')}}" alt="">
            </div>
          </div>
          <div class="china_power">
            <div class="list2_titer">
              <img src="{{asset('Mobile/images/imgMeeting/china_power.png')}}" alt="">
            </div>
            <p class="logos">
              <img class="logos" src="{{asset('Mobile/images/imgMeeting/logos.png')}}" alt="">
            </p>
            <p class="times">
              <img class="time" src="{{asset('Mobile/images/imgMeeting/time.png')}}" alt="">
            </p>
            <p class="list_synopsis">
                每一个敢于用创新的力量去引领时代、改变世界的人都值得荣耀。嘉宾传媒联合FT中文网，挖掘七大行业的100家中国企业，发布「中国力量」POWER100商业案例榜单，致敬具有创造精神、冒险精神的时代先锋。
            </p>    
            <div class="top">
              <!-- {{url('page/pageTop40')}} -->
              <a href="JavaScript:;"><img src="{{asset('Mobile/images/imgMeeting/top40.png')}}" alt=""></a>
            </div>
          </div>  
          <div class="interact">
            <div class="list2_titer">
              <img src="{{asset('Mobile/images/imgMeeting/interact.png')}}" alt="">
            </div>
            <p class="list_synopsis">
                新商业下，人们的物质基础服务与精神教育服务 都随之改变，融入新的科技产品、新的娱乐内容、 新的体验模式等，搭建未来体验展区，同时将新 商业下的成果及未来可能性展示在大众面前。
            </p>
            <div class="interact_con">
              <img src="{{asset('Mobile/images/imgMeeting/interact_img.png')}}" alt="">
            </div>
          </div>
          <div class="teamwork_box">
            <h4>合作伙伴</h4>
            <div class="tw_list">
              <p class="tw_list_tit"><span>主办单位</span></p>
              <div class="tw_list_con">
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/wyjb.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/jbdx.png')}}" alt=""></a>
              </div>
            </div>
            <div class="tw_list">
              <p class="tw_list_tit"><span>协办单位</span></p>
              <div class="tw_list_con">
                <p>深圳市南山区企业发展服务中心</p>
              </div>
            </div>
            <div class="tw_list">
              <p class="tw_list_tit"><span>战略合作伙伴</span></p>
              <div class="tw_list_con">
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/zww.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/kdxf.png')}}" alt=""></a>
              </div>
            </div>
            <div class="tw_list">
              <p class="tw_list_tit"><span>品牌合作伙伴</span></p>
              <div class="tw_list_con tw_lists">
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/sqyc.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/szss.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/lmm.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/xzdz.png')}}" alt=""></a>
              </div>
            </div>
            <div class="tw_list">
              <p class="tw_list_tit"><span>合作媒体</span></p>
              <div class="tw_list_con tw_lists">
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/36kr.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/tx.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/xl.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/nbd.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/zaker.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/jm.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/hs.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/zc.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/ly.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/donews.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/zqsb.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/cyj.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/hxws.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/tysp.png')}}" alt=""></a>                
              </div>
            </div>
            <div class="tw_list">
              <p class="tw_list_tit"><span>官方视频直播平台</span></p>
              <div class="tw_list_con tw_lists">
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/yxzb.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/szb.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/hj.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/dy.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/wh.png')}}" alt=""></a>
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/sy.png')}}" alt=""></a>
              </div>
            </div>
            <div class="tw_list">
              <p class="tw_list_tit"><span>官方独家票务合作伙伴</span></p>
              <div class="tw_list_con">
                <a href="javascript:;"><img src="{{asset('Mobile/images/imgMeeting/hdx.png')}}" alt=""></a>
              </div>
            </div>
          </div>
          <div class="issue_box">
            <h4>相关问题</h4>
            <div class="issue_list">
              <p class="topic"><img src="{{asset('Mobile/images/imgMeeting/icon.png')}}" alt="">如何报名，何时截止报名？</p>
              <p class="iss_con">请点击“立即购票”，选择票种；或在活动行PC端、手机端APP搜索“POWER 2018 新时代新经济嘉宾峰会”，点击页面进行购票
                峰会购票截止日期为 2018 年 10月 16 日 22:00</p>
            </div>
            <div class="issue_list">
              <p class="topic"><img src="{{asset('Mobile/images/imgMeeting/icon.png')}}" alt="">购票付款成功后，有凭证吗？如何签到？</p>
              <p class="iss_con">活动行购票成功后，会收到确认短信通知。在活动当天凭活动行发给您短信中的参会二维码，到深Reborn755签到处找工作人员签到，工作人员会扫取二维码并发放入场手环。</p>
            </div>
            <div class="issue_list">
              <p class="topic"><img src="{{asset('Mobile/images/imgMeeting/icon.png')}}" alt="">是否有座位图？会议现场是否需要对号入座？中途离开，座位是否可以保留？</p>
              <p class="iss_con">购票时，请选择票种，不同票种对应不同区域，暂没有指定座位号码，购票用户可根据现场指引，在指定区域就坐，如您中途离开会场，不能确保继续有座位</p>
            </div>
            <div class="issue_list">
              <p class="topic"><img src="{{asset('Mobile/images/imgMeeting/icon.png')}}" alt="">大会现场有同声传译服务吗？如何领取同传设备？</p>
              <p class="iss_con">现场有同传设备及服务支持，活动当天可凭本人身份证，到会场入场处换取同传设备，活动结束后，您需归还同传设备并取回身份证。</p>
            </div>
            <div class="issue_list">
              <p class="topic"><img src="{{asset('Mobile/images/imgMeeting/icon.png')}}" alt="">有活动相关照片及视频吗？</p>
              <p class="iss_con">我们会有专门的摄影团队在活动现场进行照片拍摄及上传，现场设置了照片传输通道，可扫描二维码获取，您也可以加会刊上的活动小助手微信，进入活动现场微信群，在第一时间获取活动照片。</p>
            </div>
          </div>
          <div class="map_box">
            <h4>地图</h4>
            <div class="map_con">
              <p class="mcon_list">
                <img src="{{asset('Mobile/images/imgMeeting/mcon_list1.png')}}" alt="">百度地图、高德地图搜索：Reborn755即可
              </p>
              <p class="mcon_list">
                <img src="{{asset('Mobile/images/imgMeeting/mcon_list2.png')}}" alt="">建议选取途经海上世界路线，场馆距离海上世界商圈 仅10分钟路程）
              </p>
              <p class="mcon_list">
                <img src="{{asset('Mobile/images/imgMeeting/mcon_list3.png')}}" alt="">赤湾地铁站（距离场馆直线距离2KM，约15分钟）， 可使用共享单车至会场
              </p>
              <p class="mcon_list">
                <img src="{{asset('Mobile/images/imgMeeting/mcon_list4.png')}}" alt="">226路左炮台站、226路油码头站
              </p>
            </div>
            <div id="map">
              <img src="{{asset('Mobile/images/imgMeeting/map.jpg')}}" alt="">
            </div>
          </div>
          <div class="relation_box">
            <h4>联系我们</h4>
            <div class="relation_con">
              <div class="rcon">
                <div class="left">
                  <p class="rel_img"><img src="{{asset('Mobile/images/imgMeeting/sw.png')}}" alt=""></p>
                  <p class="who">屈先生</p>
                  <p class="contact">W: 376717612</p>
                  <p class="contact">E: qugy@wetalktv.cn</p>
                </div>
                <div class="right">
                  <img src="{{asset('Mobile/images/imgMeeting/sw_code.png')}}" alt="">
                </div>
              </div>
              <div class="rcon">
                <div class="left">
                  <p class="rel_img"><img src="{{asset('Mobile/images/imgMeeting/mt.png')}}" alt=""></p>
                  <p class="who">梁女士</p>
                  <p class="contact">W: island1126</p>
                  <p class="contact">E: lh@wetalktv.cn</p>
                </div>
                <div class="right">
                  <img src="{{asset('Mobile/images/imgMeeting/mt_code.png')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="touch" onclick="window.location.href='http://t.cn/RFmd6vb'">
          <img src="{{asset('Mobile/images/imgMeeting/touch.png')}}" alt="">
        </div>
      </div>
    </div>
  <input type="hidden" name="url" value="{{asset('mobile/page/meeting_2018_map')}}">
  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
  <!-- <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=Ddk4dEgl09mEERDAV94xx6SgeyWmzw8V"></script> -->
  <input type="hidden" id="signature" value="{{$signPackage['signature']}}">
  <input type="hidden" id="noncestr" value="{{$signPackage['nonceStr']}}">
  <input type="hidden" id="timestamp" value="{{$signPackage['timestamp']}}">
  <input type="hidden" id="appId" value="{{$signPackage['appId']}}">
  <script>
    $("#oranger li a").on("mouseover",function(){ //给li标签添加事件  
      var index=$(this).parent().index();  //获取当前li标签的个数  
      $(this).parent().parent().next().find(".box").hide().eq(index).show(); //返回上一层，在下面查找css名为box隐藏，然后选中的显示  
      $(this).addClass("hover").parent().siblings().children().removeClass("hover"); //a标签样式
    })

    $("#pagehide").click(function(){
      $("#myPanel").toggle()
    })
    //地图
    $("#map").click(function(){
      var url = $('[name=url]').val();
      location.href = url;
    })

    /*楼层效果*/
    $('#myPanel h4').click(function(){
      $(this).css("color","#AC2E24").siblings().css("color","#fff")
      $("#myPanel").css("display","none")
      if($(this).index()-1 == $('#myPanel h4')){
          $(document).scrollTop(0);
      }else {
          var scollTop = $('.boxs').children('div').eq($(this).index()-1).offset().top;
          $(document).scrollTop(scollTop-200);
      }
    });
    
    $(".nav_top").click(function(){
      $(document).scrollTop(0);
      $("#myPanel").css("display","none")
    })

  </script>

<script type="text/javascript">
    var timestamp = $('#timestamp').val();
    var noncestr = $('#noncestr').val();
    var signature = $('#signature').val();
    var appId = $('#appId').val();
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: appId, // 必填，公众号的唯一标识
            timestamp: timestamp, // 必填，生成签名的时间戳
            nonceStr: noncestr, // 必填，生成签名的随机串
            signature: signature,// 必填，签名，见附录1
            jsApiList: ['checkJsApi',
            'onMenuShareTimeline',//
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });

        window.share_config = {
             "share": {
                "imgUrl": "https://www.ijiabin.com/Mobile/images/nhfx.jpg",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议前缀必须在。
                "desc" : "10.18 深圳·南山",//摘要,如果分享到朋友圈的话，不显示摘要。
                "title" : '改革·破界·共生 POWER2018新时代新经济嘉宾峰会',//分享卡片标题
                "link": window.location.href,//分享出去后的链接，这里可以将链接设置为另一个页面。
                "success":function(){
                    //分享成功后的回调函数
                },
                'cancel': function () { 
                    // 用户取消分享后执行的回调函数
                }
            }
        }; 
        wx.ready(function () {
            wx.onMenuShareAppMessage(share_config.share);//分享给好友
            wx.onMenuShareTimeline(share_config.share);//分享到朋友圈
            wx.onMenuShareQQ(share_config.share);//分享给手机QQ
        });
</script>
</body>
</html>