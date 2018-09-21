@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/search.css')}}">
  <div class="search-wrapper">
    <div class="search-main">
      <form action="{{url('doSearch')}}">
      <p class="inp"><input type="text" name="keybord" placeholder="请输入关键字" class="inp_search"><i class="icon iconfont icon-sousuo"></i></p>
      </form>
      <div class="sea-con">
        <p class="sea-tit">热搜</p>
        <ul class="sea-label">
          @foreach($data['hotbot'] as $hot)
          <li class="st-hot">{{$hot->name}}</li>
          @endforeach
          <!-- <li class="st-hot">大米</li> -->
          <!-- <li class="st-hot">老米</li> -->
        </ul>
      </div>
    </div>
    <p class="search-close"><i class="icon iconfont icon-guanbi1"></i></p>
  </div>
  <script src={{asset("Home/js/jquery.min.js")}}></script>
  <script type="text/javascript">
    //返回
    $('.search-close').click(function(){
        history.back(-1);
    });

    //获取热搜信息
    $('.st-hot').click(function(){
      $('[name=keybord]').val($(this).html());
    });
    //提交
    $('.icon-sousuo').click(function(){
       $('form').submit();
    });

  </script>
@stop