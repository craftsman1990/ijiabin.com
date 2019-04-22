@extends('layouts.university')
@section('title','每日一议')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/all.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/diacuss.css')}}">

	<div class="wrap">
		<div class="wrapper">
			@foreach($discussion as $disc)
				<div class="diacuss_box">
					<h4 class="dia_tit"><em></em>
						@if(substr($disc->time,0,10)== date('Y-m-d',time()))
							今日议题
						@elseif(substr($disc->time,0,10)== date('Y-m-d',time()-86400))
							昨日议题
						@else
							{{str_replace('-','.',substr($disc->time,0,10))}}
						@endif
					</h4>
					<div class="dia" onclick="window.location.href='{{url("university/discussion/detail/id/".$disc->id)}}'">
						<h3 class="dia_topic">{{$disc->title}}</h3>
						<p class="dia_label">出题人：{{$disc->author}}</p>
					</div>
					<div class="dia_relevance">
						<p class="left">{{$disc->count}} 人发表观点</p>
						<p class="right">
							<a href="{{url('university/discussion/content/id/'.$disc->id.'/source/1')}}">
								<img src="{{asset('University/images/yiyiyi@2.png')}}" alt="">议一议
							</a>
							<a href="{{url('university/discussion/discussionPoster/did/'.$disc->id)}}">
								<img src="{{asset('University/images/icon_haibao@2.png')}}" alt="">海报
							</a>
							<a href="{{url('university/discussion/detail/id/'.$disc->id)}}">
								<img src="{{asset('University/images/icon_chakan@2.png')}}" alt="">查看
							</a>
						</p>
					</div>
				</div>
			@endforeach
		</div>
		<footer class="foot">
			<a href="{{url('university/index?jbcm')}}" class="Imgbox one"><img src="{{asset('University/images/icon_faxianhui@2x.png')}}" />发现</a>
			<a href="{{url('university/discussion/index?jbcm')}}" class="Imgbox clo"><img src="{{asset('University/images/icon_meiriyiyi.png')}}" />每日一议</a>
			<a href="{{url('university/my/index?jbcm')}}" class="Imgbox two"><img src="{{asset('University/images/icon_wode@2x.png')}}" />我的</a>
		</footer>
	</div>
  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop