<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<input type="hidden" id="signature" value="{{$signPackage['signature']}}">
<input type="hidden" id="noncestr" value="{{$signPackage['nonceStr']}}">
<input type="hidden" id="timestamp" value="{{$signPackage['timestamp']}}">
<input type="hidden" id="appId" value="{{$signPackage['appId']}}">
<script type="text/javascript">
    var timestamp = $('#timestamp').val();
    var noncestr = $('#noncestr').val();
    var signature = $('#signature').val();
    var appId = $('#appId').val();
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: appId, // 必填，公众号的唯一标识
            timestamp: timestamp, // 必填，生成签名的时间戳
            nonceStr: noncestr, // 必填，生成签名的随机串
            signature: signature,// 必填，签名，见附录1
            jsApiList: ['checkJsApi',
            'onMenuShareTimeline',//
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });

        window.share_config = {
             "share": {
                "imgUrl": "{{asset($share['cover'])}}",//分享图，默认当相对路径处理，所以使用绝对路径的的话，“http://”协议前缀必须在。
                "desc" : "{{$share['intro']}}",//摘要,如果分享到朋友圈的话，不显示摘要。
                "title" : "{{$share['title']}}",//分享卡片标题
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