@extends('layouts.university')
@section('title','关于我们')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/mine_aboutUS.css')}}">

  <div class="wrapper">
      <div class="logo"><img src="{{asset('University/images/jbdx.png')}}" alt=""></div>
      <p class="rel"><span>官网</span><span class="rig">www.ijiabin.com</span></p>
      <p class="rel"><span>邮箱</span><span>pr@wetalktv.cn</span></p>
      <div class="line"></div>
      <p class="lis" onclick="window.location.href='{{url("university/serviceAgreement")}}'">
      	<span>服务协议</span><span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
      </p>
      <p class="lis" onclick="window.location.href='{{url("university/privacyPolicy")}}'">
      	<span>隐私政策</span><span><img src="{{asset('University/images/icon_dakai@2x.png')}}" alt=""></span>
      </p>
      <p class="jbcm">深圳嘉宾传媒有限公司版权所有</p>
  </div>


  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop