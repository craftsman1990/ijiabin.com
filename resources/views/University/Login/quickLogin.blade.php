@extends('layouts.university')
@section('title','快速登陆')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/login.css')}}">
	<div class="wrapper">
	    <p class="btn" onclick="window.location.href='{{url("university/login?source=".$parameter['source']."&yid=".$parameter['yid'])}}'">密码登录</p>
	    <div class="passwordBox">
	      <p class="tit"><img src="{{asset('University/images/jbdx.png')}}" alt="">快速登录</p>
	      <form action="" method="post">
		      <div class="form">
		        <input class="username" id="phone" type="tel" name="mobile" placeholder="手机号" value="{{old('mobile')}}">
		        <input class="num" type="text" name="yzm" placeholder="短信验证码" value="{{old('yzm')}}">
		        <input type="button" id="sendCode" value="免费获取验证码" class="sendCode" />
		        <!-- <button id="btn">免费获取验证码</button> -->
		        <div class="sub">
		        	{{ csrf_field() }}
		        	<input type="hidden" name="source" value="{{$parameter['source']}}">
		        	<input type="hidden" name="yid" value="{{$parameter['yid']}}">
		          <input type="submit" >
		        </div>
		      </div>
	      </form>
	      <p class="tt">未注册用户验证后自动登录</p>
	      <p class="ttt">登录即表示同意嘉宾大学<a href="{{url('university/serviceAgreement')}}">服务协议</a>和<a href="{{url('university/privacyPolicy')}}">隐私政策</a></p>
	    </div>
	</div>
	<div class="cover1 send_error">请填写正确的手机号</div>
	<div class="cover1 send_success">短信发送成功</div>
	 @include('layouts.u_hint')
	<script type="text/javascript">
		var countdown=60;
	    function settime(val) {
			if(countdown == 0) {
	            val.attr("disabled",false);
	            val.val('免费获取验证码');
	            countdown = 60;
	        } else {
	            val.attr("disabled",true);
	            val.val("重新发送(" + countdown + ")");
	            countdown--;
	            setTimeout(function() {
	                settime(val)
	            },1000)
	        }
	    }
	    $('#sendCode').click(function(){
			var phone = document.getElementById('phone').value;
	    	
	    	console.log(phone);
			if(!(/^1[34578]\d{9}$/.test(phone))){ 
				$(".send_error").css("display","block");
				setTimeout(function(){//定时器 
					$(".send_error").css("display","none");
				},3000);
			} else{
				settime($(this));
				var mobile = $('[name=mobile]').val();
	 			$.ajax({
	 				url:"{{url('university/getCode')}}",
	 				data:{mobile:mobile},
	 				type:'GET',
	 				async:false,
	 				dataType:'json',
	 				success:function(d){
	 					console.log(d);
	 					// alert(d.msg);
	 					$(".send_success").css("display","block");
						setTimeout(function(){//定时器 
							$(".send_success").css("display","none");
						},3000);	
	 				}
	 			})
			}


 			
 		});
	</script>




 	
@stop