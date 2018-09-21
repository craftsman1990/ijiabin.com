<!-- <!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <!-- <title>嘉宾大学</title> -->
    <!-- <link rel="icon" type="image/x-icon" href="../images/wetalkTV.ico" /> -->
    <!-- Bootstrap -->
    <!-- <link href="http://cdn.bootcss.com/normalize/4.2.0/normalize.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../fonts/iconfont.css">
    <link rel="stylesheet" href="fh.css">
</head> -->
@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/fh.css')}}">
<body>
<div class="wrapper">
        @include('layouts._header')
    <div class="main1 clearfix">
        <div class="fhcen">
            <div class="box">
                <div class="two-ban">
                    @if($data['adver'])
                    <a class="two-ban" href="{{$data['adver'][0]['href']}}" target="_blank">
                        <img src="{{asset($data['adver'][0]['cover'])}}" alt="">
                    </a>
                    @endif
                </div>   
                <div class="lists">
                    @foreach($data['towNav'] as $towNav)
                    <div class="tit">
                        <p class="tit-txt"><img src="{{asset('Home/images/icon_fenghui@2x.png')}}" alt="">{{$towNav->n_name}}</p>
                        <a href="{{url('threeList/pid/'.$towNav->parent_id.'/id/'.$towNav->id)}}"><p class="list-more">更多<img src="{{asset('Home/images/icon_gengduo@2x.png')}}" alt=""></p></a>
                    </div>
                    <div class="cont">
                        @foreach($towNav->article as $art)
                        <dl class="cont-dls">
                            @if($art->type==1)
                            <a href="{{url('article/id/'.$art->id)}}">
                            @else
                            <a href="{{url('video/id/'.$art->id)}}">
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
    </div>
</div>

@include('layouts._footer')
@stop