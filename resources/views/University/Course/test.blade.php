@extends('layouts.university')
@section('title','课程')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/audio.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/video.css')}}">
  <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 
  <style>
    #myvideo{
      width:100%;
      height:auto;
    }
  </style>
  <div class="wrapper">
    <div class="bad-video">
      @if($course->oneType ==0 || Auth::guard('university')->check() && $course->isBuy==1)
        <video  id="myvideo" src="{{$course->oneVideo}}"  controls="controls" autoplay="autoplay"></video>
      @else
      <div class="nopay">
          <p class="nopay_com">开通后才能继续学习~</p>
          @if(Auth::guard('university')->check())
          <button class="nopay_btn onBuy">立即开通</button>
          @else
          <button class="nopay_btn onlogin">立即开通</button>
          @endif
          <img src="{{asset('University/images/icon_yinpin@2x.png')}}" class="vaudio"/>
          <img src="{{asset('University/images/icon_vshoucang.png')}}" class="vcollect onlogin"/>
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
                  <div class="class_list get_video" video="{{$content->video}}" content="{{$content->content}}" ls_id="{{$content->learning->id}}">
                  @else  
                  <div class="class_list get_video" video="{{$content->video}}" content="{{$content->content}}" ls_id="0">
                  @endif  
                    <p class="list_name">
                      <span class="col">{{$content->chapter}} {{$content->title}}</span>
                      <!-- <span><img class="bianj" src="{{asset('University/images/icon_bianji@2x2.png')}}" alt=""></span> -->
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
                
                <!-- <div class="class_list">
                  <p class="list_name">
                    <span>03   人力资源管理教育预告片</span>
                    <span><img src="{{asset('University/images/icon_suo@2x.png')}}" alt=""></span>
                  </p>
                  <p class="list_time">11:05</p>
                  <p class="list_img"><img src="{{asset('University/images/icon_zhankai@2x.png')}}" alt=""></p>
                </div> -->
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
        <button class="btn onBuy">开通课程 | ￥{{$course->price}}</button>
        @endif
      @endif
    @else
        <button class="btn onlogin">开通课程 | ￥{{$course->price}}</button>
    @endif
    <div class="hint">购买后才能继续学习</div>
   
    <div class="wengaotab"><img src="{{asset('University/images/icon_wengao@3x.png')}}" alt=""></div>
    <div class="wengaobox con_content">{{$course->oneContent}}</div>
   
  </div>
  {{-- 登陆地址 --}}
  <input type="hidden" name="loginUrl" value="{{url('university/quickLogin?source=4&yid='.$course->id)}}">
  <input type="hidden" id="audioUrl" value="{{url('university/course/audio/id/'.$course->id)}}">
  @if(Auth::guard('university')->check())
  <div class="cli">
    <p class="sc collect" status="{{$course->coll_status}}">
      @if($course->coll_status)
      <img src="{{asset('University/images/icon_shoucangdian@2x.png')}}">
      @else
      <img src="{{asset('University/images/icon_shoucang@3x.png')}}">
      @endif
    </p>
    @if($course->oneType == 0 || $course->isBuy == 1)
    <p class="wb draft"><img src="{{asset('University/images/icon_wengao@2x.png')}}"></p>
    @else
    <p class="wb notBy"><img src="{{asset('University/images/icon_wengao@2x.png')}}"></p>
    @endif
    <p class="yp"><img src="{{asset('University/images/icon_yinpin@2x.png')}}"></p>
  </div>
  <input type="hidden" name="ls_id" value="{{$course->oneId}}">
  <input type="hidden" name="status" value="{{$course->coll_status}}" id="status">
  <input type="hidden" value="1" id="is_login">
  @else
  <div class="cli">
    <p class="sc onlogin"><img src="{{asset('University/images/icon_shoucang@3x.png')}}"></p>
    @if($course->oneType == 0)
    <p class="wb draft"><img src="{{asset('University/images/icon_wengao@2x.png')}}"></p>
    @else
    <p class="wb onlogin"><img src="{{asset('University/images/icon_wengao@2x.png')}}"></p>
    @endif
    <p class="yp"><img src="{{asset('University/images/icon_yinpin@2x.png')}}"></p>
  </div>
  <input type="hidden" name="ls_id" value="0">
  <input type="hidden" name="status" value="0" id="status">
  <input type="hidden" value="0" id="is_login">
  @endif
   <script language="javascript">
      $(document).ready(function(){
            play(vList[curr]);
      });
      var videoOBJ = $('.get_video');
      var vList = new Array();
      for (var i = 0; i <= videoOBJ.length - 1; i++) {
        vList[i] = videoOBJ[i].getAttribute('video')
      }
      // console.log(vList);
      var vLen = vList.length;
      var curr = 0;
      var video = document.getElementById("myvideo");    
      video.addEventListener("ended", function(){
        //    alert("已播放完成，继续下一个视频");
        play(vList[curr]);
      });
      function play(src) {
        video.src = src;
        video.load();
        video.play();
        curr++;
        if(curr >= vLen){
            curr = 0; //重新循环播放
        }
      }
    </script>
    <script>
      $(document).ready(function () {  
        var is_login = $('#is_login').val();
        var loginUrl = $('[name=loginUrl]').val();      
        //课程详情
        $('.class_list').each(function(index) {
          $('.class_list').eq(index).find(".list_img").click(function() {
            $(this).find("img").attr("src") == "{{asset('University/images/icon_fanhui.png')}}"  ?  $(this).find("img").attr("src","{{asset('University/images/icon_zhankai@2x.png')}}") : $(this).find("img").attr("src","{{asset('University/images/icon_fanhui.png')}}");
            $(this).next().toggle()
          })
        })
        //目录切换
        $('.get_video').click(function(){
          play($(this).attr('video'));
          $('.con_content').text($(this).attr('content'))
          $('[name=ls_id]').val($(this).attr('ls_id'))     
          // console.log($(this).attr('video'));
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

         //按钮切换 
        $(".wengaotab img").click(function(){ 
          console.log(this.src.search("{{asset('University/images/icon_wengao@3x.png')}}")!=-1)
          if(this.src.search("{{asset('University/images/icon_wengao@3x.png')}}")!=-1){ 
            $('.cli').toggle();
          }else{ 
            this.src="{{asset('University/images/icon_wengao@3x.png')}}";
            $("#centera").show();
            $('.wengaobox').hide(); 
          } 
        })
        //收藏
        $('.collect').click(function(){
          if (is_login ==1) {
            var imgObj = $(this);
            var status = $(this).attr('status') == 1 ? 0 : 1;
            $.ajax({
              url:"{{url('university/course/collect')}}",
              data:{_token:"{{csrf_token()}}",cid:"{{$course->id}}",status:status},
              type:'POST',
              dataType:'json',
              success:function(d){
                console.log(d)
                if (d.code == '002') {
                  if (status==1) {
                    imgObj.attr('status',1);
                    imgObj.find('img').attr('src',"{{asset('University/images/icon_shoucangdian@2x.png')}}")
                  }else{
                    imgObj.attr('status',0)
                    imgObj.find('img').attr('src',"{{asset('University/images/icon_shoucang@3x.png')}}")
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
        //切换文稿
        $(".draft img").click(function(){
          if($(".wengaotab img").attr("src","{{asset('University/images/icon_wengao@3x.png')}}")){ 
            $(".wengaotab img").attr("src","{{asset('University/images/icon_guanbi@2x.png')}}"); 
            $("#centera").hide();
            $('.wengaobox').show();
            $('.cli').hide();
          }
        })
        //文稿未购买
        $('.notBy').click(function(){
          $(".cover1").css("display","block");
            setTimeout(function(){//定时器 
              $(".cover1").css("display","none");
            },3000);
        })

        //切换页面
        $(".yp").click(function(){
          location.href = $('#audioUrl').val();
        })
        //登陆
        $('.onlogin').click(function(){
          // var href = $('[name=loginUrl]').val();
          alert('尚未登陆！')
          window.location.href=loginUrl
        })
        //购买页面
        $('.onBuy').click(function(){
          // window.location.href="{{url('university/course/buy/id/'.$course->id)}}"
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
        // return '确认关闭';
     }

      function getVideoTime(state){
        var _token = "{{csrf_token()}}"
        var now_time = window.localStorage.getItem('now_time');
        var ls_id = $('[name=ls_id]').val();
        var is_login = $('#is_login').val();
        console.log(ls_id)
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

     
    </script>
@stop