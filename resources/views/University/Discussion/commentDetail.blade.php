@extends('layouts.university')
@section('title','评论')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/viewTheDetails.css')}}">

  <div class="wrapper">
    <div class="detailsTop">
      <div class="detaileName">
        <dl>
          <dd><img src="{{$comment->user_pic}}" alt=""></dd>
          <dt>
            <p class="dt_name">{{$comment->user_name}}</p>
            <p class="dt_time">{{$comment->time}}</p>
          </dt>
        </dl>
        @if(Auth::guard('university')->check())
        <div class="collect" status="{{$comment->coll_status}}">
          @if($comment->coll_status)
          <img src="{{asset('University/images/icon_yishoucang@2x.png')}}" alt="">收藏
          @else
          <img src="{{asset('University/images/icon_shoucang@2x.png')}}" alt="">收藏
          @endif
        </div>
        @else
        <div class="collect" onclick="alert('尚未登陆！');window.location.href='{{url("university/login?source=3&yid=".$comment->id)}}'">
          <img src="{{asset('University/images/icon_shoucang@2x.png')}}" alt="">收藏
        </div>
        @endif
      </div>
      <div class="detailCon">
          {{$comment->content}}
      </div>
      <div class="detailTit" onclick="window.location.href='{{url("university/discussion/detail/id/".$discussion->id)}}'">
        <p class="tit"># {{$discussion->title}}</p>
        <p class="t_con">
          <span class="time">{{$discussion->time}}</span>
          <span class="con">{{$discussion->count}} 人发表观点</span>
        </p>
      </div>
    </div>
    <div class="detailsBot">
      @foreach($comment->reply as $reply)
      @if(Auth::guard('university')->check())
        @if(Auth::guard('university')->user()->id == $reply['user_id'])
        <dl class="huifu" rid="{{$reply['id']}}">
        @else
        <dl onclick="window.location.href='{{url("university/discussion/reply/cid/$reply[id]/type/1")}}'">
        @endif  
      @else
      <dl onclick="alert('尚未登陆！');window.location.href='{{url("university/login?source=3&yid=".$comment->id)}}'">
      @endif 
        <dd><img src="{{$reply['user_pic']}}" alt=""></dd>
        <dt>
          @if($reply['type'] == 1)
          <p class="dt_namet">{{$reply['user_name']}}<em>回复</em><span>{{$reply['s_user_name']}}</span></p>
          @else
          <p class="dt_namet">{{$reply['user_name']}}</p>
          @endif
          <p class="dt_con">{{$reply['content']}}</p>
        </dt>
      </dl>
      @endforeach
    </div>
  </div>
  <div class="cover">
    <div class="box1">
      <p class="yes">删除回复</p>
      <p class="no">取消</p>
    </div>
    <div class="box2">
      <p class="boxtit">确认删除你的观点？</p>
      <div class="btns">
        <p class="yesl">确认</p>
        <p class="nor">取消</p>
      </div>
    </div>
  </div>
  @if(Auth::guard('university')->check())
  <footer>
    <p class="input" onclick="window.location.href='{{url("university/discussion/reply/cid/".$comment->id."/type/0")}}'">
      <input type="text" placeholder="我来说两句..." disabled>
    </p>
    <p class="fun">
      <a href="{{url('university/discussion/commentPoster/cid/'.$comment->id)}}" class="Imgbox">
        <img src="{{asset('University/images/icon_haibao@2x.png')}}" />海报
      </a>
      <a href="javascript:;" class="Imgbox">
        <img src="{{asset('University/images/icon_fenxiang2@2x.png')}}"/>转发
      </a>
      <a href="javascript:;" class="Imgbox dianzan" status="{{$comment->prai_status}}">
        @if($comment->prai_status)
        <img src="{{asset('University/images/icon_dianzan@2x.png')}}" />赞同
        @else
        <img src="{{asset('University/images/icon_dianzan1@2x.png')}}" />赞同
        @endif
      </a>
    </p>
  </footer>
  @else
  <footer onclick="alert('尚未登陆！');window.location.href='{{url("university/login?source=3&yid=".$comment->id)}}'">
    <p class="input"><input type="text" placeholder="我来说两句..." disabled></p>
    <p class="fun">
      <a href="{{url('university/discussion/commentPoster/cid/'.$comment->id)}}" class="Imgbox">
        <img src="{{asset('University/images/icon_haibao@2x.png')}}" />海报
      </a>
      <a href="#" class="Imgbox"><img src="{{asset('University/images/icon_fenxiang2@2x.png')}}" />转发</a>
      <a href="javascript:;" class="Imgbox">
        <img src="{{asset('University/images/icon_dianzan1@2x.png')}}" />赞同
      </a>
    </p> 
  </footer>
  @endif
  <script>
    $(document).ready(function () {
      var csrf = "{{csrf_token()}}";
      var cid = "{{$comment->id}}";
      //回复
      $('.huifu').click(function(){
        var rid = $(this).attr('rid')
        var csrf = "{{csrf_token()}}";
        time = setTimeout(function(){
          $('.cover').fadeIn()
          $('.box2').hide();
          $('.box1').show();
          $('.yes').click(function(){
              $('.box1').hide();
              $('.box2').show();
              $('.yesl').click(function(){
                $.ajax({
                  url:"{{url('university/discussion/delReply')}}",
                  data:{_token:csrf,rid:rid},
                  type:'DELETE',
                  dataType:'json',
                  success:function(d){
                    console.log(d.msg);
                    if (d.code ==='002') {
                      // $('.cover').hide();
                      window.location.reload();
                    }
                  }
                })
              });
            })
            $('.no').click(function(){
              $('.cover').hide();
            })
            $('.nor').click(function(){
              $('.cover').hide();
            })
        })
      })
      //收藏
      $('.collect').click(function(){
        var status = $(this).attr('status') == 1 ? 0 : 1;
        var thisOBJ = $(this).find("img");
        $.ajax({
          url:"{{url('university/discussion/collect')}}",
          data:{_token:csrf,cid:cid,status:status},
          type:'POST',
          dataType:'json',
          success:function(d){
            console.log(d)
            if (d.code == '002') {
              thisOBJ.attr("src") == "{{asset('University/images/icon_shoucang@2x.png')}}"  ?  thisOBJ.attr("src","{{asset('University/images/icon_yishoucang@2x.png')}}") : thisOBJ.attr("src","{{asset('University/images/icon_shoucang@2x.png')}}")
            }
          }
        })  
      });
      //点赞
      $('.dianzan').click(function(){
        var status = $(this).attr('status') == 1 ? 0 : 1;
        var thisOBJ = $(this);
        $.ajax({
            url:"{{url('university/discussion/praise')}}",
            data:{_token:csrf,cid:cid,status:status},
            type:'POST',
            dataType:'json',
            success:function(d){
              if (d.code == '002') {
                console.log(d)
                thisOBJ.attr('status',d.status)
                thisOBJ.find("img").attr("src") == "{{asset('University/images/icon_dianzan1@2x.png')}}"  ?  thisOBJ.find("img").attr("src","{{asset('University/images/icon_dianzan@2x.png')}}") : thisOBJ.find("img").attr("src","{{asset('University/images/icon_dianzan1@2x.png')}}")
             }
            }
          })  
      })
    })

  </script>
@stop