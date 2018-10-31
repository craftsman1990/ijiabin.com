<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <title>领取奖品</title>
  <link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/reset.css')}}">
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
  <style>
    #btn-lq1{
      border-radius: 0.3rem; background-color: #D7AA6F; color:#000; border: none; padding: 0.4rem 1rem;
      display: inline-block;
      width: 70%;
      height: 2rem;
      margin: 0 15%;
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <p class="line"><img src="{{asset($award->pic)}}" alt=""><img class="wedded" src="{{asset('Mobile/metting/images/wedded.png')}}" alt=""></p>
    <button id="btn-lq" onclick="window.location.href='{{url('mobile/metting/myAward/uid/'.$award->uid)}}'">查看奖品详情</button>
    <button id="btn-lq1" onclick="window.location.href='{{url('mobile/metting/luckyDraw')}}'">返回首页</button>
  </div>
</body>
</html>