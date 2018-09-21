@extends('layouts.home')
@section('title',$data['title'])
@section('content')
    <link rel="stylesheet" href="{{asset('Home/css/details.css')}}">
    <div class="wrapper">
            @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <div class="main-left">
                    <div class="article">
                      <h3  class="art_title">{{$data['video']->title}}</h3>
                      <p class="art-time"><span>{{$data['video']->nav_name}}</span>·{{$data['video']->cg_name}}·{{$data['video']->push}}</p>
                      <video class="videoFrame" controls poster="{{$data['video']->cover}}">
                          <source src="{{$data['video']->address}}" type="video/mp4">
                          <source src="movie.ogg" type="video/ogg">
                      </video>
                      <p class="art-assist"><b>“</b>{{$data['video']->content}}</p>
                    </div>
                    <p class="share">
                      <!-- 分享至：<i class="icon iconfont icon-weixin-copy"></i><i class="icon iconfont icon-weibo-copy"></i> -->
                    </p>
                </div>
                <div class="main-right">
                    <div class="rig-top">
                        <h3 class="rig_tit"><i class="icons"></i>相关视频</h3>
                        @foreach($data['like'] as $like)
                        <dl class="rig_dls">
                            <a href="{{url('video/id/'.$like->id)}}">
                                <dt class="dls_img">
                                    <img src="{{asset($like->cover)}}" alt="">
                                </dt>
                                <dd class="dls_tit">{{$like->title}}</dd>
                            </a>
                        </dl>
                        @endforeach
                    </div>
                                   
                </div>
            </div>
        </div>
    </div>
@include('layouts._footer')
@stop