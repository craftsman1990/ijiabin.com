@extends('layouts.university')
@section('title','课程')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/audio.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/video.css')}}">
  <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  <div class="wrapper">
    <div class="audio-wrapper">
        <audio size="#4.50MB" duration="#01:57" filename="#Launch_Kan R. Gao.mp3">
            <source id="autoPlay" class="autoPlay" src="{{$course->oneAudio}}" type="audio/mp3">
        </audio>
        <div class="audio-left">
            <img id="audioPlayer" src="{{asset('University/images/play.png')}}">
        </div>
        <div class="audio-left2">
            <img src="{{asset('University/images/icon_xiayige@2x.png')}}">
        </div>
        <div class="audio-right">
            <div class="progress-bar-bg" id="progressBarBg">
                <span id="progressDot"></span>
                <div class="progress-bar" id="progressBar"></div>
            </div>
            <div class="audio-time">
                <span class="audio-length-current" id="audioCurTime">00:00</span>
                <span class="audio-length-total">{{substr($course->oneTime,3,5)}}</span>
            </div>
        </div>
        <div class="audio-right2">
            <img class="avideo" src="{{asset('University/images/icon_shipin@2x.png')}}">
        </div>
         @if(Auth::guard('university')->check())
        <div class="audio-right3 collect" status="{{$course->coll_status}}">
          @if($course->coll_status)
          <img src="{{asset('University/images/icon_yishoucang@2x.png')}}">
          @else
          <img src="{{asset('University/images/icon_shoucang.png')}}">
          @endif
        </div>
        @else
        <div class="audio-right3 onlogin">
          <img src="{{asset('University/images/icon_shoucang.png')}}">
        </div>  
        @endif
    </div>
    <div id="centera">
      <div class="orangerb">
        <ul id="oranger"> 
          <li class="hover">课程介绍</li> 
          <li>课程目录</li> 
        </ul>
      </div>
      <div id="tablea" class="tablea">
        <div class="box">
          <p class="class_tit"><span></span>{{$course->name}}</p>
          <p class="class_guest">{{$course->intro}}</p>
        </div>
        <div class="box">
          <div class="container">
            <div class="tab-head">
              <ul>
                <li class="selected-li">课程目录</li>
                <li class="normal-li">自测题</li>
              </ul>
            </div>
            <div class="tab-content">
               {{--课程内容--}}
              <div class="box2">
                @foreach($contents as $content)
                  @if($content->type == 0 || Auth::guard('university')->check() && $course->isBuy == 1)
                  @if(Auth::guard('university')->check())
                  <div class="class_list get_video" video="{{$content->video}}" content="{{$content->content}}" ls_id="{{$content->learning->id}}" audio="{{$content->audio}}" time="{{substr($content->time,3,5)}}">
                  @else  
                  <div class="class_list get_video" video="{{$content->video}}" content="{{$content->content}}" ls_id="0" audio="{{$content->audio}}" time="{{substr($content->time,3,5)}}">
                  @endif  
                    <p class="list_name">
                      <span class="col">{{$content->chapter}} {{$content->title}}</span>
                      <span><img class="bianj" src="{{asset('University/images/icon_bianji@2x2.png')}}" alt=""></span>
                    </p>
                    {{--学习状态--}}
                    <p class="list_time">
                      <span class="notice">{{$content->type==1? '正课' : '预告'}}</span>{{substr($content->time,3,5)}}
                      @if(Auth::guard('university')->check())
                      <span class="acc">{{$content->learning->state ==1 ? '已完成' : '学习中'}}</span>
                      @else
                      <span class="acc">未学习</span>
                      @endif
                    </p>
                    <p class="list_img"><img src="{{asset('University/images/icon_zhankai@2x.png')}}" alt=""></p>
                    <div class="lisImgBox">{{$content->intro}}</div>
                  </div>
                  @else
                   
                    <div class="class_list">
                      <p class="list_name">
                        <span>{{$content->chapter}} {{$content->title}}</span>
                        <span><img src="{{asset('University/images/icon_suo@2x.png')}}" alt=""></span>
                      </p>
                      <p class="list_time">{{substr($content->time,3,5)}}</p>
                      <p class="list_img"><img src="{{asset('University/images/icon_zhankai@2x.png')}}" alt=""></p>
                    </div> 
                    
                  @endif
                @endforeach
                
              </div>
               {{--自测试题--}}
              <div class="box2"  style="display: none">
                {{--章节循环--}}
                @foreach($contents as $content)
                  @if($content->type == 0 || Auth::guard('university')->check() && $course->isBuy == 1)
                  <div class="class_list">
                    <p class="biaoqian"><img src="{{asset('University/images/icon_biaoqianlan@2x.png')}}" alt=""></p>
                    <div class="lis">
                      @if(Auth::guard('university')->check())
                      <p class="cons blue">({{$content->learning->quiz_state}}/{{$content->quizCount}}）</p>
                      @else
                      <p class="cons blue">(0/{{$content->quizCount}}）</p>
                      @endif
                      <p class="con blue">{{$content->chapter}}</p>
                      <p class="lis_tit blue">{{$content->title}}</p>
                    </div>
                    <div class="testBox">
                      <form id="form_{{$content->id}}">
                        @csrf
                        @if(Auth::guard('university')->check())
                        <input type="hidden" name="learning_id" value="{{$content->learning->id}}">
                        @endif
                      {{--题目循环--}}
                      @foreach($content->quizs as $k=>$quiz)
                      <div class="topicbox">
                        <p class="t_tit"><span>({{$quiz->type==1 ? '多选' : '单选'}}）</span>{{$k}}. {{$quiz->title}}</p>
                        {{--答案循环--}}
                        @foreach($quiz->answers as $ak=>$answer)
                        <div>
                          @if($quiz->type ==1)
                          <input type="checkbox"  id="checkbox{{$answer->id}}" name="more_{{$quiz->id}}[]" value="{{$answer->card}}" />
                          <label class="label" for="checkbox{{$answer->id}}">{{$answer->card}}. {{$answer->answer}}</label>
                          <div class="line"></div>
                          @else
                          <input type="radio"  id="radio_{{$answer->id}}"  name="one_{{$quiz->id.$k}}" value="{{$answer->card}}" />
                          <label class="label" for="radio_{{$answer->id}}">{{$answer->card}}. {{$answer->answer}}</label>
                          @endif
                        </div>
                        
                        @endforeach  
                        {{--判断是否显示正确答案--}}
                        @if(Auth::guard('university')->check())
                          @if($content->learning->quiz_state != 0)
                          <div class="analysis">
                          @else
                          <div class="analysis" style="display:none;">
                          @endif
                        @else
                          <div class="analysis" style="display:none;">
                        @endif  
                          <div class="ana_tit">
                            <p class="le">正确答案：<span>{{$quiz->answer}}</span></p>
                            <p class="ri">显示解析</p>
                          </div>
                          <div class="ana_con">题目解析：{{$quiz->analysis}}</div>
                        </div>                      
                      </div>
                      @endforeach
                      </form>
                      @if(Auth::guard('university')->check())
                      <button class="sub submit" id="{{$content->id}}">提交</button>
                      @else
                      <button class="sub onlogin" id="{{$content->id}}">提交</button>
                      @endif
                    </div>
                  </div>
                  @else
                   
                    <div class="class_list">
                      <p class="biaoqian"><img src="{{asset('University/images/icon_biaoqianlan@2x.png')}}" alt=""></p>
                      <div class="lis">
                        <p class="cons">({{$content->quizCount}}/{{$content->quizCount}}）</p>
                        <p class="con">{{$content->chapter}}</p>
                        <p class="lis_tit">{{$content->title}}</p>
                        <p class="imag"><img src="{{asset('University/images/icon_suo@2x.png')}}" alt=""></p>
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--判断是否登陆--}}
    @if(Auth::guard('university')->check())
      {{--判断是否收费课 并且 判断是否购买--}}
      @if($course->is_pay == 1)
        @if($course->isBuy != 1)
        <button class="btn onBuy">开通课程 | ￥99</button>
        @endif
      @endif
    @else
        <button class="btn onlogin">开通课程 | ￥99</button>
    @endif
    <div class="hint">购买后才能继续学习</div>
    @if($course->oneType == 0 || Auth::guard('university')->check() && $course->isBuy == 1)
    <div class="wengaotab denlu"><img src="{{asset('University/images/icon_wengao@2x.png')}}" alt=""></div>
    <div class="wengaobox con_content">{{$course->oneContent}}</div>
    @else
    <div class="wengaotab onlogin"><img src="{{asset('University/images/icon_wengao@2x.png')}}" alt=""></div>
    @endif
  </div>
  {{-- 登陆地址 --}}
  <input type="hidden" name="loginUrl" value="{{url('university/login?source=5&yid='.$course->id)}}">
  <input type="hidden" id="videoUrl" value="{{url('university/course/show/id/'.$course->id)}}">
  @if(Auth::guard('university')->check())
  <input type="hidden" name="ls_id" value="{{$course->oneId}}">
  <input type="hidden" name="status" value="{{$course->coll_status}}" id="status">
  <input type="hidden" value="1" id="is_login">
  @else
  <input type="hidden" name="ls_id" value="0">
  <input type="hidden" name="status" value="0" id="status">
  <input type="hidden" value="0" id="is_login">
  @endif
    <!-- <script src="University/js/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="University/js/audio.js"></script> -->
    <script>
      var is_login = $('#is_login').val();
      var loginUrl = $('[name=loginUrl]').val();
      $(document).ready(function () {
       
        $('.get_video').click(function () {
          var indexMius = $(this).attr('audio');
          audioPlay(indexMius);
        })
      })

      //播放
      function audioPlay(src){
         initAudioEvent(); 
          $("audio").prop("src",src)
          var audio = document.getElementsByTagName('audio')[0];
          audio.load();
          audio.oncanplay = function () {
               var audioPlayer = document.getElementById('audioPlayer');
               audioPlayer.click()
               updateProgress(audio)
          }
      }
      document.addEventListener('DOMContentLoaded', function () {
          // 设置音频文件名显示宽度
          var element = document.querySelector('.audio-right');
          var maxWidth = window.getComputedStyle(element, null).width;
          // 初始化音频控制事件
          var indexMius = $('#autoPlay').attr('src');
          audioPlay(indexMius);
      }, false);

      function initAudioEvent( audioPlayer = document.getElementById('audioPlayer') ) {
          var audio = document.getElementsByTagName('audio')[0];
          // var audioPlayer = document.getElementById('audioPlayer');
          // console.log(audioPlayer);
          // 点击播放/暂停图片时，控制音乐的播放与暂停  
          audioPlayer.addEventListener('click', function () {

              // 监听音频播放时间并更新进度条
              audio.addEventListener('timeupdate', function () {
                  updateProgress(audio);
              }, false);
              // 监听播放完成事件
              audio.addEventListener('ended', function () {
                  audioEnded();
              }, false);

              // 改变播放/暂停图片
              if (audio.paused) {
                  // 开始播放当前点击的音频
                  audio.play();
                  audioPlayer.src = '{{asset("University/images/pause.png")}}';
              } else {
                  audio.pause();
                  audioPlayer.src = '{{asset("University/images/play.png")}}';
              }

          }, false);

          // 点击进度条跳到指定点播放
          // PS：此处不要用click，否则下面的拖动进度点事件有可能在此处触发，此时e.offsetX的值非常小，会导致进度条弹回开始处（简直不能忍！！）
          var progressBarBg = document.getElementById('progressBarBg');
          progressBarBg.addEventListener('mousedown', function (event) {
              // 只有音乐开始播放后才可以调节，已经播放过但暂停了的也可以
              if (!audio.paused || audio.currentTime != 0) {
                  var pgsWidth = parseFloat(window.getComputedStyle(progressBarBg, null).width.replace('px', ''));
                  var rate = event.offsetX / pgsWidth;
                  audio.currentTime = audio.duration * rate;
                  updateProgress(audio);
              }
          }, false);

          // 拖动进度点调节进度
          dragProgressDotEvent(audio);
      }

      /**
       * 鼠标拖动进度点时可以调节进度
       * @param {*} audio
       */
      function dragProgressDotEvent(audio) {
          var dot = document.getElementById('progressDot');

          var position = {
              oriOffestLeft: 0, // 移动开始时进度条的点距离进度条的偏移值
              oriX: 0, // 移动开始时的x坐标
              maxLeft: 0, // 向左最大可拖动距离
              maxRight: 0 // 向右最大可拖动距离
          };
          var flag = false; // 标记是否拖动开始

          // 鼠标按下时
          dot.addEventListener('mousedown', down, false);
          dot.addEventListener('touchstart', down, false);

          // 开始拖动
          document.addEventListener('mousemove', move, false);
          document.addEventListener('touchmove', move, false);

          // 拖动结束
          document.addEventListener('mouseup', end, false);
          document.addEventListener('touchend', end, false);

          function down(event) {
              if (!audio.paused || audio.currentTime != 0) { // 只有音乐开始播放后才可以调节，已经播放过但暂停了的也可以
                  flag = true;

                  position.oriOffestLeft = dot.offsetLeft;
                  position.oriX = event.touches ? event.touches[0].clientX : event.clientX; // 要同时适配mousedown和touchstart事件
                  position.maxLeft = position.oriOffestLeft; // 向左最大可拖动距离
                  position.maxRight = document.getElementById('progressBarBg').offsetWidth - position.oriOffestLeft; // 向右最大可拖动距离

                  // 禁止默认事件（避免鼠标拖拽进度点的时候选中文字）
                  if (event && event.preventDefault) {
                      event.preventDefault();
                  } else {
                      event.returnValue = false;
                  }

                  // 禁止事件冒泡
                  if (event && event.stopPropagation) {
                      event.stopPropagation();
                  } else {
                      window.event.cancelBubble = true;
                  }
              }
          }

          function move(event) {
              if (flag) {
                  var clientX = event.touches ? event.touches[0].clientX : event.clientX; // 要同时适配mousemove和touchmove事件
                  var length = clientX - position.oriX;
                  if (length > position.maxRight) {
                      length = position.maxRight;
                  } else if (length < -position.maxLeft) {
                      length = -position.maxLeft;
                  }
                  var progressBarBg = document.getElementById('progressBarBg');
                  var pgsWidth = parseFloat(window.getComputedStyle(progressBarBg, null).width.replace('px', ''));
                  var rate = (position.oriOffestLeft + length) / pgsWidth;
                  audio.currentTime = audio.duration * rate;
                  updateProgress(audio);
              }
          }

          function end() {
              flag = false;
          }
      }

      /**
       * 更新进度条与当前播放时间
       * @param {object} audio - audio对象
       */
      function updateProgress(audio) {
          // console.log(audio.currentTime,'进度',audio.duration)
          var value = audio.currentTime / audio.duration;

          document.getElementById('progressBar').style.width = value * 100 + '%';
          document.getElementById('progressDot').style.left = value * 100 + '%';
          document.getElementById('audioCurTime').innerText = transTime(audio.currentTime);
          $('.audio-length-total').text(transTime(audio.duration))
      }

      /**
       * 播放完成时把进度调回开始的位置
       */
      function audioEnded() {
          document.getElementById('progressBar').style.width = 0;
          document.getElementById('progressDot').style.left = 0;
          document.getElementById('audioCurTime').innerText = transTime(0);
          document.getElementById('audioPlayer').src = '{{asset("University/images/play.png")}}';
      }

      /**
       * 音频播放时间换算
       * @param {number} value - 音频当前播放时间，单位秒
       */
      function transTime(value) {
          var time = "";
          var h = parseInt(value / 3600);
          value %= 3600;
          var m = parseInt(value / 60);
          var s = parseInt(value % 60);
          if (h > 0) {
              time = formatTime(h + ":" + m + ":" + s);
          } else {
              time = formatTime(m + ":" + s);
          }

          return time;
      }

      /**
       * 格式化时间显示，补零对齐
       * eg：2:4  -->  02:04
       * @param {string} value - 形如 h:m:s 的字符串
       */
      function formatTime(value) {
          var time = "";
          var s = value.split(':');
          var i = 0;
          for (; i < s.length - 1; i++) {
              time += s[i].length == 1 ? ("0" + s[i]) : s[i];
              time += ":";
          }
          time += s[i].length == 1 ? ("0" + s[i]) : s[i];

          return time;
      }

      //课程详情
      $('.class_list').each(function(index) {
        $('.class_list').eq(index).find(".list_img").click(function() {
          $(this).find("img").attr("src") == "{{asset('University/images/icon_fanhui.png')}}"  ?  $(this).find("img").attr("src","{{asset('University/images/icon_zhankai@2x.png')}}") : $(this).find("img").attr("src","{{asset('University/images/icon_fanhui.png')}}");
          $(this).next().toggle()
        })
      })

      //答案详情
      $('.topicbox').each(function(index) {
        $('.topicbox').eq(index).find(".ri").click(function() {
          $(this).parent().next().toggle()
        })
      })

      //tab1
      $(".tablea").find(".box:first").show();    //为每个BOX的第一个元素显示   
      $("#oranger li").on("mouseover",function(){ //给a标签添加事件  
        var index=$(this).index();  //获取当前a标签的个数  
        $(this).parent().parent().next().find(".box").hide().eq(index).show(); //返回上一层，在下面查找css名为box隐藏，然后选中的显示  
        $(this).addClass("hover").siblings().removeClass("hover"); //a标签显示，同辈元素隐藏  
      })

      //tab2
      var currentIndex=0;
      $(document).ready(function(){
        $(".tab-head ul li").click(function(){
          var index=$(this).index();
          if(currentIndex!=index) {
            currentIndex=index;
            $(this).removeClass("normal-li").addClass("selected-li");
            $(this).siblings().removeClass("selected-li").addClass("normal-li");
            var contents=$(".tab-content").find(".box2");
            $(contents[index]).show();
            $(contents[index]).siblings().hide();
          }
         
        });
      });

      //切换文稿
      $(".denlu img").click(function(){ 
         
          if(this.src.search("University/images/icon_wengao@2x.png")!=-1){ 
              this.src="{{asset('University/images/icon_guanbi@2x.png')}}"; 
              $("#centera").hide();
              $('.wengaobox').show();
          }else{ 
              this.src="{{asset('University/images/icon_wengao@2x.png')}}";
              $("#centera").show();
              $('.wengaobox').hide(); 
          } 
      })
      //切换页面
      $(".avideo").click(function(){
        location.href = $('#videoUrl').val();
      })

      //登陆
      $('.onlogin').click(function(){
        alert('尚未登陆！')
        window.location.href=loginUrl
      })

      //购买页面
      $('.onBuy').click(function(){
         $.ajax({
            url:"{{url('university/course/buy/id/'.$course->id)}}",
            type:'GET',
            dataType:'json',
            success:function(d){
              if (d.code == '002') {
                function onBridgeReady(){
                   WeixinJSBridge.invoke(
                      'getBrandWCPayRequest', {
                         "appId":d.data.appId,     //公众号名称，由商户传入     
                         "timeStamp":d.data.timeStamp,         //时间戳，自1970年以来的秒数     
                         "nonceStr":d.data.nonceStr, //随机串     
                         "package":d.data.package,     
                         "signType":"MD5",                //微信签名方式：     
                         "paySign":d.data.paySign //微信签名 
                      },
                      function(res){
                        
                        location.reload();
                      if(res.err_msg == "get_brand_wcpay_request:ok" ){
                        // 使用以上方式判断前端返回,微信团队郑重提示：
                        //res.err_msg将在用户支付成功后返回ok，但并不保证它绝对可靠。
                        alert('支付成功！');
                      } 
                   }); 
                }
                if (typeof WeixinJSBridge == "undefined"){
                   if( document.addEventListener ){
                       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                   }else if (document.attachEvent){
                       document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
                       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                   }
                }else{
                   onBridgeReady();
                }
              }else{
                console.log(d)
              }
            }
          })
      })

      //测试题点击
      $('.class_list').each(function(index) {
        $('.class_list').eq(index).find(".lis").click(function() {
          $(this).next().toggle()
        })
      })

      //提交测试题
      $('.submit').click(function(){
        var analysis = $(this).parent().find('.analysis');
        var id = 'form_'+$(this).attr('id');
        var form = new FormData(document.getElementById(id));
        $.ajax({
                url:"{{url('university/course/quizForm')}}",
                type:"post",
                data:form,
                processData:false,
                contentType:false,
                dataType:'json',
                success:function(d){
                    if (d.code == '002') {
                        analysis.each(function(index){         
                          analysis.eq(index).css('display','block');
                        })
                    }
                    console.log(d);
                },
            });

      })

     window.onbeforeunload= function(){
        getVideoTime(0);
        return '确认关闭';
     }

      //获取播放时间
      function getVideoTime(state){
        var _token = "{{csrf_token()}}"
        var now_time = $('#audioCurTime').text();
        var ls_id = $('[name=ls_id]').val();
        var is_login = $('#is_login').val();
        console.log(ls_id)
        console.log(now_time)
        if (is_login == 1) {

          $.ajax({
              url:"{{url('university/course/learningPut')}}",
              data:{_token:_token,ls_id:ls_id,now_time:now_time,state:state},
              type:'POST',
              dataType:'json',
              success:function(d){
                console.log(d)
              }
          })
        }else{
          console.log('未登录')
        }
      }

      //收藏
      $('.collect').click(function(){
        if (is_login ==1) {
          var imgObj = $(this);
          var status = $(this).attr('status') == 1 ? 0 : 1;
          $.ajax({
            url:"{{url('university/course/collect')}}",
            data:{_token:"{{csrf_token()}}",cid:"{{$course->id}}",status:0},
            type:'POST',
            dataType:'json',
            success:function(d){
              if (d.code == '002') {
                if (status==1) {
                  imgObj.attr('status',1);
                  imgObj.find('img').attr('src',"{{asset('University/images/icon_yishoucang@2x.png')}}")
                }else{
                  imgObj.attr('status',0)
                  imgObj.find('img').attr('src',"{{asset('University/images/icon_shoucang.png')}}")
                }
              }else{
                console.log(d)
              }
            }
          })
        }else{
          alert('尚未登陆');
          window.location.href = loginUrl;
        }
      })

  /*$('.get_video').click(function(){
    initAudioEvent()
 })*/


    </script>
@stop