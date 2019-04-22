@extends('layouts.university')
@section('title','嘉宾派')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/afterSub.css')}}">
  <div class="wrapper">
    <div class="top">
      <img src="{{asset('University/images/after_sub.png')}}" alt="">
      <p>报名已提交</p>
    </div>
    <div class="cen_l"></div>
    <div class="cen_r"></div>
    <div class="bot">  
      <h5>收款账户</h5>  
      <p class="fromSub"><span class="subl">单位名称：</span><span class="subr">嘉宾教育科技（天津）有限公司</span></p> 
      <p class="fromSub"><span class="subl">开户银行：</span><span class="subr">招商银行股份有限公司天津武清支行</span></p> 
      <p class="fromSub"><span class="subl">银行帐号：</span><span class="subr">122909207310102</span></p>  
      <h5>报名咨询</h5>  
      <p class="fromSub"><span class="subl">课程主任：</span><span class="subr">李老师</span></p>   
      <p class="fromSub"><span class="subl">联系电话：</span><span class="subr clo">13488735206</span></p>  
      <p class="fromSub"><span class="subl">联系邮箱：</span><span class="subr">ls@wetalktv.cn</span></p>                                              
    </div>
  </div>

  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop