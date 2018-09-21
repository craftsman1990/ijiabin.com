@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
  <link rel="stylesheet" href="{{asset('Mobile/css/details.css')}}">
  <div class="centera">
    <div class="main-content mc">
        <dl class="tutor-list">
            <dt class="tutor-img"><img src="{{asset($data['prople']->head_pic)}}" alt=""></dt>
            <dd>
                <p class="tutor-name">{{$data['prople']->name}}</p>
                <p class="tutor-post">{{$data['prople']->position}}</p>
            </dd>
        </dl>
        <p class="tutor-tit">{{$data['prople']->intro}}</p>
<!--         <div class="ana">
          <p class="ana-tit">经典语录</p>
          <div class="swiper-container">
              <div class="swiper-wrapper">
                @foreach($data['classic_quote'] as $v)
                <div class="swiper-slide">
                  <p class="ant-con">{{$v}}</p>
                </div>
                @endforeach
              </div>
              <div class="swiper-pagination"></div>
            </div>
        </div> -->  
    </div>
    <div class="con">
        <p class="correlation">相关内容</p>
        @if($data['about'])
          @foreach($data['about'] as $about)
          <dl class="list">
            @if($about->type ==1)
              <a href="{{url('mobile/article/id/'.$about->id)}}">
            @else
              <a href="{{url('mobile/video/id/'.$about->id)}}">
            @endif    
                <dt class="list-img"><img src="{{asset($about->cover)}}" alt=""></dt>
                <dd> 
                  <p class="list-tit">{{$about->title}}</p>
                  <p class="list-but"><span class="sp-time">{{$about->publish_time}}</span><span class="sp-kind">{{$about->nav_name}}</span></p>
                </dd>
              </a>
          </dl>
          @endforeach
        @else
          <p class="bottom">暂无内容</p>
        @endif
      </div>
  </div>

  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="{{asset('Mobile/js/swiper.min.js')}}"></script>
  <script src="{{asset('Mobile/js/iscroll.js')}}"></script>
  <script src="{{asset('Mobile/js/index.js')}}"></script>
  <script>
      $(document).ready(function(){
        var mySwiper = new Swiper(".swiper-container",{
                      autoplay:2000,
                      loop:true,//循环
                      pagination : '.swiper-pagination',
                      paginationClickable :true,
                      observer:true,//修改swiper自己或子元素时，自动初始化swiper
                      observeParents:true,//修改swiper的父元素时，自动初始化swiper
                  })
      });
      
    </script>
@stop