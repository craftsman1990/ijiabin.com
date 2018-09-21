@extends('layouts.home')
@section('title',$data['title'])
@section('content')
 <link rel="stylesheet" href="{{asset('Home/css/swiper.min.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/study_details.css')}}">
<div class="wrapper">
    @include('layouts._header')
    <div class="main1 clearfix">
        
        <div class="main_tab">
            <div class="top-detaills">
                <div class="top-left">
                    <img src="{{asset($data['tutorStudent']->head_pic)}}" alt="">
                </div>
                <div class="top-right">
                    <img src="{{asset('Home/images/zuoshang.png')}}" class="frame" alt="">
                    <p class="top-tit"><strong>{{$data['tutorStudent']->name}}</strong>{{$data['tutorStudent']->position}}</p>
                    <p class="top-con">{{$data['tutorStudent']->intro}}</p>
                    <!-- <div class="ana">
                        <p class="ana-tit">经典语录:</p>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($data['classic_quote'] as $cq)
                                <div class="swiper-slide">{{$cq}}</div>
                                @endforeach
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div> -->
                </div>
            </div> 
            <div class="botton">
                <div class="coll-left">
                    <p class="tittle">相关内容</p>
                    @if($data['article'])
                        @foreach($data['article'] as $art)
                        <dl class="tab_list">
                            <a href="{{url('article/id/'.$art->id)}}">
                                <dt>
                                    <img src="{{asset($art->cover)}}" alt="">
                                </dt>
                                <dd>
                                    <h4 class="tab_tit">{{$art->title}}</h4>
                                    <p class="tab_con">{{$art->intro}}</p>
                                    
                                    <p class="tab_time">{{substr($art->publish_time,0,10)}}</p>
                                </dd>
                            </a>
                        </dl>
                        @endforeach
                    @else
                    <p class="con_none">暂无相关信息</p>    
                    @endif
                </div>
                <div class="coll-right">
                    <h3 class="rig_tit"><i class="icons"></i>相关推荐</h3>
                    @if($data['video'])
                    @foreach($data['video'] as $vid)
                    <dl class="rig_dls">
                        <a href="{{url('video/id/'.$vid->id)}}">
                            <dt class="dls_img">
                                <img src="{{asset($vid->cover)}}" alt="">
                            </dt>
                            <dd class="dls_tit">{{$vid->title}}</dd>
                        </a>
                    </dl>
                    @endforeach
                    @else
                    <p class="con_none">暂无相关信息</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts._footer')
    <script src="{{asset('Home/js/swiper.min.js')}}"></script>

  <script type="text/javascript">  
    window.onload = function() {
        var mySwiper = new Swiper ('.swiper-container', {
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            observer:true,//修改swiper自己或子元素时，自动初始化swiper
            observeParents:true,//修改swiper的父元素时，自动初始化swiper
        });
    } 


        if($(".swiper-slide").length==1){
            $(".swiper-button-prev").hide();
            $(".swiper-button-next").hide();
            $(".swiper-container").addClass("swiper-no-swiping")
        } 
  </script>

@stop