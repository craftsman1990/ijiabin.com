@extends('layouts.university')
@section('title','我发表的观点')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/mine.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/mine_collect.css')}}">

<style>
  body{
    background:rgba(245,245,245,1);
  }
</style>
@if($comments->toArray())
  <div class="wrapper">
    @foreach($comments as $comment)
    <div class="detailsTop">
      <div class="detaileName">
        <dl>
          <dd><img src="{{asset($user->head_pic)}}" alt=""></dd>
          <dt>
            <p class="dt_name">{{$user->nickname}}</p>
          </dt>
        </dl>
      </div>
      <div class="detailCon" onclick="window.location.href='{{url("university/discussion/commentDetail/id/".$comment->id)}}'">{{$comment->content}}</div>
      <div class="detailTit" onclick="window.location.href='{{url("university/discussion/detail/id/".$comment->discussion_id)}}'">
        <p class="tit"># {{$comment->dis_title}}</p>
        <p class="t_con">
          <span class="time">{{$comment->dis_time}}</span>
          <span class="con">{{$comment->dis_count}}人发表观点</span>
        </p>
      </div>
    </div>
    @endforeach
  </div>
@else
  <div class="wrapper">
    <div class="imgbox1"><img src="{{asset('University/images/quesheng_guandian@2x.png')}}" alt=""></div>
    <p class="tNone tNone1">您还没有发表任何观点哦~</p>
  </div>
@endif  
  <script>
    $(document).ready(function () {
      
        
    })
  </script>
@stop