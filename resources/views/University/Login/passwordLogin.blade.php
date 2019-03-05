@extends('layouts.university')
@section('title','密码登陆')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/login.css')}}">
	<style>
	  .ttt{
	    margin-top:.16rem;
	  }
	</style>
 	<div class="wrapper">
    <p class="btn" onclick="window.location.href='{{url("university/quickLogin?source=".$parameter['source']."&yid=".$parameter['yid'])}}'">快速登录</p>
    <div class="passwordBox">
      <p class="tit"><img src="{{asset('University/images/jbdx.png')}}" alt="">密码登陆</p>
	  <form action="" method="post">
		  <div class="form">
		        <input type="text" name="mobile" placeholder="手机号" value="{{old('mobile')}}">
		        <input type="text" name="password" placeholder="输入密码" value="{{old('password')}}">
		        <input type="hidden" name="source" value="{{$parameter['source']}}">
		        <input type="hidden" name="yid" value="{{$parameter['yid']}}">
		        <div class="sub">
		          <input type="submit">
		        </div>
		        {{ csrf_field() }}
		  </div>
	   </form>
      <p class="ttt">登录即表示同意嘉宾大学<a href="{{url('university/serviceAgreement')}}">服务协议</a>和<a href="{{url('university/serviceAgreement')}}">隐私政策</a></p>
    </div>
  </div>
      @include('layouts.u_hint')
  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop