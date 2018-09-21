<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>POWER100·中国商业案例</title>
    <link rel="icon" type="image/x-icon" href="{{asset('Home/images/meeting.ico')}}" />
    <link rel="stylesheet" href="{{asset('Home/css/top.css')}}" charset="utf-8">
    <link rel="stylesheet" media="screen and (max-width:750px)" href="{{asset('Home/css/reset.css')}}" charset="utf-8">
    <link rel="stylesheet" media="screen and (max-width:750px)" href="{{asset('Home/css/toph5.css')}}" charset="utf-8">
    <style type="text/css">
      .top_box{
        background-image: url({{asset('Home/images/imgTop/back.png')}});
      }
    </style>
</head>
<body>
    <div class="top_box">
      <div class="box-top1">
        <img class="top1_LT" src="{{asset('Home/images/imgTop/power100@2x.png')}}" alt="">
        <img class="top1_rig" src="{{asset('Home/images/imgTop/theme.png')}}" alt="">
      </div>
      <div class="box_ban">
        <img src="{{asset('Home/images/imgTop/banner.png')}}" alt="">
      </div>
      <div class="box_tit1">
        <p class="tit1">
          中国商业处在一个非常动荡的时代， 但是这也是非常幸运的时代。
        </p>
        <p class="tit1-img"><img src="{{asset('Home/images/imgTop/power.png')}}" alt=""></p>
      </div>
      <div class="box_lead">
        <div class="leadcon">
          <p>随着中国科技力量的发展，人工智能、云计算、区块链等前沿科技的兴起，加之资本的推动，催生出新的产业、新的业态、新的经济增长。</p>
          <p>我们看到了O2O、VR、共享经济等风口的诞生和洗牌，也看到了AI、区块链、生物基因等新产业的巨大发展前景。科技与资本协同作用，在各行各业催生出新的可能性，政商产学研合力推动着中国产业迭代升级。</p>
          <p>这是一个动荡的商业时代，但也是一个充满机遇的商业时代。中国诞生了很多新独角兽企业，这不仅是中国商业的创新突破，同时也是普惠大众的伟大实践。</p>
          <p>每一个敢于用创新力量去引领时代、改变世界的人都值得荣耀。嘉宾传媒联合FT中文网，挖掘七大行业的100家中国企业，发布「中国力量」POWER100商业案例榜单，并从中甄选了40位近年来对中国商业作出杰出贡献的商业人物，致敬具有创造精神、冒险精神的时代先锋。</p>
        </div>
      </div>
      <div class="box_top40">
        <img src="{{asset('Home/images/imgTop/top40.png')}}" alt="">
      </div>
      <div class="top40_con">
        <div class="one">
         
        </div>
        <div class="two">
         
        </div>
        <div class="three">
           
        </div>
        <div class="four">
           
        </div>
        <div class="five">
           
        </div>
      </div>
      <div class="box-bom">
        <p class="cen">
          <img src="{{asset('Home/images/imgTop/wyjb_logo.png')}}" alt="">
          x
          <img src="{{asset('Home/images/imgTop/zww.png')}}" alt="">
        </p>
      </div>
    </div>
    <input type="hidden" id="top40_pc" value="{{$data['top40_pc']}}">
    <input type="hidden" id="top40_yd" value="{{$data['top40_yd']}}">
    <input type="hidden" id="signature" value="{{$signPackage['signature']}}">
    <input type="hidden" id="noncestr" value="{{$signPackage['nonceStr']}}">
    <input type="hidden" id="timestamp" value="{{$signPackage['timestamp']}}">
    <input type="hidden" id="appId" value="{{$signPackage['appId']}}">

    <script src="{{asset('Home/js/jquery.min.js')}}"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>

    <script>
      var pc = $.parseJSON($('#top40_pc').val());
      var yd = $.parseJSON($('#top40_yd').val());

      if(screen.width>750){
        $.each(pc.one, function (key, obj) {
          var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
          $('.one').append(lists);
        });
        $.each(pc.two, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.two').append(lists);
        });
        $.each(pc.three, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.three').append(lists);
        });
        $.each(pc.four, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.four').append(lists);
        });
        $.each(pc.five, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.five').append(lists);
        });
      }

      if(screen.width < 750){
        $.each(yd.one, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.one').append(lists);
        });
        $.each(yd.two, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.two').append(lists);
        });
        $.each(yd.three, function (key, obj) {
            var lists = '<a href="'+obj.url+'" target="_blank"><img src="'+obj.img+'" alt=""></a>';
            $('.three').append(lists);
        });
        $('.four').hide();
        $('.five').hide();
      }

    
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
                  "imgUrl": "http://www.ijiabin.com/Home/images/imgTop/fenxiang.jpg",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议前缀必须在。
                  "desc" : "诚邀您与我们一起寻找这些时代发展变革的动因，寻找100家正在或者即将引领时代、改变世界的企业。",//摘要,如果分享到朋友圈的话，不显示摘要。
                  "title" : 'POWER100 中国新时代商业案例榜单',//分享卡片标题
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