@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
  <link rel="stylesheet" href="{{asset('Mobile/css/details.css')}}">
  <div class="centera">
    
    <div class="main-content main-content1">
      <h3 class="title">{{$data['video']->title}}</h3>
      <p class="kind"><span>{{$data['video']->nav_name}}</span><span>{{$data['video']->cg_name}}·{{$data['video']->push}}</span></p>
      <video controls poster="{{$data['video']->cover}}">
          <source src="{{$data['video']->address}}" type="video/webm">
          <source src="{{$data['video']->address}}" type="video/mp4">
        </video>
        <p class="text">
            <span class="text-icon">“</span>{!!$data['video']->content!!}
        </p>
    </div>
    <!-- <div class="fun">
        <div class="like">
            <p class="fun-icon"><i class="icon iconfont icon-praise"></i></p>
            <p class="fun-tit">赞</p>
        </div>
        <div class="share">
            <p class="fun-icon"><i class="icon iconfont icon-weibo"></i></p>
            <p class="fun-tit">分享</p>
        </div>
      </div> -->
    <div class="con">
        <p class="correlation">相关内容</p>
        @foreach($data['like'] as $like)
        <dl class="list">
          <a href="{{url('mobile/video/id/'.$like->id)}}">
            <dt class="list-img"><img src="{{asset($like->cover)}}" alt=""></dt>
            <dd>
              <p class="list-tit">{{$like->title}}</p>
              <p class="list-but"><span class="sp-time">{{$like->publish_time}}</span><span class="sp-kind">{{$like->nav_name}}</span></p>
            </dd>
          </a>
        </dl>
        @endforeach
    </div>
  </div>

  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="{{asset('Mobile/js/swiper.min.js')}}"></script>
  <script src="{{asset('Mobile/js/iscroll.js')}}"></script>
  <script src="{{asset('Mobile/js/index.js')}}"></script>
  <script>
      $(document).ready(function(){
        $(".fun-icon i.icon-praise").click(function () { 
          $(this).css({"color":"#E7605B"});
        })
        $('.btn').click(function(){
          $('.main-content').css({"max-height":"none"})
          $('.btn').hide()
        })
      });
    </script>
    @include('layouts._wxshare')
@stop