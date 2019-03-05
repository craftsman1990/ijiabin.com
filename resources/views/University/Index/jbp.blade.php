@extends('layouts.university')
@section('title','嘉宾派')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/apply.css')}}">

  <div class="img">
    <img src="{{asset('University/images/international.jpeg')}}" alt="">
  </div>
  <button class="apply" onclick="window.location.href='{{url("university/jbp_apply")}}'">立即报名</button>

  <script src="{{asset('University/js/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop