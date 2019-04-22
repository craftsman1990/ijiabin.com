@extends('layouts.university')
@section('title','设置密码')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/loginAmend.css')}}">
  
  <div class="wrapper">
    <div class="line"></div>
    <div class="form">
    @include('layouts.u_hint')
 	<form action="" method="post" id="form1">
      <div class="pas">密码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="password" name="password" id="pwd" placeholder="密码"required>
        <img src="{{asset('University/images/icon_changkai@2x.png')}}" alt="" id="eyesShow">
        <img src="{{asset('University/images/icon_baomi@2x.png')}}" alt="" id="eyesHide">
      </div>
      <div class="pas1">确认密码&nbsp;<input type="password" name="password_confirmation" id="pwd1" placeholder="确认密码" required>
        <img src="{{asset('University/images/icon_qingchu@2x.png')}}" alt="" id="close">
      </div>
      <p class="t">6~18位英文字母及数字组合</p>
      <!-- <button id="btn">免费获取验证码</button> -->
      <button class="btn" type="submit" disabled="disabled">提交</button>
      {{ csrf_field() }}
    </form> 
    </div>
    <p class="no"></p>
  </div>

  <script type="text/javascript">
	  //小眼睛
	  $("#eyesHide").click(function(){
	    console.log(1)
	    if($("#pwd").attr("type")=="password"){
	      $("#pwd").attr('type','text');
	      $("#eyesShow").show();
	      $("#eyesHide").hide();
	    }
	  });
	  $("#eyesShow").click(function(){
	    if($("#pwd").attr("type")=="text"){
	      $("#pwd").attr('type','password');
	      $("#eyesShow").hide();
	      $("#eyesHide").show();
	    }
	  });

	  //button禁用可用
	  function content(){
	    var pwd = $("#pwd").val().trim();
	    var pwdlen = pwd.length;
	    var pwd1 = $("#pwd1").val().trim();
	    var pwd1len = pwd1.length;

	    if(pwdlen&&pwd1len!=0){
	      $(".btn").attr("disabled",false);
	      $('.btn').addClass('btn1')
	    }else{
	      $(".btn").attr("disabled",true);
	      $('.btn').removeClass('btn1')
	    }
	  }
	  pwd.onkeyup = function(){
	    content();
	  }
	  pwd1.onkeyup = function(){
    content()
			var pwd1 = $("#pwd1").val().trim();
			var pwd1len = pwd1.length;
			console.log(pwd1len)
			if(pwd1len!=0){
				$("#close").css("display","block");
			}else if(pwd1len==0){
				$("#close").css("display","none");
			}
		}
		$("#close").click(function(){
			$("#close").css("display","none");
			$("#pwd1").val('');
		})

  
	  $('#form1').submit(function(){
	    var pwdV = $("#pwd").val();
	    var pwd1V = $("#pwd1").val();
	    var pasw = /^[a-zA-Z0-9]{6,18}$/;
	    if (!pasw.test(pwdV)) {
	    	$(".no").text('密码格式错误');
	    	$(".no").css("display","block");
		    setTimeout(function(){//定时器 
		        $(".no").css("display","none");
		    },2000);
			return false;
	    }
	    if(pwdV != pwd1V){
	    	$(".no").text('两次输入不一致');
			$(".no").css("display","block");
		    setTimeout(function(){//定时器 
		        $(".no").css("display","none");
		    },2000);
	      	return false;
	    }
			
	  })

	</script>
@stop
