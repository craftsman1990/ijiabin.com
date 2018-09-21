@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
  <link rel="stylesheet" href="{{asset('Mobile/css/search.css')}}">
  <div class="centera">
      <p class="close"><i class="icon iconfont icon-guanbi"></i></p>
      <form action="{{url('mobile/doSearch')}}">
      <p class="sea-inp"><input type="text" name="keybord" placeholder="请输入关键字"><i class="icon iconfont icon-iconsousuo"></i></p>
      </form>
      <div class="search-con">
        <p class="sea-tit">热搜</p>
        <ul class="sea-ull">
          @foreach($data['hotbot'] as $hotbot)
          <li class="st-hot">{{$hotbot->name}}</li>
          @endforeach
        </ul>
      </div>
  </div>

  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="{{asset('Mobile/js/swiper.min.js')}}"></script>
  <script src="{{asset('Mobile/js/iscroll.js')}}"></script>
  <script src="{{asset('Mobile/js/index.js')}}"></script>
  <script type="text/javascript">
    //返回
    $('.close').click(function(){
        history.back(-1);
    });
     //获取热搜信息
    $('.st-hot').click(function(){
      $('[name=keybord]').val($(this).html());
    });
    //提交
    $('.icon-iconsousuo').click(function(){
       $('form').submit();
    });
  </script>
@stop