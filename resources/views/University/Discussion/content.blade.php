
@extends('layouts.university')
@section('title','议一议')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/diacuss_reply.css')}}">
  <div class="wrapper">
    <p class="dia_tit">{{$discussion->title}}</p>
    <div class="write">
      <textarea name="content" id="content" oninput="content()" placeholder="在这里说说你的观点，观点还可以生成精美海报哦~">{{old('content')}}</textarea>
    </div>
  </div>
  <div class="cover">
    <div class="box2">
      <p class="boximg"><img src="{{asset('University/images/icon_yifabu@2x.png')}}" alt=""></p>
      <p class="boxtit">已发布</p>
      <div class="btns">
        <p class="yesl" onclick="window.location.href='{{url("university/discussion/detail/id/".$discussion->id)}}'">关闭</p>
        <p class="nor" onclick="schb()">生成海报</p>
      </div>
    </div>
  </div>
  <div class="cover1">
    <div class="box3">
      <div class="btop">
        <p class="tuz"><img src="{{asset('University/images/icon_tuzi@2x.png')}}" alt=""></p>
        <p class="tz_tit">以下文字可能含有“涉政”信息， 请修改后重新提交！</p>
      </div>
      <p class="tz_con"></p>
      <button class="tz_btn" >去修改</button>
    </div>
  </div>
  <footer>
    <button class="issue" disabled="disabled">发布</button>
  </footer>
  <input type="hidden" id="cid" value="0">
  <!-- <script src="University/js/jquery.min.js"></script> -->
  <script>
    $(document).ready(function () {
      $('.issue').click(function(){
        var content = $('#content').val(),
            uid = "{{$user->id}}",
            did = "{{$discussion->id}}",
            csrf = "{{csrf_token()}}";
        $.ajax({
          url:"{{url('university/discussion/putContent')}}",
          data:{uid:uid,did:did,content:content,_token:csrf},
          type:'POST',
          dataType:'json',
          success:function(d){
            if (d.code == '001') {
              $('.tz_con').text(d.content);
              $('.cover1').fadeIn()
            }else if(d.code == '002'){
              $('#cid').val(d.data.id);
              $('.cover').fadeIn()  
            }else{
              alert(d.msg); 
            }
            console.log(d);

          }

        })
      })

      $('.tz_btn').click(function(){
        $('.cover1').fadeOut() 
      })
    })

    function schb(){
      var cid = $('#cid').val()
      if(cid != 0){
        var hburl = "{{url('university/discussion/commentPoster/cid')}}"+'/'+cid;
        window.location.href=hburl;
      }else{
        alert('尚未评论，无法生成海报')
      }
    }

    function content(){
      var text=document.getElementById("content");
      //获取输入的文字的长度
      var textLength=text.value.length;
      if(textLength>=0){
          $(".issue").attr("disabled",false);
          $('.issue').addClass('btn1')
      }else{
        $(".issue").attr("disabled",true);
        $('.issue').removeClass('btn1')
      }
    }
  </script>
@stop