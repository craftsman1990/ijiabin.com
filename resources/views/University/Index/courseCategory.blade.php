@extends('layouts.university')
@section('title','公开课')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/index.css')}}">
	<style>
	  .wrapper{
	    background:#fff;
	    padding: 0 .13rem;
	  }
	</style>
	<div class="wrapper">
		@foreach($courses as $course)
	    <dl class="bus_list" onclick="window.location.href='{{route('video',['id'=>$course->id])}}'">
	        <a href="#">
	          <dt class="list-img"><img src="{{asset($course->lengthways_cover)}}" alt=""></dt>
	          <dd>
	            <p class="list-tit">{{$course->name}}</p>
	            <p class="list_int">{{$course->teacher}}<span>{{$course->professional}}</span></p>
	            <p class="list-but"><img src="{{asset('University/images/icon_liulan@2x.png')}}" alt="">{{$course->looks}}</p>
	          </dd>
	        </a>
	    </dl>
	    @endforeach
	    <!-- <dl class="bus_list">
	        <a href="#">
	          <dt class="list-img"><img src="{{asset('University/images/tutor.jpeg')}}" alt=""></dt>
	          <dd>
	            <p class="list-tit">健租宝李锦全：不追共享概念健租宝李锦全：不追共享概念</p>
	            <p class="list_int">刘庆峰<span>科大讯飞创始人</span></p>
	            <p class="list-but"><img src="{{asset('University/images/icon_liulan@2x.png')}}" alt="">10000</p>
	          </dd>
	        </a>
	    </dl> -->
	</div>
@stop