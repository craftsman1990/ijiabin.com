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
</head>
<body>
  <div class="wrapper">
    <form action="{{url('mobile/metting/doRegister')}}" method="post">
      <p class="fill"><span><em>*</em>姓名：</span><input type="text" name="truename" id="username" placeholder="请填写收件人姓名"></p>
      <p class="fill"><span><em>*</em>手机号：</span><input type="tel" name="mobile" id="myphone" placeholder="请填写收件人电话" maxlength="11"></p>
      <p class="fill3"><span><em>*</em>收货地址：</span><textarea rows="3" name="address" id="site" placeholder="请填写收货地址"></textarea></p>
      <p class="hint">提示：奖品将在会后免费邮寄至以上所填地址，请确保信息填写正确！</p>
      {{ csrf_field() }}
      <input type="hidden" name="uid" value="{{$uid}}">
      <button id="btn-lq" type="submit">提交</button>
    </form>
  </div>

  <script type="text/javascript" src="{{asset('Mobile/metting/js/jquery.min.js')}}"></script>
  <script>
    //登记
    $("form").submit(function(){
      var phone = document.getElementById('myphone').value;
        if($("#username").val()=="" || phone =="" || $("#site").val()==""){
            alert("请输补全信息！");
            return false;
        }
        if(!(/^1(3|4|5|6|7|8|9)\d{9}$/.test(phone))){ 
              alert("手机号码有误，请重填");  
              return false; 
          } 
    });
  </script>
</body>
</html>