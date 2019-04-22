@extends('layouts.university')
@section('title','议题详情')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/discuss_detail.css')}}">
  <div class="wrapper">
    <div class="discuss">
      <p class="dis_tit">{{$discussion->title}}</p>
      <div class="fun">
        <p class="funl">出题人：{{$discussion->author}}</p>
        <p class="funr">
          <a href="{{url('university/discussion/discussionPoster/did/'.$discussion->id)}}" class="Imgbox">
            <img src="{{asset('University/images/icon_haibao.png')}}" />海报</a>
          <!-- <a href="#" class="Imgbox"><img src="{{asset('University/images/icon_fenxiang2@2x.png')}}" />分享</a> -->
        </p>
      </div>
      <div class="dis_con">{!!$discussion->content!!}</div>
      <!-- <p class="dis_con">
        12月12日晚，证监会对外发布消息称，由于三只松鼠相关 事项需进一步核查，取消对其发行申报文件的审核。这是新一届 发审委成立以来，首家IPO申请被取消审核的企业。那么到底是 谁拽住了三只松鼠的尾巴，导致其其其其IPO...
      </p>
      <video controls>
        <source src="somevideo.webm" type="video/webm">
        <source src="somevideo.mp4" type="video/mp4">
      </video>  -->
    </div>
    <div class="line"></div>
    <div class="dis_comment">
      <h6>议一议</h6>
      @foreach($comment as $com)
      <div class="com_box">
        <dl>
          <dd><img src="{{$com->user_pic}}" alt=""></dd>
          <dt>
            <p class="dt_namet">{{$com->user_name}}<span>{{$com->time}}</span></p>
            <p class="dt_con" onclick="window.location.href='{{url("university/discussion/commentDetail/id/".$com->id)}}'">{{$com->content}}</p>
            @if($com->count !=0)
            <div class="reply">
              @foreach($com->reply as $reply)
                @if(Auth::guard('university')->check())
                <p class="rep_com" onclick="window.location.href='{{url("university/discussion/reply/cid/$reply[id]/type/1")}}'">
                  @if($reply['type'] == 1)
                  {{$reply['user_name']}} 回复 <span>{{$reply['s_user_name']}}：</span>{{$reply['content']}}
                  @else
                  <span>{{$reply['user_name']}}：</span>{{$reply['content']}}
                  @endif
                </p>
                @else

                @endif
              @endforeach
              
              <p class="look"><a href="{{url('university/discussion/commentDetail/id/'.$com->id)}}">查看{{$com->count}}条评论</a></p>
            </div>
            @endif
            @if(Auth::guard('university')->check())
            <p class="com_fun">
              <a href="javascript:;" class="Imgbox shoucang" cid="{{$com->id}}" status="{{$com->coll_status}}">
                @if($com->coll_status)
                <img src="{{asset('University/images/icon_yishoucang@2x.png')}}" /><em>已收藏</em>
                @else
                <img src="{{asset('University/images/icon_shoucang@2x.png')}}" /><em>收藏</em>
                @endif
              </a>
              <a href="{{url('university/discussion/reply/cid/'.$com->id.'/type/0')}}" class="Imgbox">
                <img src="{{asset('University/images/icon_pinglun@2x.png')}}" />{{$com->count > 0 ? $com->count : '评论'}}
              </a>
              <a href="javascript:;" class="Imgbox zantong" cid="{{$com->id}}" status="{{$com->prai_status}}">
                @if($com->prai_status)
                <img src="{{asset('University/images/icon_dianzan@2x.png')}}" /><em>{{$com->praise}}</em>
                @else
                <img src="{{asset('University/images/icon_dianzan1@2x.png')}}" /><em>赞同</em>
                @endif
              </a>
              <a href="{{url('university/discussion/commentPoster/cid/'.$com->id)}}" class="Imgbox">
                <img src="{{asset('University/images/icon_haibao@2x.png')}}" />海报
              </a>
            </p>
            @else
            <p class="com_fun">
              <a href="javascript:;" class="Imgbox" onclick="alert('尚未登陆！');window.location.href='{{url("university/quickLogin?source=2&yid=".$discussion->id)}}'">
                <img src="{{asset('University/images/icon_shoucang@2x.png')}}" />收藏
              </a>
              <!-- <a href="{{url('university/discussion/reply/cid/'.$com->id.'/id/'.$discussion->id.'/source/2/type/0')}}" class="Imgbox"> -->
              <a href="javascript:;" class="Imgbox" onclick="alert('尚未登陆！');window.location.href='{{url("university/quickLogin?source=2&yid=".$discussion->id)}}'">
                <img src="{{asset('University/images/icon_pinglun@2x.png')}}" />{{$com->count > 0 ? $com->count : '评论'}}
              </a>
              <a href="javascript:;" class="Imgbox" onclick="alert('尚未登陆！');window.location.href='{{url("university/quickLogin?source=2&yid=".$discussion->id)}}'">
                <img src="{{asset('University/images/icon_dianzan1@2x.png')}}" />赞同
              </a>
              <a href="{{url('university/discussion/commentPoster/cid/'.$com->id)}}" class="Imgbox">
                <img src="{{asset('University/images/icon_haibao@2x.png')}}" />海报
              </a>
            </p>  
            @endif
          </dt>
        </dl>
      </div>
      @endforeach
    </div>
  </div>
  <footer>
    <button onclick="window.location.href='{{url("university/discussion/content/id/".$discussion->id."/source/2")}}'">议一议</button>
  </footer>
  <script>
    $(document).ready(function () {
      //收藏
      $('.com_box').each(function(index) {
        $('.com_box').eq(index).find(".shoucang").click(function() {
          var csrf = "{{csrf_token()}}";
          var cid = $(this).attr('cid');
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
        })
      })
      //点赞
      $('.com_box').each(function(index) {
        $('.com_box').eq(index).find(".zantong").click(function() {
          var thisOBJ = $(this);
          var csrf = "{{csrf_token()}}";
          var cid = $(this).attr('cid');
          var status = $(this).attr('status') == 1 ? 0 : 1;
          $.ajax({
            url:"{{url('university/discussion/praise')}}",
            data:{_token:csrf,cid:cid,status:status},
            type:'POST',
            async:false,
            dataType:'json',
            success:function(d){
              console.log(d)
              if (d.code == '002') {
               thisOBJ.attr('status',d.status)
               thisOBJ.find('em').text() == '赞同' ? thisOBJ.find('em').text(d.praise) : thisOBJ.find('em').text('赞同');
               thisOBJ.find("img").attr("src") == "{{asset('University/images/icon_dianzan1@2x.png')}}"  ?  thisOBJ.find("img").attr("src","{{asset('University/images/icon_dianzan@2x.png')}}") : thisOBJ.find("img").attr("src","{{asset('University/images/icon_dianzan1@2x.png')}}")
             }
            }
          })  
         
        })
      })

      // $('.ondl').click(function(){
      //   alert('尚未登陆');
      //   window.location.href="{{url('university/login?source=2&id=1')}}";
      // });
      

    })
   
  </script>
@stop