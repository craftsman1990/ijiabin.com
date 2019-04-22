@extends('layouts.university')
@section('title','嘉宾大学')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/all.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/index.css')}}">
	<style>
		.swiper-container {
			width: 100%;
			height: 100%;
		}
		.swiper-container2 {
			width: 100%;
			height: 100%;
		}
		.swiper-slide {
			text-align: center;
			font-size: 18px;
			background: #fff;

			/* Center slide text vertically */
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			-webkit-justify-content: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			-webkit-align-items: center;
			align-items: center;
		}
		.swiper-pagination-bullet {
			width:8px;
			height:2.5px;
			background:rgba(125,125,125,1);
			border-radius:2px;
		}
		.swiper-pagination-bullet-active {
			background:rgba(229,229,229,1);
		}
		.swiper-container-horizontal>.swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{
			bottom: 7px;
		}
  </style>
	
	<div class="wrap">
		<div class="wrapper">
			<div class="banner">
				<section class="carousel">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							@foreach($adver as $ad)
								<div class="swiper-slide">
									<img src="{{asset($ad['cover'])}}" onclick="window.location.href='{{$ad["href"]}}'">
								</div>
							@endforeach
						</div>
						<!-- Add Pagination -->
						<div class="swiper-pagination" slot="pagination"></div>
					</div>
				</section>
				<!-- <video controls>
					<source src="somevideo.webm" type="video/webm">
					<source src="somevideo.mp4" type="video/mp4">
				</video>  -->
			</div>
			<!-- <div class="classify">
				<div class="classify1" onclick="window.location.href='{{url('university/jbp')}}'">
					<img src="{{asset('University/images/jiabinpai@2x.png')}}" alt="">
				</div>
				<div class="classify1" onclick="window.location.href='{{url('university/gjkc')}}'">
					<img src="{{asset('University/images/guojikecheng@2x.png')}}" alt="">
				</div>
				<div class="classify1" onclick="window.location.href='{{url('university/courseCategory/cgid/1')}}'">
					<img src="{{asset('University/images/gongkaike@2x.png')}}" alt="">
				</div>

			</div> -->
			{{--议题--}}
			<div class="diacuss_box">
				<h4 class="dia_tit discussion-click">
					<em></em>{{substr($discussion->time,0,10)== date('Y-m-d',time()) ? '今日议题' : str_replace('-','.',substr($discussion->time,0,10))}}
					<img src="{{asset('University/images/icon_gengduo@2x.png')}}">
				</h4>
				<h3 class="dia_topic discussion-click">{{$discussion->title}}</h3>
				<p class="dia_label discussion-click">出题人：{{$discussion->author}}</p>
				<!-- <p class="dia_con">{{strip_tags($discussion->content)}}</p> -->
				@if($comment)
				<div class="observer" onclick="window.location.href='{{url("university/discussion/commentDetail/id/".$comment->id)}}'">
					<p class="ob_name"><img src="{{$comment->user_pic}}" alt="">{{$comment->user_name}}</p>
					<p class="ob_con">{{$comment->content}}</p>
				</div>
				@endif
			</div>
			<div class="boutique_box">
				<h4 class="bou_tit">精品课</h4>
				<div class="banner2">
					<section class="carousel2">
						<div class="swiper-container2">
							<div class="swiper-wrapper">
							@foreach($course['boutique'] as $bout)
									<div class="swiper-slide">
										<img src="{{url($bout->crosswise_cover)}}" onclick="window.location.href='{{route('video',['id'=>$bout->id])}}'">
									</div>
								@endforeach
							</div>
							<!-- Add Pagination -->
							<div class="swiper-pagination" slot="pagination"></div>
						</div>
					</section>
					<!-- <video controls>
						<source src="somevideo.webm" type="video/webm">
						<source src="somevideo.mp4" type="video/mp4">
					</video>  -->
				</div>
			</div>
			<div class="business_box">
				<h4 class="bus_tit">商业案例课</h4>
				@foreach($course['business'] as $busi)
				<dl class="bus_list">
						<a href="{{route('video',['id'=>$busi->id])}}">
							<dt class="list-img"><img src="{{asset($busi->lengthways_cover)}}" alt=""></dt>
							<dd>
								<p class="list-tit">{{$busi->name}}</p>
								<p class="list_int">{{$busi->teacher}}<span>{{$busi->professional}}</span></p>
								<p class="list-but"><img src="{{asset('University/images/icon_liulan@2x.png')}}" alt="">{{$busi->looks}}</p>
							</dd>
						</a>
				</dl>
				@endforeach
			</div>
		</div>

  	<footer class="foot">
	    <a href="{{url('university/index?jbcm')}}" class="Imgbox one clo"><img src="{{asset('University/images/icon_faxiandianliang@2x.png')}}" />发现</a>
	    <a href="{{url('university/discussion/index?jbcm')}}" class="Imgbox"><img src="{{asset('University/images/icon_meiriyiyi@2x.png')}}" />每日一议</a>
	    <a href="{{url('university/my/index?jbcm')}}" class="Imgbox two"><img src="{{asset('University/images/icon_wode@2x.png')}}" />我的</a>
  	</footer>
	</div>
	<script>
	    var swiper = new Swiper('.swiper-container', {
				loop: true,
				autoplay: {
					delay: 5000,
					stopOnLastSlide: false,
					disableOnInteraction: false,
				},
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
	    });
	    var swiper2 = new Swiper('.swiper-container2', {
				loop: true,
	      pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	      },
	    });

	    $('.discussion-click').click(function(){
	    	window.location.href='{{url("university/discussion/detail/id/".$discussion->id)}}'
	    });
  	</script>

  
    
@stop
