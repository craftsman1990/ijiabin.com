<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>2019年度「科创榜·POWER100」评选</title>
    <link rel="icon" type="image/x-icon" href="{{asset('Home/images/kcb.ico')}}" />
    <link rel="stylesheet" href="{{asset('Home/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('Home/css/meeting.css')}}">
</head>
<script src={{asset("Home/js/jquery.min.js")}}></script>
	<script>
		var wid = $(window).width();
		if(wid<750){
			window.location.href="{{url('mobile/page/meeting_2018')}}"
		}
		$(window).resize(function () {          //当浏览器大小变化时
			var wida = $(window).width();
			if(wida<750){
				window.location.href="{{url('mobile/page/meeting_2018')}}"
			}
		});
	</script>
<style>
  .issue_box{
    background:url({{asset('Home/images/imgPc/bot.png')}}) no-repeat !important;
    background-size:cover !important;
    width:100%;
    height:3450px;
  }
  .relation_box{
    background:background:rgba(255,255,255,1);
    width:100%;
    height:1100px;
  }
  .foot{
    position:relative;
    background:#050a2a;
    width:100%;
    height:508px;
    padding-top:160px;
    padding-left:22%;
    padding-right:22%;
  }
</style>
<body>
  <div class="meeting_box">
    <div class="header">
      <div class="header_ul">
        <p><img src="{{asset('Home/images/imgPc/logo.png')}}" alt=""></p>
        <ul class="h_rig">
          <li>评选亮点</li>
          <li>参选企业要求</li>
          <li>评选维度</li>
          <li>评选流程</li>
          <li>评选奖项</li>
          <li>评选嘉宾</li>
          <li>合作支持</li>
        </ul>
      </div>
    </div>
    <div class="centera">
      <!-- <div class="banner">
        <img src="{{asset('Home/images/imgPc/lightspot.png')}}" alt="">
      </div> -->
      <div class="boxs">
        <div class="new">
          <div class="banner">
            <img src="{{asset('Home/images/imgPc/lightspot.png')}}" alt="">
          </div>
        </div>
        <div class="2018">
          <div class="banner">
            <img src="{{asset('Home/images/imgPc/require.png')}}" alt="">
          </div>
        </div>
        <div class="china_power">
          <div class="banner">
            <img src="{{asset('Home/images/imgPc/appraise.png')}}" alt="">
          </div>
        </div>  
        <div class="interact">
          <div class="banner">
            <img src="{{asset('Home/images/imgPc/flow.png')}}" alt="">
          </div>
        </div>
        <div class="teamwork_box">
          <div class="banner">
            <img src="{{asset('Home/images/imgPc/awards.png')}}" alt="">
          </div>
        </div>
        <div class="issue_box">
          <p class="tit"><img src="{{asset('Home/images/imgPc/tit.png')}}" alt=""></p>
          <div class="box1">
            <p class="tit1"><img src="{{asset('Home/images/imgPc/xs.png')}}" alt=""></p>
            <ul>
              <li><img src="{{asset('Home/images/imgPc/cm.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/cwr.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ly.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/tlh.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/wj.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/wt.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/wyf.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zwx.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zhq.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/MichaelSchumann.png')}}" alt=""></li>
            </ul>
          </div>
          <div class="box2">
            <p class="tit1"><img src="{{asset('Home/images/imgPc/vp.png')}}" alt=""></p>
            <ul>
              <li><img src="{{asset('Home/images/imgPc/hyz.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/nzw.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ljw.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/sxt.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/xxl.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ygd.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ytc.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ysb.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/yy.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/yxy.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ywl.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zw.png')}}" alt=""></li>                        
            </ul>
          </div>
          <div class="box3">
            <p class="tit1"><img src="{{asset('Home/images/imgPc/qw.png')}}" alt=""></p>
            <ul>
              <li><img src="{{asset('Home/images/imgPc/wc.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/wx.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/ym.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/yrw.png')}}" alt=""></li>                       
            </ul>
          </div>
          <div class="box4">
            <p class="tit1"><img src="{{asset('Home/images/imgPc/kj.png')}}" alt=""></p>
            <ul>
              <li><img src="{{asset('Home/images/imgPc/lwh.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zxy.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zwr.png')}}" alt=""></li>                     
            </ul>
          </div>
          <div class="box5">
            <p class="tit1"><img src="{{asset('Home/images/imgPc/ls.png')}}" alt=""></p>
            <ul>
              <li><img src="{{asset('Home/images/imgPc/tzj.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zr.png')}}" alt=""></li>
              <li><img src="{{asset('Home/images/imgPc/zx.png')}}" alt=""></li>                      
            </ul>
          </div>
        </div>
        <div class="relation_box">
          <div class="list1">
            <p class="tit"><img src="{{asset('Home/images/imgPc/zbf.png')}}" alt=""></p>
            <ul>
              <li><a href="#"><img src="{{asset('Home/images/imgPc/logo/slzn.png')}}" alt=""></a></li>
            </ul>
          </div>
          <div class="list2">
            <p class="tit"><img src="{{asset('Home/images/imgPc/hzzz.png')}}" alt=""></p>
            <ul>
              <li><a href="#"><img src="{{asset('Home/images/imgPc/logo/ts.png')}}" alt=""></a></li>
              <li><a href="#"><img src="{{asset('Home/images/imgPc/logo/germany.png')}}" alt=""></a></li>
            </ul>
          </div>
          <div class="list3">
            <p class="tit"><img src="{{asset('Home/images/imgPc/hzjg.png')}}" alt=""></p>
            <ul>
              <li><a href="http://www.newone.com.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/zs.png')}}" alt=""></a></li>
              <li><a href="http://www.gyzq.com.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/gyzq.png')}}" alt=""></a></li>
              <li><a href="http://www.gf.com.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/gfzq.png')}}" alt=""></a></li>
              <li><a href="https://www.foundersc.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/fzzq.png')}}" alt=""></a></li>
              <li><a href="http://www.szvc.com.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/cx.png')}}" alt=""></a></li>
              <li><a href="http://www.saifpartners.com.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/saif.png')}}" alt=""></a></li>
              <li><a href="#"><img src="{{asset('Home/images/imgPc/logo/yo.png')}}" alt=""></a></li>
              <li><a href="http://www.addorcapital.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/addor.png')}}" alt=""></a></li>
              <li><a href="http://www.newmargin.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/lc.png')}}" alt=""></a></li>
              <li><a href="http://www.apluscap.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/htjj.png')}}" alt=""></a></li>
              <li><a href="http://www.huagaicapital.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/hgzb.png')}}" alt=""></a></li>
              <li><a href="http://stonevc.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/hszb.png')}}" alt=""></a></li>
              <li><a href="http://www.vstonecapital.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/kszb.png')}}" alt=""></a></li>
              <li><a href="http://www.axpfund.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/fdzb.png')}}" alt=""></a></li>
              <li><a href="http://www.zhenchengcap.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/zc.png')}}" alt=""></a></li>
              <li><a href="https://www2.deloitte.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/dq.png')}}" alt=""></a></li>
              <li><a href="https://www.pwccn.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/ph.png')}}" alt=""></a></li>
              <li><a href="http://www.zhonglun.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/zl.png')}}" alt=""></a></li>
              <li><a href="https://www.kwm.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/jd.png')}}" alt=""></a></li>
              <li><a href="http://www.jingtian.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/jt.png')}}" alt=""></a></li>
              <li><a href="https://www.rolandberger.com" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/berger.png')}}" alt=""></a></li>
              <li><a href="http://www.ceibs.edu" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/zo.png')}}" alt=""></a></li>
              <li><a href="http://www.sem.tsinghua.edu.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/qhjg.png')}}" alt=""></a></li>
              <li><a href="www.gsm.pku.edu.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/gh.png')}}" alt=""></a></li>
              <li><a href="https://www.tongji.edu.cn" target="_Blank"><img src="{{asset('Home/images/imgPc/logo/tj.png')}}" alt=""></a></li>
            </ul>
          </div>
          
        </div>
        <div class="foot">
          <p class="tit2"><img src="{{asset('Home/images/imgPc/lxfs.png')}}" alt=""></p>
          <div class="logo_box">
            <img src="{{asset('Home/images/imgPc/code1.png')}}" alt="">
            <p>企业报名通道</p>
          </div>
          <div class="logo_box">
            <img src="{{asset('Home/images/imgPc/code2.png')}}" alt="">
            <p>科创榜公众账号</p>
          </div>
          <ul class="logo_box">
            <li>「科创榜·POWER100」组委会</li>
            <li>组委会联系人:徐先生</li>
            <li>联系电话：150 1158 6867</li>
            <li>邮箱：xh@wetalktv.cn</li>
            <li>组委会联系人:梁先生</li>
            <li>联系电话：176 0026 0562</li>
            <li>邮箱：liangxianpeng@wetalktv.cn</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<input type="hidden" name="url" value="{{asset('page/meeting_2018_map')}}">

  <script src="{{asset('Home/js/jquery.min.js')}}"></script>
  <script>
    $(function(){

      /* 楼层 */
      // $('.h_rig li').click(function(){
      //   $(this).css("color","#AC2E24").siblings().css("color","#fff");
      //   if($(this).index()-1 == $('.h_rig li')){
      //       $(document).scrollTop(0);
      //   }else {
      //       var scollTop = $('.boxs').children('div').eq($(this).index()).offset().top;
      //       $(document).scrollTop(scollTop-200);
      //   }
      // });
      $('.h_rig li').click(function(){
        $(this).addClass('ser').siblings().removeClass('ser');
        if($(this).index() == $('.h_rig li').length){
            $(document).scrollTop(0);
        }else {
            var scollTop = $('.boxs').children('div').eq($(this).index()).offset().top;
            $(document).scrollTop(scollTop);
        }
      });
      // $(window).scroll(function () {
      //   //判断当前在哪一层
      //   for(var i =0;i < $('.boxs').children('div').length;i++){
      //       var topHeight = $(document).scrollTop() - $('.boxs').children('div').eq(i).offset().top;
      //       if(topHeight< $(window).height() && topHeight >0){
      //           $('.h_rig li').eq(i).css('color','#AC2E24');
      //       }else {
      //           $('.h_rig li').eq(i).css('color','#fff');
      //       }
      //   }
      // });
    })
  </script>
</body>
</html>