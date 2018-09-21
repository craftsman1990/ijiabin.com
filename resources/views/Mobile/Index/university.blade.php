@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Mobile/css/two-list.css')}}">
  <div data-role="page" id="pageone">
     @include('layouts.m_header')
    <div class="centera">
      <ul id="oranger"> 
        @foreach($data['towNav'] as $towNav)
        <li><a class="{{$towNav->id == $data['secId'] ? 'hover' : ''}}" href="javascript:;">{{$towNav->n_name}}</a> </li>
        @endforeach
      </ul>
      <div id="tablea" class="tablea">
        @foreach($data['towNav'] as $towNav)
        <div class="towNav {{$towNav->id == $data['secId'] ? '' : 'box'}}">
          <div class="banner">
            <a href="{{$towNav->adver['href']}}">
              <img src="{{asset($towNav->adver['cover'])}}" alt="" style="width: 100%">
            </a>
          </div>
          <div class="con">
            @if($towNav->content)
              @foreach($towNav->content as $article)
              <dl class="list">
                @if($article->type==1)
                  <a href="{{url('mobile/artile/id/'.$article->id)}}">
                @else
                  <a href="{{url('mobile/video/id/'.$article->id)}}">
                @endif
                  <dt class="list-img"><img src="{{asset($article->cover)}}" alt=""></dt>
                  <dd>
                    <p class="list-tit">{{$article->title}}</p>
                    <p class="list-but"><span class="sp-time">{{$article->publish_time}}</span><span class="sp-kind">{{$article->nav_name}}</span></p>
                  </dd>
                </a>
              </dl>
              @endforeach
              <p class="load" nav="{{$towNav->id}}" page="{{config('hint.m_show_num')}}">加载更多</p>
            @else
              <p class="bottom">暂无内容</p>
            @endif
          </div>
         
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <input type="hidden" name="url" value="{{url('mobile/getBrandMessge')}}">
  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="{{asset('Mobile/js/swiper.min.js')}}"></script>
  <script src="{{asset('Mobile/js/iscroll.js')}}"></script>
  <script>
    // $(".tablea").find(".box:first").show();    //为每个BOX的第一个元素显示        
    $("#oranger li a").on("mouseover",function(){ //给li标签添加事件  
      var index=$(this).parent().index();  //获取当前li标签的个数  
      // $(this).parent().parent().next().find(".box").hide().eq(index).show(); //返回上一层，在下面查找css名为box隐藏，然后选中的显示  
      $('#tablea').find('.towNav').addClass('box').eq(index).removeClass('box')
      $(this).addClass("hover").parent().siblings().children().removeClass("hover"); //a标签样式
    })
    $("#pagehide").click(function(){
      $("#myPanel").toggle()
    })

    url = $('[name=url]').val();
    $('.load').click(function(){
      var thisObj = $(this);
      var nav = thisObj.attr('nav'),
          page = thisObj.attr('page');
      $.ajax({
        url : url,
        type : 'GET',
        data : {nav:nav,page:page},
        dataType : 'json',
        success : function(d){
          thisObj.attr('page',parseInt(page)+{{config('hint.m_show_num')}});
          var html = '';
          if (d != 0) {
            if (nav != 9) {
              $.each(d,function(index,item){
                html += '<dl class="list"><a href="'+item.url+'">';
                html += '<dt class="list-img"><img src="'+item.cover+'" alt=""></dt>';
                html += '<dd><p class="list-tit">'+item.title+'</p>';
                html += '<p class="list-but"><span class="sp-time">'+item.publish_time+'</span>';
                html += '<span class="sp-kind">'+item.nav_name+'</span></p></dd></a></dl>';
              });
            }else{
              $.each(d,function(index,item){
                html += '<div class="video"><video width="100%"  controls>';
                html += '<source src="'+item.address+'" type="video/mp4">';
                html += '<source src="'+item.address+'" type="video/ogg">';
                html += '<p class="video-tit">'+item.title+'（'+item.duration+'）</p></div>';
              });
            }
          }else{
            html += '<p class="bottom">已经到底部了</p>';
            thisObj.hide();
          }
          thisObj.parent().append(html);
        },
        error : function(e){
          console.log(e);
        }
      });
    })
    
  </script>
@stop