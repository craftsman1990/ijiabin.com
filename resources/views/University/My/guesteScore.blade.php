@extends('layouts.university')
@section('title','我的嘉分')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/mine_score2.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/mine.css')}}">
@if($records->toArray())
  <div class="wrapper">
    <div class="score_box">
      <h3 class="score">{{$score->score}}</h3>
      <p class="text">嘉分</p>
      <p class="know" onclick="window.location.href='{{url("university/my/aboutGuesteScore")}}'">了解嘉分</p>
    </div>

    <div class="line"></div>
    <div id="centera">
      <div class="orangerb">
        <ul id="oranger"> 
          <li>行为</li> 
          <li>分值</li> 
          <li>时间</li>
        </ul>
      </div>
      <div id="tablea" class="tablea">
        <div class="box">
          <ul class="list">
          	@foreach($records as $record)
            <li class="lis">
            	<span>{{$record->behavior}}</span>
            	<span>{{$record->type == 1 ? '-' : '+'}} {{$record->score}}</span>
            	<span>{{substr($record->created_at,0,10)}}</span>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@else
	<div class="wrapper">
	    <div class="imgbox"><img src="{{asset('University/images/jiafen@2x.png')}}" alt=""></div>
	    <p class="tNone">您还没有获得任何嘉分哦~</p>
	    <p class="linkscore" onclick="window.location.href='{{url("university/my/aboutGuesteScore")}}'">了解嘉分
	    	<img src="{{asset('University/images/icon_gengduo@22.png')}}" alt="">
	    </p>
	</div>
@endif
 	
@stop