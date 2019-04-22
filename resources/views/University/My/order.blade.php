@extends('layouts.university')
@section('title','我的已购')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
@if($orders->toArray())
  <link rel="stylesheet" href="{{asset('University/css/mine_buy.css')}}">
  <div class="wrapper">
    @foreach($orders as $order)
    <dl class="bus_list">
      <a href="{{route('video',['id'=>$order->course_id])}}">
        <dt class="list-img"><img src="{{asset($order->course->lengthways_cover)}}" alt=""></dt>
        <dd>
          <p class="list-tit">{{$order->title}}</p>
          <p class="list-but">
              <span><img src="{{asset('University/images/icon_liulan@2x.png')}}" alt="">{{$order->course->looks}}</span>
            @if($order->learningState ==2)
            <span class="rig yellow">已学完</span>
            @elseif($order->learningState ==1)
            <span class="rig blue">学习至第{{$order->learningCount}}节</span>
            @else
            <span class="rig gray">未学习</span>
            @endif
          </p>
        </dd>
      </a>
    </dl>
    @endforeach
    <div class="cover">
      <img src="{{asset('University/images/icon_huishouye@2x.png')}}" alt="" class="sy" onclick="window.location.href='{{url("university/index")}}'">
      <img src="{{asset('University/images/erweima.png')}}" alt="" class="code">
    </div>
    <div class="cover1">
      <div class="box">
        <img src="{{asset('University/images/code.png')}}" alt="" class="co">
        <p class="co_t">关注“嘉宾大学”公众号，</p>
        <p class="co_t co1">与众多大咖一起互动学习吧！</p>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('.code').click(function(){
        $('.cover1').show();
      })
      $('.cover1').click(function(){
        $('.cover1').hide();
      })
    })
  </script>
@else
  <link rel="stylesheet" href="{{asset('University/css/mine.css')}}">
  <div class="wrapper">
    <div class="imgbox1"><img src="{{asset('University/images/quesheng_goumai@2x.png')}}" alt=""></div>
    <p class="tNone tNone1">您还没有购买课程哦~</p>
  </div>
@endif
@stop