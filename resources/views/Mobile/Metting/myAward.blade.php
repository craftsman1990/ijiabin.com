<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <title>我的奖品</title>
  <link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/reset.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/conversion.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/log.css')}}">
  <script>
    (function (doc, win) {
      var docEl = doc.documentElement,
          resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
          recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            docEl.style.fontSize = 5 * (clientWidth / 100) + 'px';
          };
  
      if (!doc.addEventListener) return;
      win.addEventListener(resizeEvt, recalc, false);
      doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
  </script>
</head>
<body>
  @if($data['status'] == 1)
    <div class="top">
      <p class='prize_name'>奖品名称：<span>{{$data['award']->name}}</span></p>
      <p class="winner_name">中奖人姓名：{{$data['user']->truename}}</p>
      <p class="winner_tel">中奖人电话：{{$data['user']->mobile}}</p>
      <p class="winner_site">收货地址：{{$data['user']->address}}</p>
      <p class="wx_name">微信昵称：{{$data['user']->nickname}}</p>
      <p class="win_time">中奖时间：{{$data['winner']['time']}}</p>
      <p class="win_code">中奖编号：{{$data['winner']['id']}}</p>
      <p class='prize_name'>奖品状态：<span>{{$data['winner']['is_receive']==1 ? '已派送' : '未派送'}}</span></p>
      <p class="phone">客服电话：13264580706</p>
      @if(!$data['user']->truename || !$data['user']->mobile || !$data['user']->address)
      <p class="hint1">提示：您尚未填写收获信息，奖品将无法邮寄！请点击下方“填写收货信息”完善相应信息，以便奖品及时寄出！</p>
      <button id="btn-lq" onclick="window.location.href='{{url('mobile/metting/register?uid='.$data['user']->id)}}'">填写收货信息</button>
      @endif
    </div>
    
  @else
    <div class="wrapper">
      <p class="none"><img src="{{asset('Mobile/metting/images/empty.png')}}" alt=""></p>
      <p class="none">您还没有获得奖品哦～</p>
    </div>
  @endif
</body>
</html>