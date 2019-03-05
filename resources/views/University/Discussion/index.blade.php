@extends('layouts.university')
@section('title','每日一议')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/all.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/diacuss.css')}}">

	<div class="wrapper">
		@foreach($discussion as $disc)
			<div class="diacuss_box">
			  <h4 class="dia_tit"><em></em>今日议题</h4>
			  <div class="dia" onclick="window.location.href='{{url("university/discussion/detail/id/".$disc->id)}}'">
			    <h3 class="dia_topic">{{$disc->title}}</h3>
			    <p class="dia_label">出题人：{{$disc->author}}</p>
			  </div>
			  <div class="dia_relevance">
			    <p class="left">{{$disc->count}} 人发表观点</p>
			    <p class="right">
			      <a href="{{url('university/discussion/content/id/'.$disc->id.'/source/1')}}">
			      	<img src="{{asset('University/images/icon_yiyiyi@2x.png')}}" alt="">议一议
			      </a>
			      <a href="{{url('university/discussion/discussionPoster/did/'.$disc->id)}}">
			      	<img src="{{asset('University/images/icon_haibao@2x.png')}}" alt="">海报
			      </a>
			      <a href="{{url('university/discussion/detail/id/'.$disc->id)}}">
			      	<img src="{{asset('University/images/icon_chakan@2x.png')}}" alt="">查看
			      </a>
			    </p>
			  </div>
			</div>
		@endforeach
	</div>
  

  <footer class="foot">
    <a href="{{url('university/index')}}" class="Imgbox one"><img src="{{asset('University/images/icon_faxianhui@2x.png')}}" />发现</a>
    <a href="{{url('university/discussion/index')}}" class="Imgbox clo"><img src="{{asset('University/images/icon_meiriyiyi.png')}}" />议一议</a>
    <a href="{{url('university/my/index')}}" class="Imgbox"><img src="{{asset('University/images/icon_wode@2x.png')}}" />我的</a>
  </footer>

  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop