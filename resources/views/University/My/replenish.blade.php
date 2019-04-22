@extends('layouts.university')
@section('title','获取信息')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/login.css')}}">
  <style>
    .ttt{
      margin-top:2.35rem;
    }
  </style>
  <div class="wrapper wrapper1">
    <div class="logo">
      <img src="{{asset('University/images/jbdx.png')}}" alt="">
    </div>
    <p class="need_tit">用户须知</p>
    <p class="need_com">嘉宾大学是一个致力于帮助职场人士、创业者等突破职业瓶颈并快速发展的真实的学习、互动、交流平台，为保证平台的良性、健康发展，在使用本产品时需要获取你的真实信息。</p>
    @if( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false )
    <button class="self-motion" onclick="window.location.href='{{url("api/weixin/wxLogin?uri=https://www.ijiabin.com/university/my/doReplenish")}}'">自动获取</button>
    @endif
    <button class="manpower" onclick="window.location.href='{{url("university/my/fillInfo")}}'">立即填写</button>
  </div>

  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop