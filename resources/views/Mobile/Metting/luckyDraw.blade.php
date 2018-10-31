<!DOCTYPE html>
<html lang="zh-cmn-Hans" style="font-size: 16.15px;">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>砸金蛋赢好礼</title>
<link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/reset.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/font/iconfont.css')}}">
<script>
	(function (doc, win) {
		var docEl = doc.documentElement,
				resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
				recalc = function () {
					var clientWidth = docEl.clientWidth;
					if (!clientWidth) return;
					docEl.style.fontSize = 5 * (clientWidth / 100) + 'px';
				};

		if (!doc.addEventListener) return;
		win.addEventListener(resizeEvt, recalc, false);
		doc.addEventListener('DOMContentLoaded', recalc, false);
	})(document, window);
</script>

<style>
    .gamebox{
        background:url("{{asset('Mobile/metting/images/bg.jpg')}}") repeat; background-size: 100% 100%;
    }
	.portrait body div.landscape{ display: none !important; }
	.landscape body div.landscape{ display: block !important; }
	.loading{position:fixed;z-index:999;top:0;left:0;display:table;width:100%;height:100%;background:#93167b;color:#cbe8b2;text-align:center}.loading .loader{display:table-cell;vertical-align:middle}.loading .loader span{position:relative;display:inline-block;margin-bottom:.5rem;border-top:.3rem solid hsla(0,0%,100%,.2);border-right:.3rem solid hsla(0,0%,100%,.2);border-bottom:.3rem solid hsla(0,0%,100%,.2);border-left:.3rem solid #fff;-webkit-animation:load 1s infinite linear;animation:load 1s infinite linear}.loading .loader span,.loading .loader span:after{width:2.8rem;height:2.8rem;border-radius:50%}@-webkit-keyframes load{0%{-webkit-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes load{0%{-webkit-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
</style>

</head>
<body onload="init();">

<!--loading-->
<!-- <div id="loading" class="loading">
    <div class="loader">
        <span></span>
        <p id="loadtext">Loading...</p>
    </div>
</div> -->
<!--//loading-->


<div class="gamebox">
    <div class="stage">
        <img src="{{asset('Mobile/metting/images/stage.png')}}" style="display: block;">
        <div class="lanren">
            <div class="agg"></div>
            <div class="agg"></div>
            <div class="agg"></div>
        </div>
        @if($open['status'] != 1)
        <div class="cover" style="display: block;">
            <p>本场奖品已派完，敬请期待下一场！</p>
            <!-- <p>活动尚未开始</p> -->
        </div>
        @else
        <input type="hidden" id="ld_id" value="{{$open['id']}}">
        @endif
        <div class="cover" id="latlon" style="display: block;">
            <p>本活动仅限嘉宾峰会现场参加</p>
            <!-- <p>活动尚未开始</p> -->
        </div>
        <!--中奖-->
        <div class="winBox" style="display: none;">
            <h4>恭喜你获得了</h4>
            <div class="prizeImg">
                <img class="prize_bg" src="{{asset('Mobile/metting/images/prize_bg.png')}}" alt="">
                <img src="" class="prize_img">
            </div>
            <h5 class="pri_name">小狗电器一台</h5>
            <p></p>
        </div>
    </div>
    
    <!--活动说明-->
    <div class="bot_box">
        <div class="bot">
            <div id="tabs" class="tabs">
                <strong class="current"><span>活动说明</span></strong>
                <strong><span>中奖名单</span></strong>
            </div>
            <div id="tabs-body" class="tabsbox">
                <div>
                    <h4><img src="{{asset('Mobile/metting/images/time.png')}}" alt=""></h4>
                    <p>2018年10月18日峰会当天，具体时间以现场公布为准。</p>
        
                    <h4><img src="{{asset('Mobile/metting/images/prize.png')}}" alt=""></h4>
                    <p>第一场：</p>
                    <div class="index">
                        <div class="left_0">
                            <i class="iconfont icon-icon--"></i>
                        </div>
                        <div class="main_0">
                            <div class="content_0">
                                <div>
                                    <li><img src="{{asset('Mobile/metting/images/ddyx.png')}}" alt=""></li>
                                    <li><img src="{{asset('Mobile/metting/images/lms.png')}}" alt=""></li>
                                    <li><img src="{{asset('Mobile/metting/images/njy.png')}}" alt=""></li>
                                </div>
                                <div>
                                    <li><img src="{{asset('Mobile/metting/images/pmsm.png')}}" alt=""></li>
                                    <li><img src="{{asset('Mobile/metting/images/xg1.png')}}" alt=""></li>                                                                               
                                </div>
                            </div>
                        </div>
                        <div class="right_0">
                            <i class="iconfont  icon-icon--1"></i>
                        </div>
                    </div>
                    <p>第二场：</p>
                    <div class="index">
                        <div class="left_1">
                            <i class="iconfont icon-icon--"></i>
                        </div>
                        <div class="main_1">
                            <div class="content_1">
                                <div>
                                    <li><img src="{{asset('Mobile/metting/images/jbej.png')}}" alt=""></li>
                                    <li><img src="{{asset('Mobile/metting/images/kdxf.png')}}" alt=""></li>
                                    <li><img src="{{asset('Mobile/metting/images/sqyc.png')}}" alt=""></li>
                                </div>
                                <div>
                                    <li><img src="{{asset('Mobile/metting/images/xg.png')}}" alt=""></li>                                                                              
                                </div>
                            </div>
                        </div>
                        <div class="right_1">
                            <i class="iconfont  icon-icon--1"></i>
                        </div>
                    </div>
                    <h4><img src="{{asset('Mobile/metting/images/notice.png')}}" alt=""></h4>
                    <p>1. 中奖后请点击领奖，并填写相应信息，奖品将在会后以免费邮寄的方式派发！</p>
                    <p>2. 本活动最终解释权归活动主办方所有。</p>
                    <!-- <p class="notice not"><strong>*</strong>注：您所填写的信息仅作为奖品派发凭证，嘉宾 大学不会对外公开</p> -->
        
                </div>
                <div style="display: none; padding-bottom: 4rem; position: relative;">
                    @foreach($winner as $v)
                    <p class="win"><span>{{$v->nickname}}</span><span>{{$v->award_name}}</span><span>{{substr($v->time,11,5)}}</span></p>
                    @endforeach             
                </div>
            </div>
        </div>
    </div>
</div>




<!--没中-->
<div id="sorryBox" class="sorryBox" style="display: none;">
    <div>
        <img src="{{asset('Mobile/metting/images/sorry.png')}}" style="margin-bottom: 10%;">
        <button id="start-again" class="btn">再来一次</button>
    </div>
</div>

<img src="{{asset('Mobile/metting/images/jingnan.png')}}" class="acePack" onclick="window.location.href='{{url('mobile/metting/myAward/uid/'.$open['uid'])}}'">

<div class="landscape" style="display: none">
    <div><img src="{{asset('Mobile/metting/images/fpts.png')}}"></div>
</div>
<div id="dandan">
    <img src="{{asset('Mobile/metting/images/hammer.png')}}" class="hammer">
    <img src="{{asset('Mobile/metting/images/agg-puo.png')}}" class="agg-puo">
</div>
{{ csrf_field() }}
<input type="hidden" id="uid" value="{{$open['uid']}}">
<input type="hidden" id="nickname" value="{{$open['nickname']}}">
<input type="hidden" id="register" value="{{url('mobile/metting/register')}}">
<input type="hidden" id="clickUrl" value="{{url('mobile/metting/clickOne')}}">
<script type="text/javascript" src="{{asset('Mobile/metting/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Mobile/metting/js/preloadjs-NEXT.min.js')}}"></script>
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=Ddk4dEgl09mEERDAV94xx6SgeyWmzw8V"></script>
<script type="text/javascript" src="{{asset('Mobile/js/convertor.js')}}"></script>
<script>

    var chance = 5;  //砸蛋次数
    var dandan = $('#dandan').html();
    var register = $('#register').val();
    var clickUrl = $('#clickUrl').val();
    var uid = $('#uid').val();
    var nickname = $('#nickname').val();
    var ld_id = $('#ld_id').val();
    var _token = $('[name=_token]').val();
    function init() {
        var winH = $(window).innerHeight();
        var winW = $(window).innerWidth();
        $("body,.gamebox,.jn-box").css({height:'auto',width:winW});

        $("#chance").text(chance);
        
        var YesorNo = true;
        function aClick() {
            $(".agg").off("click", aClick);
            // chance-=1;
            // $("#chance").text(chance);

            // if(chance<0){
            //     chance = 0;
            //     $("#chance").text(chance);
            //     alert("你今天的5次砸蛋机会已经用完！");
            //     $(".agg").on("click", aClick);
            // }else {
                var _this = $(this);
                _this.parents(".lanren").addClass("paused");
                _this.html(dandan);
                setTimeout(function () {
                    _this.css({background:"none"}).find(".agg-puo").show();
                    var rand = Math.random()*500;
                    setTimeout(function(){
                        $.ajax({
                            url:clickUrl,
                            type:'POST',
                            dataType : 'json',
                            data:{uid:uid,nickname:nickname,ld_id:ld_id,_token:_token},
                            success:function(d){
                                console.log(d);
                                if (d.code != 200){
                                    $("#sorryBox").show();
                                }else {
                                    $(".lanren").hide();
                                    $(".winBox").show().find(".prize_img").attr("src",d.data.pic);
                                    $('.pri_name').html(d.data.name)
                                    $(".winBox").find("p").html("<button class='btn' style='margin: 1.5% 0;'>立即领取</button>").on("click",function () {
                                        window.location.replace(register+'?uid='+d.uid);
                                    })
                                }
                            }
                        })
                    },rand);

                    /*setTimeout(function () {
                        //是否中奖
                        if (YesorNo == true){
                            $("#sorryBox").show();
                        }else {
                            $(".lanren").hide();
                            $(".winBox").show().find(".prize_img").attr("src","images/jp-1.png");
                            $(".winBox").find("p").html("<button class='btn' style='margin: 1.5% 0;'>登记领奖</button>").on("click",function () {
                                window.location.replace(register);
                            })
                        }

                    },500)*/;
                },250);
            // }

        }

        $(".agg").on("click", aClick);


        //重新开始
        $("#start-again").on('click', function () {
            $("#sorryBox").hide();
            $(".lanren").removeClass("paused");
            $(".agg").on("click", aClick).html("").attr("style","");
        });

        //打开锦囊
        $(".acePack").on('click', function(){
            // $(".jn-box").show().find(".btn-close").on('click',function () {
            //     $(".jn-box").hide();
            // });
            // console.log($("#tabs").height());
            // $("#tabs-body").css({height:winH - $("#tabs").height()});
        });

        //详情内容
        $("#tabs > strong").on('click', function(){
            var index = $(this).index();
            var divs = $("#tabs-body > div");
            $(this).addClass("current").siblings().removeClass("current");
            divs.hide();
            divs.eq(index).show();
        });  

        //轮播
        var mainWidth = $('.main_0').width()
        var mainWidth1 = $('.main_1').width()
        var nowInd = 0
        var nowInd_1 = 0
        var divs = document.getElementsByClassName('content_0')[0].getElementsByTagName('div')
        var divs1 = document.getElementsByClassName('content_1')[0].getElementsByTagName('div')
        for (var i = 0; i < divs.length; i++) {
            divs[i].style.left = i * mainWidth + 'px'
        }
        for (var i = 0; i < divs1.length; i++) {
            divs1[i].style.left = i * mainWidth1 + 'px'
        }
        if (nowInd == 0) {
            $('.left_0').addClass('disable')
        }
        if (nowInd_1 == 0) {
            $('.left_1').addClass('disable')
        }
        $('.left_0').click(function () {
            if (nowInd <= 0) {
                nowInd = 0
            } else {
                --nowInd
                if (nowInd <= 0){
                    $('.left_0').addClass('disable')
                }
                $('.right_0').removeClass('disable')

                $('.content_0').css({
                    "transform": "translate(" + -nowInd * mainWidth + "px, 0)",
                    "transition-duration": "1s",
                    "transition-timing-function": "linear"
                })
            }
        })

        $('.left_1').click(function () {
            if (nowInd_1 <= 0) {
                nowInd_1 = 0
            } else {
                --nowInd_1
                if (nowInd_1 <= 0){
                    $('.left_1').addClass('disable')
                }
                $('.right_1').removeClass('disable')

                $('.content_1').css({
                    "transform": "translate(" + -nowInd_1 * mainWidth1 + "px, 0)",
                    "transition-duration": "1s",
                    "transition-timing-function": "linear"
                })
            }
        })

        $('.right_0').click(function () {
            if (nowInd >= divs.length - 1) {
                nowInd = divs.length - 1
            } else {
                ++nowInd
                if (nowInd >= divs.length - 1) {
                    $('.right_0').addClass('disable')
                }
                $('.left_0').removeClass('disable')

                $('.content_0').css({
                    "transform": "translate(" + -nowInd * mainWidth + "px, 0)",
                    "transition-duration": "1s",
                    "transition-timing-function": "linear"
                })
            }
        })
        $('.right_1').click(function () {
            if (nowInd_1 >= divs.length - 1) {
                nowInd_1 = divs.length - 1
            } else {
                ++nowInd_1
                if (nowInd_1 >= divs.length - 1) {
                    $('.right_1').addClass('disable')
                }
                $('.left_1').removeClass('disable')

                $('.content_1').css({
                    "transform": "translate(" + -nowInd_1 * mainWidth1 + "px, 0)",
                    "transition-duration": "1s",
                    "transition-timing-function": "linear"
                })
            }
        })

        //地图
        function getLocation(){
            var options={
                enableHighAccuracy:true,
                maximumAge:1000
            }
            if(navigator.geolocation){
                //浏览器支持geolocation
                navigator.geolocation.getCurrentPosition(onSuccess,onError,options);
            }else{
                //浏览器不支持geolocation
                alert('您的浏览器不支持地理位置定位');
            }
        }
        //成功时
        function onSuccess(position){
            //返回用户位置
            //经度
            var longitude =position.coords.longitude;
            //纬度
            var latitude = position.coords.latitude;
            // console.log(longitude);
            // console.log(latitude);
            // alert('经度'+longitude+'，纬度'+latitude);
            
            //判断当前位置离
            // 北京
            // var latnow = '39.920884';
            // var lonnow = '116.459137';
            // 深圳
            var latnow = '22.477291';
            var lonnow = '113.899711';
            var juli = GetDistance(latitude,longitude,latnow,lonnow);
            if (juli <= 5000) {
                $('#latlon').css('display','none');
            }
            // alert('距离当前中心定位约 '+juli+' 米');
            //根据经纬度获取地理位置，不太准确，获取城市区域还是可以的
            // var map = new BMap.Map("allmap");
            // var point = new BMap.Point(longitude,latitude);
            // var gc = new BMap.Geocoder();
            // gc.getLocation(point, function(rs){
            //     var addComp = rs.addressComponents;
            //     // alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
            // });
        }
        //失败时
        function onError(error){
            switch(error.code){
                case 1:
                    alert("位置服务被拒绝");
                    break;
                case 2:
                    alert("暂时获取不到位置信息");
                    break;
                case 3:
                    alert("获取信息超时");
                    break;
                case 4:
                    alert("未知错误");
                    break;
            }
        }
        window.onload=getLocation();
         
         //判断两点的距离   
        function GetDistance( lat1,  lng1,  lat2,  lng2){
            var radLat1 = lat1*Math.PI / 180.0;
            var radLat2 = lat2*Math.PI / 180.0;
            var a = radLat1 - radLat2;
            var  b = lng1*Math.PI / 180.0 - lng2*Math.PI / 180.0;
            var s = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(a/2),2) +
            Math.cos(radLat1)*Math.cos(radLat2)*Math.pow(Math.sin(b/2),2)));
            s = s *6378.137 ;// EARTH_RADIUS;
            s = Math.round(s * 10000) / 10;
            //单位米
            return s;
        }
        
    }


    (function () {
        var init = function () {
            var updateOrientation = function () {
                var orientation = window.orientation;
                switch (orientation) {
                    case 90:
                    case -90:
                        orientation = 'landscape'; //这里是横屏
                        break;
                    default:
                        orientation = 'portrait'; //这里是竖屏
                        break;
                }
                document.body.parentNode.setAttribute('class', orientation);
            };
            window.addEventListener('orientationchange', updateOrientation, false);
            updateOrientation();
        };
        window.addEventListener('DOMContentLoaded', init, false);
    })();
</script>

</body>
</html>