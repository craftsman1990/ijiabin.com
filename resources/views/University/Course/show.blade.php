@extends('layouts.university')
@section('title','课程')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/audio.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/video.css')}}">
  <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 
  <div class="wrapper">
    <div class="bad-video">
      @if($course->oneType ==0 || Auth::guard('university')->check() && $course->isBuy==1)
      <video class="video_player" poster="{{asset($course->crosswise_cover)}}" webkit-playsinline style="object-fit:fill;">
          <source src="{{$course->oneVideo}}" type="video/mp4">            
          <p>设备不支持</p>
      </video>
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
    @if($course->oneType == 0 || Auth::guard('university')->check() && $course->isBuy == 1)
    <div class="wengaotab denlu"><img src="{{asset('University/images/icon_wengao@2x.png')}}" alt=""></div>
    <div class="wengaobox con_content">{{$course->oneContent}}</div>
    @else
    <div class="wengaotab onlogin"><img src="{{asset('University/images/icon_wengao@2x.png')}}" alt=""></div>
    @endif
  </div>
  {{-- 登陆地址 --}}
  <input type="hidden" name="loginUrl" value="{{url('university/login?source=4&yid='.$course->id)}}">
  <input type="hidden" id="audioUrl" value="{{url('university/course/audio/id/'.$course->id)}}">
  @if(Auth::guard('university')->check())
  <input type="hidden" name="ls_id" value="{{$course->oneId}}">
  <input type="hidden" name="status" value="{{$course->coll_status}}" id="status">
  <input type="hidden" value="1" id="is_login">
  @else
  <input type="hidden" name="ls_id" value="0">
  <input type="hidden" name="status" value="0" id="status">
  <input type="hidden" value="0" id="is_login">
  @endif
    <!-- <script type="text/javascript" src="{{asset('University/js/audio.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('University/js/mui.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{asset('University/js/bvd.js')}}"></script> -->
    @if($course->oneType ==0 || Auth::guard('university')->check() && $course->isBuy == 1)
    <script type="text/javascript">
      (function($) {
        var bvd = function(dom) {
          var that = this;
          $.ready(function() {
            //获取视频元素
            that.video = document.querySelector(dom || "video");
            //获取视频父元素
            that.vRoom = that.video.parentNode;
            //元素初始化
            that.initEm();
            //事件初始化
            that.initEvent();
            //记录信息
            that.initInfo();
            //当前播放模式 false 为 mini播放
            that.isMax = false;
          });
        };

        var pro = bvd.prototype;
        var status = document.getElementById('status').value;
        //记录信息
        pro.initInfo = function() {
          var that = this;
          //在onload状态下，offsetHeight才会获取到正确的值
          window.onload = function() {
            that.miniInfo = {
              //mini状态时的样式
              width: that.video.offsetWidth + "px",
              height: that.video.offsetHeight + "px",
              position: that.vRoom.style.position,
              transform: "translate(0,0) rotate(0deg)"
            };

            var info = [
                document.documentElement.clientWidth || document.body.clientWidth,
                document.documentElement.clientHeight || document.body.clientHeigth
              ],
              w = info[0],
              h = info[1],
              cha = Math.abs(h - w) / 2;

            that.maxInfo = {
              //max状态时的样式
              zIndex: 99,
              width: h + "px",
              height: w + "px",
              position: "fixed",
              transform: "translate(-" + cha + "px," + cha + "px) rotate(90deg)"
            };
          };
        };

        pro.initEm = function() {
          //先添加上一个按钮
          this.vtop = document.createElement("img");
          this.vtop.src = "{{asset('University/images/icon_zuojin@2x.png')}}";
          this.vtop.className = "vtop";
          this.vRoom.appendChild(this.vtop);

          // 暂停中间按钮
          this.simg = document.createElement("img");
          this.simg.src = "{{asset('University/images/pause.png')}}";
          this.simg.className = "pause";
          this.vRoom.appendChild(this.simg);

          //先添加下一个按钮
          this.vbelow = document.createElement("img");
          this.vbelow.src = "{{asset('University/images/icon_youjin@2x.png')}}";
          this.vbelow.className = "vbelow";
          this.vRoom.appendChild(this.vbelow);

          //先添加音频按钮
          this.vaudio = document.createElement("img");
          this.vaudio.src = "{{asset('University/images/icon_yinpin@2x.png')}}";
          this.vaudio.className = "vaudio";
          this.vRoom.appendChild(this.vaudio);

          //先添加收藏按钮
            this.vcollect1 = document.createElement("img");
            this.vcollect1.src = "{{asset('University/images/icon_yishoucang@2x.png')}}";
            this.vcollect1.className = "vcollect1";
            this.vRoom.appendChild(this.vcollect1);

            this.vcollect = document.createElement("img");
            this.vcollect.src = "{{asset('University/images/icon_vshoucang.png')}}";
            this.vcollect.className = "vcollect";
            this.vRoom.appendChild(this.vcollect);
            if (status != 1) {
              this.vcollect1.style.display = "none";
            }else{
              this.vcollect.style.display = "none";
            }
        
         
          //先添加播放按钮
          this.vimg = document.createElement("img");
          this.vimg.src = "{{asset('University/images/play2.png')}}";
          this.vimg.className = "vplay";
          this.vRoom.appendChild(this.vimg);

          //添加控制条
          this.vC = document.createElement("div");
          this.vC.classList.add("controls");
          this.vC.innerHTML =
            '<div><div class="progressBar"><span id="cricle"></span><div class="timeBar"></div></div></div><div><span class="current">00:00</span><span class="duration">00:00</span></div><div><img class="fill" src="' +
            "{{asset('University/images/icon_quanping@2x.png')}}" +
            '" alt=""></div>';
          this.vRoom.appendChild(this.vC);

        };

        pro.initEvent = function() {
          var that = this;

          var isScroll = false;
          var nowPage = "small";

          //切换音频
          this.vaudio.addEventListener("touchend", function() {

            location.href = document.getElementById('audioUrl').value;
          });

          //收藏按钮
            this.vcollect1.addEventListener('touchend',function(){
              $.ajax({
                  url:"{{url('university/course/collect')}}",
                  data:{_token:"{{csrf_token()}}",cid:"{{$course->id}}",status:0},
                  type:'POST',
                  dataType:'json',
                  success:function(d){
                    if (d.code == '002') {
                        that.vcollect1.style.display = 'none';
                        that.vcollect.style.display = 'block';
                        document.getElementById('status').value = '0';
                    }else{
                      console.log(2)
                    }
                  }
                })
            })
            this.vcollect.addEventListener('touchend',function(){
              var is_login = document.getElementById('is_login');
              if (is_login.value == 1) {
                $.ajax({
                  url:"{{url('university/course/collect')}}",
                  data:{_token:"{{csrf_token()}}",cid:"{{$course->id}}",status:1},
                  type:'POST',
                  dataType:'json',
                  success:function(d){
                    if (d.code == '002') {
                        that.vcollect.style.display = 'none';
                        that.vcollect1.style.display = 'block';
                        document.getElementById('status').value = '1';
                    }else{
                      console.log(2)
                    }
                  }
                })
              }else{
                var loginUrl = document.getElementsByName('loginUrl');
                window.location.href=loginUrl[0].value;
              }
            })  
          
          
          
          

          //上一个
          this.vtop.addEventListener('touchend',function(){
            console.log('上一个')
          })
          //下一个
          this.vbelow.addEventListener('touchend',function(){
            console.log('下一个')
          })
          //给播放按钮图片添加事件
          this.vimg.addEventListener("tap", function() {
            isScroll = false;
            that.video.play();
          });


          //获取到元数据
          this.video.addEventListener("loadedmetadata", function() {
            that.vDuration = this.duration;
            that.vC.querySelector(".duration").innerHTML = stom(that.vDuration);
            window.localStorage.setItem('total_time',stom(that.vDuration));
          });
         
          var allEvents = {};
          //视频播放事件
          this.video.addEventListener("play", function() {
            if (!isScroll) {
              that.vimg.style.display = "none";
              that.simg.style.display = "block";
              setTimeout(function() {
                that.simg.style.display = "none";
                that.vtop.style.display = "none";
                that.vbelow.style.display = "none";
                that.vaudio.style.display = "none";
                that.vcollect.style.display = "none";
                that.vC.classList.add("vhidden");
                that.vC.style.visibility = "hidden";
              });
            }

            var isThat = this;
            if (nowPage == "small") {
              // 拖动开始的X轴距离
              var startX = 0;
              // 距离左边的距离
              var leftAll = 0;
              // 进度条元素总长度
              var allW = parseFloat(
                getComputedStyle(that.vC.querySelector(".progressBar"), null)["width"]
              );
              var btnLeft = 0;

              function smallStart(e) {
                allEvents.touchstart = 1;
                isThat.pause();
                startX = e.touches[0].clientX;
                btnLeft = getComputedStyle(that.vC.querySelector("#cricle"), null)[
                  "left"
                ];
              }

              function smallEnd(e) {
                allEvents.touchend = 1;
                var overTime = stom((leftAll / allW) * isThat.duration);
                that.vC.querySelector(".current").innerHTML = overTime;
                var nowTime =
                  Math.round((leftAll / allW) * isThat.duration) - isThat.currentTime;
                that.setCurrentTime(nowTime);
                that.vimg.style.display = "none";
                that.simg.style.display = "block";
                isScroll = true;
                that.video.play();
              }

              function smallMove(e) {
                allEvents.touchmove = 1;
                var endFlo = e.touches[0].clientX - startX + parseFloat(btnLeft);
                if (endFlo > allW) {
                  endFlo = allW;
                } else if (endFlo < 0) {
                  endFlo = 0;
                }
                leftAll = endFlo;
                that.vC.querySelector(".timeBar").style.width = endFlo + "px";
                that.vC.querySelector("#cricle").style.left = endFlo + "px";
              }

              // 滚动条圆点拖动开始
              that.vC
                .querySelector("#cricle")
                .addEventListener("touchstart", smallStart, false);
              // 滚动条圆点拖动时
              that.vC
                .querySelector("#cricle")
                .addEventListener("touchmove", smallMove, false);
              // 滚动条圆点拖动结束
              that.vC
                .querySelector("#cricle")
                .addEventListener("touchend", smallEnd, false);
            } else {
              // 拖动开始的X轴距离
              var startY = 0;
              // 距离左边的距离
              var leftAll = 0;
              // 进度条元素总长度
              var allW = parseFloat(
                getComputedStyle(that.vC.querySelector(".progressBar"), null)["width"]
              );
              var btnLeft = 0;

              // 滚动条圆点拖动开始
              that.vC
                .querySelector("#cricle")
                .addEventListener("touchstart", function(e) {
                  isThat.pause();
                  startY = e.touches[0].clientY;
                  btnLeft = getComputedStyle(that.vC.querySelector("#cricle"), null)[
                    "left"
                  ];
                });
              // 滚动条圆点拖动时
              that.vC
                .querySelector("#cricle")
                .addEventListener("touchmove", function(e) {
                  var endFlo = e.touches[0].clientY - startY + parseFloat(btnLeft);
                  if (endFlo > allW) {
                    endFlo = allW;
                  } else if (endFlo < 0) {
                    endFlo = 0;
                  }
                  leftAll = endFlo;
                  that.vC.querySelector(".timeBar").style.width = endFlo + "px";
                  that.vC.querySelector("#cricle").style.left = endFlo + "px";
                });
              // 滚动条圆点拖动结束
              that.vC
                .querySelector("#cricle")
                .addEventListener("touchend", function(e) {
                  var overTime = stom((leftAll / allW) * isThat.duration);
                  that.vC.querySelector(".current").innerHTML = overTime;
                  var nowTime =
                    Math.round((leftAll / allW) * isThat.duration) -
                    isThat.currentTime;
                  that.setCurrentTime(nowTime);
                  that.vimg.style.display = "none";
                  that.simg.style.display = "block";
                  isScroll = true;
                  that.video.play();
                });
            }
          });

          //视频播放中事件
          this.video.addEventListener("timeupdate", function() {
            var currentPos = this.currentTime; //获取当前播放的位置
            //更新进度条
            var percentage = (100 * currentPos) / that.vDuration;
            that.vC.querySelector("#cricle").style.left = percentage + "%";
            that.vC.querySelector(".timeBar").style.width = percentage + "%";

            //更新当前播放时间
            that.vC.querySelector(".current").innerHTML = stom(currentPos);
            // console.log(stom(currentPos));
            var total_time = window.localStorage.getItem('total_time'); 
              if (stom(currentPos) == total_time) {
                  console.log('结束')
                  getVideoTime(1);
              }
              window.localStorage.setItem('now_time',stom(currentPos));
          });
          
          //视频点击暂停或播放事件
          this.video.addEventListener("tap", function() {
            if (this.paused || this.ended) {
              //暂停时点击就播放
              if (this.ended) {
                //如果播放完毕，就重头开始播放
                this.currentTime = 0;
              }
              isScroll = false;
              this.play();
            } else {
              //播放时点击就暂停
              // this.pause();
              var olthat = this;
              that.simg.addEventListener("tap", function() {
                that.vimg.style.display = "block";
                that.simg.style.display = "none";
                olthat.pause();
              });
              if (that.vtop.style.display == "none") {
                that.simg.style.display = "block";
                that.vtop.style.display = "block";
                that.vbelow.style.display = "block";
                that.vaudio.style.display = "block";
                that.vcollect.style.display = "block";
                that.vC.classList.remove("vhidden");
                that.vC.style.visibility = "visible";
              } else {
                that.simg.style.display = "none";
                that.vtop.style.display = "none";
                that.vbelow.style.display = "none";
                that.vaudio.style.display = "none";
                that.vcollect.style.display = "none";
                that.vC.classList.add("vhidden");
                that.vC.style.visibility = "hidden";
              }
            }
            
            console.log(stom(this.currentTime));
          });

          //暂停or停止
          this.video.addEventListener("pause", function() {
            that.simg.style.display = "none";
            that.vimg.style.display = "block";
            that.vtop.style.display = "block";
            that.vbelow.style.display = "block";
            that.vaudio.style.display = "block";
            that.vcollect.style.display = "block";
            that.vC.classList.remove("vhidden");
            that.vC.style.visibility = "visible";
            that.vCt && clearTimeout(that.vCt);
          });

          //转换音频
          this.vaudio.click(function() {
            
          });

          //视频手势右滑动事件
          this.eve("swiperight", function() {
            if (that.isMax) {
              return that.setVolume(0.2);
            }
            that.setCurrentTime(10);
          });

          //视频手势左滑动事件
          this.eve("swipeleft", function() {
            if (that.isMax) {
              return that.setVolume(-0.2);
            }
            that.setCurrentTime(-10);
          });

          //视频手势上滑动事件
          this.eve("swipeup", function() {
            if (that.isMax) {
              return that.setCurrentTime(-5);
            }
            that.setVolume(0.2);
          });

          //视频手势下滑动事件
          this.eve("swipedown", function() {
            if (that.isMax) {
              return that.setCurrentTime(5);
            }
            that.setVolume(-0.2);
          });

          this.vC.querySelector(".fill").addEventListener("tap", function() {
            //that.nativeMax();
            that.switch();
            if (nowPage == "small") {
              nowPage = "lage";
            } else {
              nowPage = "small";
            }
          });
        };

        //全屏 mini 两种模式切换
        pro.switch = function() {
          var vR = this.vRoom;
          //获取需要转换的样式信息
          var info = this.isMax ? this.miniInfo : this.maxInfo;
          for (var i in info) {
            vR.style[i] = info[i];
          }
          this.isMax = !this.isMax;
        };

        //使用原生支持的方式播放
        pro.nativeMax = function() {
          if (!window.plus) {
            //非html5+环境
            return;
          }
          if ($.os.ios) {
            console.log("ios");
            this.video.removeAttribute("webkit-playsinline");
          } else if ($.os.android) {
            console.log("android");
            var url = this.video.querySelector("source").src;
            var Intent = plus.android.importClass("android.content.Intent");
            var Uri = plus.android.importClass("android.net.Uri");
            var main = plus.android.runtimeMainActivity();
            var intent = new Intent(Intent.ACTION_VIEW);
            var uri = Uri.parse(url);
            intent.setDataAndType(uri, "video/*");
            main.startActivity(intent);
          }
        };

        //跳转视频进度 单位 秒
        pro.setCurrentTime = function(t) {
          this.video.currentTime += t;
        };
        //设置音量大小 单位 百分比 如 0.1
        pro.setVolume = function(v) {
          this.video.volume += v;
        };
        //切换播放地址
        pro.setUrl = function(nUrl) {
          var v = this.video;
          var source = v.querySelector("source");
          source.src = v.src = nUrl;
          source.type = "video/" + nUrl.split(".").pop();
          isScroll = false;
          v.play();
        };

        var events = {};

        //增加 或者删除事件    isBack 是否返回  这次添加事件时 被删除 的上一个 事件
        pro.eve = function(ename, callback, isBack) {
          var fn;
          if (callback && typeof callback == "function") {
            isBack && (fn = arguments.callee(ename));
            events[ename] = callback;
            this.video.addEventListener(ename, events[ename]);
            console.log("添加事件：" + ename);
          } else {
            fn = events[ename];
            fn && this.video.removeEventListener(ename, fn);
            console.log("删除事件：" + ename);
          }

          return fn;
        };

        function stom(t) {
          var m = Math.floor(t / 60);
          m < 10 && (m = "0" + m);
          return m + ":" + ((t % 60) / 100).toFixed(2).slice(-2);
        }

        var nv = null;
        $.bvd = function(dom) {
          return nv || (nv = new bvd(dom));
        };


      })(mui);
    </script>
    <script>
        var v = mui.bvd();
        // v.test();
    </script>
    @endif
    <script>
      $(document).ready(function () {
        
        //课程详情
        $('.class_list').each(function(index) {
          $('.class_list').eq(index).find(".list_img").click(function() {
            $(this).find("img").attr("src") == "{{asset('University/images/icon_fanhui.png')}}"  ?  $(this).find("img").attr("src","{{asset('University/images/icon_zhankai@2x.png')}}") : $(this).find("img").attr("src","{{asset('University/images/icon_fanhui.png')}}");
            $(this).next().toggle()
          })
        })
        $('.get_video').click(function(){
          $('.video_player').attr('src',$(this).attr('video'))

          $('.simg').css('display','block');
          $('.vtop').css('display','block');
          $('.vbelow').css('display','block');
          $('.vaudio').css('display','block');
          $('.vcollect').css('display','block');
          $('.vplay').css('display','block');
          $('.controls').remove('vhidden');
          $('.controls').css('visibility','visible');
          
          $('.con_content').text($(this).attr('content'))
          $('[name=ls_id]').val($(this).attr('ls_id'))     
          console.log($(this).attr('video'));
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

       /* $(".vaudio").click(function(){
          location.href ="audio.html"
        })*/
        //登陆
        $('.onlogin').click(function(){
          var href = $('[name=loginUrl]').val();
          alert('尚未登陆！')
          window.location.href=href
          
        })
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
                        alert('支付成功！');
                        location.reload();
                      if(res.err_msg == "get_brand_wcpay_request:ok" ){
                      // 使用以上方式判断前端返回,微信团队郑重提示：
                            //res.err_msg将在用户支付成功后返回ok，但并不保证它绝对可靠。

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

      /*function getCourseCollect(status){
        var ls_id = $('[name=ls_id').val();
        if (ls_id != 0) {
          var cid = "{{$course->id}}";
          var _token = "{{csrf_token()}}";
          var res = 0;
          $.ajax({
            url:"{{url('university/course/collect')}}",
            data:{_token:_token,cid:cid,status:status},
            type:'POST',
            dataType:'json',
            success:function(d){
              if (d.code == '002') {
                console.log(res)
                res += 1;
                console.log(res)
              }else{

                console.log(2)
                res += 2;
              }
            }
          })
        }else{
          console.log('未登录')
        }
        return res;
      }*/
    </script>
@stop