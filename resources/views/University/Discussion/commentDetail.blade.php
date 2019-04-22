@extends('layouts.university')
@section('title','观点详情')
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
        <div class="funr">
          <a href="#" class="Imgbox collectClick" status="{{$comment->coll_status}}">
          @if($comment->coll_status)
            <img src="{{asset('University/images/icon_yishoucang@2x.png')}}" alt="">
            <em>已收藏</em>
          @else
            <img src="{{asset('University/images/icon_shoucang@2x.png')}}" alt="">
            <em>收藏</em>
          @endif
          </a>
          @if($comment->is_my == 1)
          <a href="#" class="Imgbox delcli"><img src="{{asset('University/images/icon_shanchu@2x.png')}}" />删除</a>
          @endif
        </div>
        @else
        <div class="collect" onclick="alert('尚未登陆！');window.location.href='{{url("university/quickLogin?source=3&yid=".$comment->id)}}'">
          <img src="{{asset('University/images/icon_shoucang@2x.png')}}" alt="">收藏
        </div>
        @endif
        <!-- <p class="funr">
          <a href="#" class="Imgbox"><img src="{{asset('University/images/icon_shoucang@2x.png')}}" />收藏</a>
            <a href="#" class="Imgbox delcli"><img src="{{asset('University/images/icon_shanchu@2x.png')}}" />删除</a>
        </p> -->
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
      <dl onclick="alert('尚未登陆！');window.location.href='{{url("university/quickLogin?source=3&yid=".$comment->id)}}'">
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
      <p class="boxtit"></p>
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
      <a href="javascript:;" class="Imgbox dianzan" status="{{$comment->prai_status}}">
        @if($comment->prai_status)
        <img src="{{asset('University/images/icon_dianzan@2x.png')}}" />
        <em>{{$comment->praise}}</em>
        @else
        <img src="{{asset('University/images/icon_dianzan1@2x.png')}}" />
        <em>赞同</em>
        @endif
      </a>
    </p>
  </footer>
  @else
  <footer >
    <p class="input"><input type="text" placeholder="我来说两句..." disabled></p>
    <p class="fun">
      <a href="{{url('university/discussion/commentPoster/cid/'.$comment->id)}}" class="Imgbox">
        <img src="{{asset('University/images/icon_haibao@2x.png')}}" />海报
      </a>
      <a href="javascript:;" class="Imgbox" onclick="alert('尚未登陆！');window.location.href='{{url("university/quickLogin?source=3&yid=".$comment->id)}}'">
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
              $('.boxtit').text('确认删除你的回复？');
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
              rid = null;
              $('.cover').hide();
            })
            $('.nor').click(function(){
              rid = null;
              $('.cover').hide();
            })
        })
      })
      //删除自己评论
      $('.delcli').click(function(){
        $('.boxtit').text('确认删除你的观点？');
        $('.cover').show();
        $('.box2').show();
        $('.box1').hide();
        $('.yesl').click(function(){
            $.ajax({
              url:"{{url('university/discussion/delComment')}}",
              data:{_token:csrf,cid:cid},
              type:'DELETE',
              dataType:'json',
              success:function(d){
                console.log(d);
                if (d.code == '002') {
                  window.location.href="{{url('university/discussion/detail/id/'.$comment->discussion_id)}}";
                }
              }
            })
        });
        $('.nor').click(function(){
          $('.cover').hide();
        })
      })
      //收藏
      $('.collectClick').click(function(){
        var status = $(this).attr('status') == 1 ? 0 : 1;
        var thisOBJ = $(this);
        $.ajax({
          url:"{{url('university/discussion/collect')}}",
          data:{_token:csrf,cid:cid,status:status},
          type:'POST',
          async:false,
          dataType:'json',
          success:function(d){
            console.log(d)
            if (d.code == '002') {
              thisOBJ.find('em').text() == '收藏' ? thisOBJ.find('em').text('已收藏') : thisOBJ.find('em').text('收藏');
              thisOBJ.find("img").attr("src") == "{{asset('University/images/icon_shoucang@2x.png')}}"  ?  thisOBJ.find("img").attr("src","{{asset('University/images/icon_yishoucang@2x.png')}}") : thisOBJ.find("img").attr("src","{{asset('University/images/icon_shoucang@2x.png')}}")
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
            async:false,
            dataType:'json',
            success:function(d){
              if (d.code == '002') {
                console.log(d)
                thisOBJ.attr('status',d.status)
                thisOBJ.find('em').text() == '赞同' ? thisOBJ.find('em').text(d.praise) : thisOBJ.find('em').text('赞同');
                thisOBJ.find("img").attr("src") == "{{asset('University/images/icon_dianzan1@2x.png')}}"  ?  thisOBJ.find("img").attr("src","{{asset('University/images/icon_dianzan@2x.png')}}") : thisOBJ.find("img").attr("src","{{asset('University/images/icon_dianzan1@2x.png')}}")
             }
            }
          })  
      })
    })

  </script>
@stop