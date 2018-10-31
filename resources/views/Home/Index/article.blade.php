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
    <style type="text/css">
      iframe{
        text-align: center;
      }
    </style>
    <div class="wrapper">
            @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <!-- 左侧内容 -->
                <div class="main-left">
                    <h3 class="art_title">{{$data['article']->title}}</h3>
                    <p class="art-time"><span>{{$data['article']->nav_name}}</span>·{{$data['article']->cg_name}}·{{$data['article']->push}}</p>
                    <div class="article">
                      {!! $data['article']->content !!}
                    </div>
                    <div id="code"></div>
                    <p class="share">
                      分享至：<i class="icon iconfont icon-weixin-copy"></i><i class="icon iconfont icon-weibo-copy"></i>
                    </p>
                    <div class="else">
                      <p>上一篇：{!! $data['prev'] ? '<a href="'.url('article/id/'.$data['prev'][0]->id).'" >'.$data['prev'][0]->title.'</a>' : '无' !!}</p>
                      <p>下一篇：{!! $data['next'] ? '<a href="'.url('article/id/'.$data['next'][0]->id).'" >'.$data['next'][0]->title.'</a>' : '无' !!}</p> 
                        
                     
                    </div>
                    <div class="bot">
                        <h3 class="rig_tit"><i class="icons"></i>你可能感兴趣的</h3>
                        <div class="bot-box">
                            @foreach($data['like'] as $like)
                            <dl class="bot_dls">
                                <a href="{{url('article/id/'.$like->id)}}">
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
                <!-- 右侧 -->
                <div class="main-right">
                    <div class="rig-top">
                        <h3 class="rig_tit"><i class="icons"></i>相关推荐</h3>
                        @foreach($data['choiceness'] as $cho)
                        <dl class="rig_dls">
                            @if($cho->type ==1)
                            <!-- 文章 -->
                            <a href="{{url('article/id/'.$cho->cho_id)}}">
                            @else
                            <!-- 视频待定 -->
                            <a href="">
                            @endif
                                <dt class="dls_img">
                                    <img src="{{asset($cho->cover)}}" alt="">
                                </dt>
                                <dd class="dls_tit">{{$cho->title}}</dd>
                            </a>
                        </dl>
                        @endforeach
                        <!-- <dl class="rig_dls">
                            <a href="">
                                <dt class="dls_img">
                                    <img src="{{asset('Home/images/list3.png')}}" alt="">
                                </dt>
                                <dd class="dls_tit">放到沙发上豆腐红烧豆腐红烧豆腐还是大放送的护发素地方官方代购的风格</dd>
                            </a>
                        </dl> -->
                       <!--  <dl class="rig_dls">
                          <a href="">
                              <dt class="dls_img">
                                  <img src="{{asset('Home/images/list3.png')}}" alt="">
                              </dt>
                              <dd class="dls_tit">放到沙发上豆腐红烧豆腐红烧豆腐还是大放送的护发素地方官方代购的风格</dd>
                          </a>
                        </dl> -->
                    </div> 
                    <!-- <div class="share share2">
                      分享至：<i class="icon iconfont icon-weixin wx"></i><i class="icon iconfont icon-weibo wb"></i>
                      <p class="big-wx"><img src="{{asset('Home/images/wx.jpeg')}}" alt=""></p>
                      <p class="big-wb"><img src="{{asset('Home/images/wx.jpeg')}}" alt=""></p>
                    </div>    -->
                                   
                </div>
            </div>
    </div>
    </div>
    <input type="hidden" name="title" value="{{$data['title']}}">
    <input type="hidden" name="picurl" value="{{asset($data['article']->cover)}}">
    <input type="hidden" name="src" value="{{asset('Home/images/wyjb_logo.png')}}">
@include('layouts._footer')
<script>
    $('iframe').parent().css("text-align","center")
</script>
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
      height : "120",              //二维码的高度
      background : "#ffffff",       //二维码的后景色
      foreground : "#000000",        //二维码的前景色
      src: src             //二维码中间的图片
    }); 
</script>
@stop