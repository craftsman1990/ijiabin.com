@extends('layouts.home')
@section('title',$data['title'])
<style type="text/css">
  #code{display: none;
    position: relative;
  }
  canvas{
    position: absolute;
    top: -123px;
    left: 16px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
</style>
@section('content')
    <link rel="stylesheet" href="{{asset('Home/css/details.css')}}">
    <div class="wrapper">
            @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <div class="main-left">
                    <div class="article">
                      <h3  class="art_title">{{$data['video']->title}}</h3>
                      <p class="art-time"><span>{{$data['video']->nav_name}}</span>·{{$data['video']->cg_name}}·{{$data['video']->push}}</p>
                      <video class="videoFrame" controls="true" controlslist="nodownload" poster="{{$data['video']->cover}}">
                          <source src="{{$data['video']->address}}" type="video/mp4">
                          <source src="movie.ogg" type="video/ogg">
                      </video>
                      <p class="art-assist"><b>“</b>{{$data['video']->content}}</p>
                    </div>
                    <div id="code"></div>
                    <p class="share">
                      分享至：<i class="icon iconfont icon-weixin-copy"></i><i class="icon iconfont icon-weibo-copy"></i>
                    </p>
                </div>
                <div class="main-right">
                    <div class="rig-top">
                        <h3 class="rig_tit"><i class="icons"></i>相关视频</h3>
                        @foreach($data['like'] as $like)
                        <dl class="rig_dls">
                            <a href="{{url('video/id/'.$like->id)}}">
                                <dt class="dls_img">
                                    <img src="{{asset($like->cover)}}" alt="">
                                </dt>
                                <dd class="dls_tit">{{$like->title}}</dd>
                            </a>
                        </dl>
                        @endforeach
                    </div>
                                   
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="title" value="{{$data['title']}}">
    <input type="hidden" name="picurl" value="{{asset($data['video']->cover)}}">
    <input type="hidden" name="src" value="{{asset('Home/images/wyjb_logo.png')}}">
@include('layouts._footer')
<script src="{{asset('Home/js/jquery.qrcode.js')}}"></script>
<script src="{{asset('Home/js/qrcode.js')}}"></script>
<script src="{{asset('Home/js/utf.js')}}"></script>
<script type="text/javascript">
  var title =  $('[name=title]').val(),
      picurl =  $('[name=picurl]').val(),
      src = $('[name=src]').val();
  var url = window.location.href;
  var domain = window.location.host;
  var arr = url.split(domain);
  var shareUrl = arr[0]+domain+'/mobile'+arr[1];
  // console.log(url);
  // console.log(domain);
  console.log(arr);
  var ShareTip = function()  {};
  //分享到新浪微博       
  ShareTip.prototype.sharetosina=function(title,url,picurl){        
    var sharesinastring='http://v.t.sina.com.cn/share/share.php?title='+title+'&url='+url+'&content=utf-8&sourceUrl='+url+'&pic='+picurl;         
    window.open(sharesinastring,'newwindow','height=400,width=400,top=100,left=100');        
  } 

  $('.icon-weibo-copy').click(function(){
    var share = new ShareTip();
    share.sharetosina(title,shareUrl,picurl);
  })

  //分享到微信
  $('.icon-weixin-copy').hover(function(){
    $('#code').css('display','block');
  },function(){
    $('#code').css('display','none');
  })

  //二维码
  jQuery('#code').qrcode({
      render : "canvas",
      text : shareUrl,
      width : "120",               //二维码的宽度
      height : "120",             //二维码的高度
      background : "#ffffff",       //二维码的后景色
      foreground : "#000000",        //二维码的前景色
      src: src             //二维码中间的图片
    }); 

  $('.videoFrame').bind('contextmenu',function() { 
      return false; 
  });
</script>
@stop