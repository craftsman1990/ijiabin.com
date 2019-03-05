@extends('layouts.university')
@section('title','设置')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/mine.css')}}">

	<div class="wrapper">
	  <ul>
	    <li class="lis" onclick="window.location.href='{{url("university/my/accountManagement")}}'">
	    	<span><img src="{{asset('University/images/icon_zhanghaoguanli@2x2.png')}}" alt="">账号管理</span>
	    	<span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
	    </li>
	    <li class="lis" onclick="window.location.href='{{url("university/my/aboutUs")}}'">
	    	<span><img src="{{asset('University/images/icon_guanyuwomen@2x2.png')}}" alt="">关于我们</span>
	    	<span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
	    </li>
	  </ul>
	</div>
  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop

<!-- <a href="{{url('university/my/accountManagement')}}">账号管理</a>
<a href="{{url('university/my/aboutUs')}}">关于我们</a> -->