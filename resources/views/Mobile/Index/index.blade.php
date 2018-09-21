@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
  <link rel="stylesheet" href="{{asset('Mobile/css/index.css')}}">
  <script src={{asset("Home/js/jquery.min.js")}}></script>
  <script>
		var wid = $(window).width();
		if(wid>750){
			window.location.href="{{url('/')}}"
		}
		$(window).resize(function () {          //当浏览器大小变化时
			var wida = $(window).width();
			if(wida>750){
				window.location.href="{{url('/')}}"
			}
		});
	</script>
  <div data-role="page" id="pageone">
     @include('layouts.m_header')
  
    <div data-role="main" class="ui-content">
      <!-- 广告 -->
      <div class="banner">
        @if(config('hint.index_show_adv') ==1)
        <!-- 视频 -->
        <video controls poster="{{asset($data['ind_vid_adv'][0]['cover'])}}">
          <source src="{{$data['ind_vid_adv'][0]['video']}}" type="video/webm">
          <source src="{{$data['ind_vid_adv'][0]['video']}}" type="video/mp4">
        </video> 
        @else
        <!-- 轮播 -->
        <div class="swiper-container">
          <div class="swiper-wrapper">
            @foreach($data['ind_sil_adv'] as $isa)
            <div class="swiper-slide">
              <a href="{{$isa['href']}}" target="_blank">
              <img src="{{asset($isa['cover'])}}" />
              <h2 class="gallerytitle">{{$isa['title']}}</h2>
              </a>
            </div>
            @endforeach
           <!--  <div class="swiper-slide">
              <img src="{{asset('Mobile/images/banner.jpeg')}}" />
              <h2 class="gallerytitle">Angelababy弟弟曝光 五官精致颜值爆表</h2>
            </div>
            <div class="swiper-slide">
              <img src="{{asset('Mobile/images/banner.jpeg')}}" />
              <h2 class="gallerytitle">孙俪芈月造型亮相 清纯似少女</h2>
            </div> -->

          </div>
          <div class="swiper-pagination"></div>
        </div>
        @endif
      </div>

      <div id="centera">
        <!-- 分类 -->
        <div class="orangerb">
          <ul id="oranger"> 
            @foreach($data['cate'] as $k => $cate)
            <li class="{{$k==0 ? 'hover' : ''}}">{{$cate['cg_name']}}</li> 
            @endforeach
          </ul>
        </div>
        <div id="tablea" class="tablea">
          @foreach($data['cate'] as $cate)
          <div class="box">
            @foreach($cate['content'] as $key => $content)
              <dl class="list">
                @if($content->type==1)
                  <a href="{{url('mobile/article/id/'.$content->id)}}">
                @else
                  <a href="{{url('mobile/video/id/'.$content->id)}}">
                    <img class="bofang" src="{{asset('Mobile/images/bfang.png')}}" alt="">
                @endif
                    <dt class="list-img"><img src="{{asset($content->cover)}}" alt=""></dt>
                    <dd>
                      <p class="list-tit">{{$content->title}}</p>
                      <p class="list-but"><span class="sp-time">{{$content->publish_time}}</span><span class="sp-kind">{{$content->n_name}}</span></p>
                    </dd>
                  </a>
              </dl>
              <!-- 导师学员 -->
              @if($cate['id'] == 0 && $key == 2)
              <div class="tutor"> 
                <h4 class="tutor-tit">导师与学员<a href="{{url('mobile/tutorStudent/oneId/3/secId/11')}}">更多<img src="{{asset('Mobile/images//more_icon.png')}}" alt=""></a></h4>
                <div class="tutor-con">
                  
                  <div class="tutor-list"> 
                    @foreach($data['tutor'] as $tutor)
                      <dl class="tutor_dl" onclick="window.location.href='{{url('mobile/tsDetail/id/'.$tutor->id)}}'">
                        <dt class="tutor-img">
                            <img src="{{asset($tutor->head_pic)}}" alt="">
                        </dt>
                        <dd>
                            <p class="tutor-name">{{$tutor->name}}</p>
                            <p class="tutor-txt">{{$tutor->position}}</p>
                            <p class="classify">{{$tutor->type == 1 ? '导师' : '学员'}}</p>
                        </dd>
                      </dl>
                    @endforeach
                  </div>
                </div>
              </div>
              @endif
            @endforeach
          <div class="load" cid="{{$cate['id']}}" page="{{config('hint.m_show_num')}}">加载更多</div>
          </div>
          @endforeach
        </div>
      </div>
      
    </div>
  @include('layouts.m_footer')
  <input type="hidden" name="url" value="{{url('mobile/getIndexMessge')}}">
  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="{{asset('Mobile/js/swiper.min.js')}}"></script>
  <script src="{{asset('Mobile/js/iscroll.js')}}"></script>
  <script src="{{asset('Mobile/js/index.js')}}"></script>
  <script>
    $(document).ready(function(){
      var mySwiper = new Swiper(".swiper-container",{
                    autoplay:2000,
                    loop:true,//循环
                    pagination : '.swiper-pagination',
                    paginationClickable :true,
                    observer:true,//修改swiper自己或子元素时，自动初始化swiper
                    observeParents:true,//修改swiper的父元素时，自动初始化swiper
                })

      $(window).scroll(function(){
        var scrT = $(window).scrollTop();
        var offT = $("#oranger").offset().top;
        var Hhei = $('.ui-header').height();
        var hei = $("#oranger").height();
        var boxT = $(".box").offset().top;
        
        if(scrT>=offT-Hhei-hei){
          $(".orangerb").addClass('oranger-hei');
        }
        if(offT<=220){
          $(".orangerb").removeClass('oranger-hei');
        }
      })
    });
    
    $("#oranger li a").on("mouseover",function(){ //给li标签添加事件  
      var index=$(this).parent().index();  //获取当前li标签的个数  
      $(this).parent().parent().next().find(".box").hide().eq(index).show(); //返回上一层，在下面查找css名为box隐藏，然后选中的显示  
      $(this).addClass("hover").parent().siblings().children().removeClass("hover"); //a标签样式
    })
    $("#pagehide").click(function(){
      $("#myPanel").toggle()
    })
    $('#myPanel').click(function(){
      $("#myPanel").hide();
    })

    url = $('[name=url]').val();
    $('.load').click(function(){
      var thisObj = $(this);
      var cid = thisObj.attr('cid'),
          page = thisObj.attr('page');
      $.ajax({
        url : url,
        type : 'GET',
        data : {cid:cid,page:page},
        dataType : 'json',
        success : function(d){
          thisObj.attr('page',parseInt(page)+{{config('hint.m_show_num')}});
          var html = '';
          if (d !=0) {
            $.each(d,function(index,item){
                html += '<dl class="list"><a href="'+item.url+'">';
                html += '<dt class="list-img"><img src="'+item.cover+'" alt=""></dt>';
                html += '<dd><p class="list-tit">'+item.title+'</p>';
                html += '<p class="list-but"><span class="sp-time">'+item.publish_time+'</span>';
                html += '<span class="sp-kind">'+item.n_name+'</span></p></dd></a></dl>';
              });
          }else{
            html += '<p style="width:100%;text-align:center;color:#999999;margin-top:.1rem">已经到底部了</p>';
            thisObj.hide();
          }
          thisObj.prev().after(html);
        },
        error : function(e){
          console.log(e);
        }
      })
    })
  </script>
@stop