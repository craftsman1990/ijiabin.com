@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
  <link rel="stylesheet" href="{{asset('Mobile/css/details.css')}}">
  <style>
    
    img{
      width:100% !important;
      height:auto !important;
    }
    iframe{
      width: 100%;
      height: 2.2rem;
    }
  </style>
  <div class="centera">
    
    <div class="main-content">
      <h3 class="title">{{$data['article']->title}}</h3>
      <p class="kind"><span>{{$data['article']->nav_name}}</span><span>{{$data['article']->cg_name}}·{{$data['article']->push}}</span></p>
        {!!$data['article']->content!!}
        <p class="btn"><i class="icon iconfont icon-gengduo1"></i>展开全文</p>
    </div>
   <!--  <div class="fun">
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
          <a href="{{url('mobile/article/id/'.$like->id)}}">
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
@stop