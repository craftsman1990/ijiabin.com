@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
  <link rel="stylesheet" href="{{asset('Mobile/css/search.css')}}">
  <div class="centera cen">
    <form action="">
    <p class="sea-inp"><input type="text" value="{{$data['keybord']}}" name="keybord"><i class="icon iconfont icon-iconsousuo"></i></p>
    </form>
    @if($data['res'])
    <div class="">
      @foreach($data['res'] as $res)
      <dl class="list">
        @if($res->type == 1)
        <a href="{{url('mobile/article/id/'.$res->id)}}">
        @else
        <a href="{{url('mobile/video/id/'.$res->id)}}">  
        @endif
          <dt class="list-img"><img src="{{url($res->cover)}}" alt=""></dt>
          <dd>
            <p class="list-tit">{{$res->title}}</p>
            <p class="list-but"><span class="sp-time">{{$res->publish_time}}</span><span class="sp-kind">{{$res->n_name}}</span></p>
          </dd>
        </a>
      </dl>
      @endforeach
      <div class="load" page="{{config('hint.m_show_num')}}">加载更多</div>
    </div>
    @else
    <div class="con-none">
      <i class="icon iconfont icon-weibiaoti3"></i>
      <p>没有搜索到相关内容哦！</p>
    </div>
    @endif
  </div>
  <input type="hidden" name="url" value="{{url('api/getSearch')}}">
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
      //提交
      $('.icon-iconsousuo').click(function(){
         $('form').submit();
      });
      //分页
      url = $('[name=url]').val();
      $('.load').click(function(){
        var thisObj = $(this);
        var keybord = $('[name=keybord]').val(),
            source = 2,
            page = thisObj.attr('page');
        $.ajax({
          url : url,
          type : 'GET',
          data : {keybord:keybord,source:source,page:page},
          dataType : 'json',
          success : function(d){
            thisObj.attr('page',parseInt(page)+{{config('hint.m_show_num')}});
            var html = '';
            if (d !=0) {
              $.each(d,function(index,item){
                  html += '<dl class="list"><a href="'+item.url+'">';
                  html += '<dt class="list-img"><img src="'+item.cover+'" alt=""></dt>';
                  html += '<dd><p class="list-tit">'+item.title+'</p>';
                  html += '<p class="list-but"><span class="sp-time">'+item.publish_time+'</span>';
                  html += '<span class="sp-kind">'+item.n_name+'</span></p></dd></a></dl>';
                });
            }else{
              html += '<p style="width:100%;text-align:center;color:#999999;margin-top:.1rem">已经到底部了</p>';
              thisObj.hide();
            }
            thisObj.prev().after(html);
          },
          error : function(e){
            console.log(e);
          }
        })
      })
  </script>
@stop