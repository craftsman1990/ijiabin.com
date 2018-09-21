@extends('layouts.home')
@section('title',$data['title'])
@section('content')
    <link rel="stylesheet" href="{{asset('Home/css/details.css')}}">
    <style type="text/css">
      iframe{
        text-align: center;
      }
    </style>
    <div class="wrapper">
            @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <!-- 左侧内容 -->
                <div class="main-left">
                    <h3 class="art_title">{{$data['article']->title}}</h3>
                    <p class="art-time"><span>{{$data['article']->nav_name}}</span>·{{$data['article']->cg_name}}·{{$data['article']->push}}</p>
                    <div class="article">
                      {!! $data['article']->content !!}
                    </div>
                    <!-- <p class="share">
                      分享至：<i class="icon iconfont icon-weixin-copy"></i><i class="icon iconfont icon-weibo-copy"></i>
                    </p> -->
                    <div class="else">
                      <p>上一篇：{!! $data['prev'] ? '<a href="'.url('article/id/'.$data['prev'][0]->id).'" >'.$data['prev'][0]->title.'</a>' : '无' !!}</p>
                      <p>下一篇：{!! $data['next'] ? '<a href="'.url('article/id/'.$data['next'][0]->id).'" >'.$data['next'][0]->title.'</a>' : '无' !!}</p> 
                        
                     
                    </div>
                    <div class="bot">
                        <h3 class="rig_tit"><i class="icons"></i>你可能感兴趣的</h3>
                        <div class="bot-box">
                            @foreach($data['like'] as $like)
                            <dl class="bot_dls">
                                <a href="{{url('article/id/'.$like->id)}}">
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
                <!-- 右侧 -->
                <div class="main-right">
                    <div class="rig-top">
                        <h3 class="rig_tit"><i class="icons"></i>相关推荐</h3>
                        @foreach($data['choiceness'] as $cho)
                        <dl class="rig_dls">
                            @if($cho->type ==1)
                            <!-- 文章 -->
                            <a href="{{url('article/id/'.$cho->cho_id)}}">
                            @else
                            <!-- 视频待定 -->
                            <a href="">
                            @endif
                                <dt class="dls_img">
                                    <img src="{{asset($cho->cover)}}" alt="">
                                </dt>
                                <dd class="dls_tit">{{$cho->title}}</dd>
                            </a>
                        </dl>
                        @endforeach
                        <!-- <dl class="rig_dls">
                            <a href="">
                                <dt class="dls_img">
                                    <img src="{{asset('Home/images/list3.png')}}" alt="">
                                </dt>
                                <dd class="dls_tit">放到沙发上豆腐红烧豆腐红烧豆腐还是大放送的护发素地方官方代购的风格</dd>
                            </a>
                        </dl> -->
                       <!--  <dl class="rig_dls">
                          <a href="">
                              <dt class="dls_img">
                                  <img src="{{asset('Home/images/list3.png')}}" alt="">
                              </dt>
                              <dd class="dls_tit">放到沙发上豆腐红烧豆腐红烧豆腐还是大放送的护发素地方官方代购的风格</dd>
                          </a>
                        </dl> -->
                    </div> 
                    <!-- <div class="share share2">
                      分享至：<i class="icon iconfont icon-weixin wx"></i><i class="icon iconfont icon-weibo wb"></i>
                      <p class="big-wx"><img src="{{asset('Home/images/wx.jpeg')}}" alt=""></p>
                      <p class="big-wb"><img src="{{asset('Home/images/wx.jpeg')}}" alt=""></p>
                    </div>    -->
                                   
                </div>
            </div>
    </div>
    </div>
@include('layouts._footer')
<script>
    $('iframe').parent().css("text-align","center")
</script>
@stop