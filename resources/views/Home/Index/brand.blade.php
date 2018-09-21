@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/program.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/program_1.css')}}">
<div class="wrapper">
         @include('layouts._header')
    <div class="main1 clearfix">
        <div class="main_tab">
            <div class="nav_mytab">
                <ul id="myTab" class="nav_bot nav-tabs">
                    @foreach($data['towNav'] as $towNav)
                    <li class="{{$towNav->id == $data['secId'] ? 'active' : ''}}">
                        <a href="#guest_{{$towNav->id}}" data-toggle="tab">
                            {{$towNav->n_name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div id="myTabContent" class="tab-content">
                @foreach($data['towNav'] as $towNav)
                    @if($towNav->id == 9)
                    <!-- 企业纪录片 -->
                    <div class="tab-pane fade {{$towNav->id == $data['secId'] ? 'in active' : ''}}" id="guest_{{$towNav->id}}">
                        <div class="main">
                            <div class="main-left">
                                <div id="videoListID" class="videoList">
                                    <table class="tableView">
                                        @foreach($towNav->video as $video)
                                        <ol>
                                            <h5 class="titletxt">
                                                <img src={{asset("Home/images/icon_shipin@2x.png")}} alt="">
                                                {{$video->title}}（{{$video->duration}}<!-- 分钟 -->）
                                                <a class="timeLabel">{{substr($video->publish_time,0,10)}}</a>
                                            </h5>
                                            <video class="videoFrame" controls>
                                                <source src="{{$video->address}}" type="video/mp4">
                                                <source src="movie.ogg" type="video/ogg">
                                            </video>
                                        </ol>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="main-right">
                                    <div class="rig-top">
                                        <h3 class="rig_tit"><i class="icons"></i>相关推荐</h3>
                                        @foreach($towNav->like as $like)
                                        <dl class="rig_dls">
                                            <a href="{{url('video/id/'.$like->id)}}">
                                                <dt class="dls_img">
                                                    <img src={{asset($like->cover)}} alt="">
                                                </dt>
                                                <dd class="dls_titL">{{$like->title}}</dd>
                                            </a>
                                        </dl>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- 其他普通文章 -->
                    <div class="_guest tab-pane fade {{$towNav->id == $data['secId'] ? 'in active' : ''}}" id="guest_{{$towNav->id}}">
                        <div class="box">
                            <!-- 广告位置 -->
                            <a class="two-ban" href="{{$data['adver'][0]['href']}}" target="_blank">
                                <img src="{{asset($data['adver'][0]['cover'])}}">
                            </a>   
                            @foreach($towNav->threeNav as $thrNav)
                            <div class="lists">
                                <div class="tit">
                                    <p class="tit-txt"><img src="{{asset('Home/images/icon_jiemu@2x.png')}}" alt="">{{$thrNav->n_name}}</p>
                                    <a href="{{url('threeList/pid/'.$thrNav->parent_id.'/id/'.$thrNav->id)}}"><p class="list-more">更多<img src="{{asset('Home/images/icon_gengduo@2x.png')}}" alt=""></p></a>
                                </div>
                                <div class="cont">
                                    @foreach($thrNav->article as $art)
                                    <dl class="cont-dls">
                                        @if($art->type==1)
                                        <a href="{{url('article/id/'.$art->id)}}" target="_blank">
                                        @else
                                        <a href="{{url('video/id/'.$art->id)}}" target="_blank">
                                        @endif
                                            <dt><img src="{{asset($art->cover)}}" alt=""></dt>
                                            <dd>
                                                <p class="dls-tit">{{$art->title}}</p>
                                                <p class="dls-text">{{$art->cg_name}}<span>{{substr($art->publish_time,0,10)}}</span></p>
                                            </dd>
                                        </a>
                                    </dl>
                                    @endforeach
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                     </div>
                    @endif

               

                @endforeach
                
            </div>
        </div>
    </div>
</div>

@include('layouts._footer')

@stop