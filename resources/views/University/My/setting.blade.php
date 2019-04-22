@extends('layouts.university')
@section('title','设置')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/mine.css')}}">
	<style>
	body{
	  background: rgba(244,244,244,1)!important;
	}
	.wrapper{
		background:#fff;
	}
	</style>
	<div class="wrapper">
	  <ul class="ull">
	    <li class="lis" onclick="window.location.href='{{url("university/my/accountManagement")}}'">
	    	<span><img src="{{asset('University/images/icon_zhanghaoguanli@2x2.png')}}" alt="">账号管理</span>
	    	<span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
	    </li>
	    <li class="lis" onclick="window.location.href='{{url("university/my/aboutUs")}}'">
	    	<span><img src="{{asset('University/images/icon_guanyuwomen@2x2.png')}}" alt="">关于我们</span>
	    	<span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
	    </li>
	  </ul>

		<button id="btn">退出登录</button>
		<div class="cover">
			<div class="box2">
					<p class="boxtit">确定退出登录？</p>
					<div class="btns">
						<p class="nor">取消</p>
						<p class="yesl">确定</p>
					</div>
				</div>
			</div>
	</div>
  <script>
    $(document).ready(function () {
			$('#btn').click(function(){
				$('.cover').show();
			})
      $('.nor').click(function(){
				$('.cover').hide();
			})
			$('.yesl').click(function(){
				window.location.href='{{url('university/loginOut')}}';
			})
    })
  </script>
@stop

<!-- <a href="{{url('university/my/accountManagement')}}">账号管理</a>
<a href="{{url('university/my/aboutUs')}}">关于我们</a> -->