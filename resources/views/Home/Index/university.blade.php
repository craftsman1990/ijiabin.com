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
                <div class="_guest tab-pane fade {{$towNav->id == $data['secId'] ? 'in active' : ''}}" id="guest_{{$towNav->id}}">
                    <div class="box">
                        <!-- 广告 -->
                        @if($towNav->id ==7)
                        <a class="two-ban" href="{{$data['adver_jbp'][0]['href']}}" target="_blank">
                            <img src="{{asset($data['adver_jbp'][0]['cover'])}}" alt="">
                        </a>
                        @elseif($towNav->id == 10)
                        <a class="two-ban" href="{{$data['adver_gjkc'][0]['href']}}" target="_blank">
                            <img src="{{asset($data['adver_gjkc'][0]['cover'])}}" alt="">
                        </a>
                        @else
                            @if($data['adver'])
                            <a class="two-ban" href="{{$data['adver'][0]['href']}}" target="_blank">
                                <img src="{{asset($data['adver'][0]['cover'])}}" alt="">
                            </a>
                            @endif
                        @endif   
                        <div class="lists">
                            @foreach($towNav->threeNav as $thrNav)
                            <div class="tit">
                                <p class="tit-txt"><img src="{{asset('Home/images/icon_shangxueyuan@2x.png')}}" alt="">{{$thrNav->n_name}}</p>
                                <a href="{{url('threeList/pid/'.$thrNav->parent_id.'/id/'.$thrNav->id)}}"><p class="list-more">更多<img src="{{asset('Home/images/icon_gengduo@2x.png')}}" alt=""></p></a>
                            </div>
                            <div class="cont">
                                @foreach($thrNav->article as $art)
                                <dl class="cont-dls">
                                    @if($art->type==1)
                                    <a href="{{url('article/id/'.$art->id)}}" target="_blank">
                                    @else
                                    <a href="{{url('video/id/'.$art->id)}}" target="_blank">
                                        <img class="bofang1" src="{{asset('Home/images/bfang.png')}}" alt="">
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
                            @endforeach   
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('layouts._footer')
@stop