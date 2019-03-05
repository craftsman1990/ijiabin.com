@extends('layouts.university')
@section('title','设置')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/mine.css')}}">

	<div class="wrapper">
      <ul>
        <li class="lis" onclick="window.location.href='{{url("university/my/editMobile")}}'">
        	<span><img src="{{asset('University/images/icon_shoujihao@2x2.png')}}" alt="">手机号：{{$user->mobile}}</span>
        	<span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
        </li>
        <li class="lis" onclick="window.location.href='{{url("university/my/editPassWord")}}'">
        	<span><img src="{{asset('University/images/icon_shezhimima@2x2.png')}}" alt="">设置密码</span>
        	<span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span></li>
      </ul>
  	</div>
@stop




<!-- <a href="{{url('university/my/editMobile')}}">手机号：{{$user->mobile}}</a> -->

<!-- <a href="{{url('university/my/editPassWord')}}">{{$user->password ? '修改' : '设置'}}密码</a> -->
