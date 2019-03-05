@extends('layouts.university')
@section('title','评论')
@section('content')
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('University/css/diacuss_share.css')}}">
  <div class="wrapper2">
    <div class="top">
      <div class="share_logo"><img src="{{asset('University/images/logo@2x.png')}}" alt=""></div>
      <div class="share_tit">{{$discussion->title}}</div>
      <p class="share_name">出题人：{{$discussion->author}}</p>
    </div>
    <div class="bot">
      <p class="share_con"><span>{{$comment->user}}：</span>{{$comment->content}}</p>
      <p class="share_time">——{{$comment->time}}</p>
      <div class="share_code">
        <p class="code_t">扫码查看更多</p>
        <p class="code_img1"><img src="{{asset('University/images/img28@2x.png')}}" alt=""></p>
        <p class="code_img2"><img src="{{asset('University/images/erweima@2x.png')}}" alt=""></p>
      </div>
    </div>
    <div class="btn">
      <p class="left">保存本地</p>
      @if($data['web'] ==1)
        <p class="right">分享</p>
        <script type="text/javascript">
            wx.config({
                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: "{{$data['signPackage']['appId']}}", // 必填，公众号的唯一标识
                timestamp: "{{$data['signPackage']['timestamp']}}", // 必填，生成签名的时间戳
                nonceStr: "{{$data['signPackage']['nonceStr']}}", // 必填，生成签名的随机串
                signature: "{{$data['signPackage']['signature']}}",// 必填，签名，见附录1
                jsApiList: ['checkJsApi',
                'onMenuShareTimeline',//
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });

            window.share_config = {
                 "share": {
                    "imgUrl": "http://www.ijiabin.com/Home/images/wyjb_logo.png",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议前缀必须在。
                    "desc" : "{{strip_tags($data['discussion']->content)}}",//摘要,如果分享到朋友圈的话，不显示摘要。
                    "title" : "{{$data['discussion']->title}}",//分享卡片标题
                    "link": window.location.href,//分享出去后的链接，这里可以将链接设置为另一个页面。
                    "success":function(){
                        //分享成功后的回调函数
                    },
                    'cancel': function () { 
                        // 用户取消分享后执行的回调函数
                    }
                }
            }; 
            wx.ready(function () {
                wx.onMenuShareAppMessage(share_config.share);//分享给好友
                wx.onMenuShareTimeline(share_config.share);//分享到朋友圈
                wx.onMenuShareQQ(share_config.share);//分享给手机QQ
            });
        </script>
      @endif
    </div>
  </div>

@stop