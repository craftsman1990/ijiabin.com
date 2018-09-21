@extends('layouts.home')
@section('title',$data['title'])
@section('content')
    <link rel="stylesheet" href={{asset("Home/css/index.css")}}>
    <link rel="stylesheet" href="{{asset('Home/css/swiper.min.css')}}">
	<style>
	.swiper-button-prev.swiper-button-white, .swiper-container-rtl .swiper-button-next.swiper-button-white{
		background-image:url("{{asset('Home/images/left.png')}}")
	}
	.swiper-button-next.swiper-button-white, .swiper-container-rtl .swiper-button-prev.swiper-button-white{
		background-image:url("{{asset('Home/images/right.png')}}")
	}
	</style>
	 <script src={{asset("Home/js/jquery.min.js")}}></script>
	<script>
		var wid = $(window).width();
		if(wid<750){
			window.location.href="{{url('mobile/index')}}"
		}
		$(window).resize(function () {          //当浏览器大小变化时
			var wida = $(window).width();
			if(wida<750){
				window.location.href="{{url('mobile/index')}}"
			}
		});
	</script>
    <!-- <div class="box_cover"></div> -->
    <div class="wrapper">
            @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <div class="main-left">
                	<div class="left-top">
	                	<!-- 广告 -->
	                    <div class="video swiper">
	                    	@if(config('hint.index_show_adv') ==1)
                            <!-- 视频 -->
	                    	<div class="vvideo">
								<video width="100%"  controls poster="{{$data['ind_vid_adv'][0]['cover']}}">
									<source src="{{$data['ind_vid_adv'][0]['video']}}" type="video/mp4">
									<source src="{{$data['ind_vid_adv'][0]['video']}}" type="video/ogg">
								</video>
								<h3 class="gallerytitle_v">{{$data['ind_vid_adv'][0]['title']}}</h3>
							</div>
	                        @else
                            <!-- 轮播 -->
	                        <div class="swiper-container">
	                            <div class="swiper-wrapper">
	                            @foreach($data['ind_sil_adv'] as $k=>$isa)
	                              <div class="swiper-slide">
                                    <a href="{{$isa['href']}}" target="_blank">
	                                  <img src="{{asset($isa['cover'])}}" alt="">
									  <h3 class="gallerytitle"><span>{{$isa['title']}}</span></h3>
                                    </a>
	                              </div>
	                              @endforeach
	                            </div>
	                            <div class="swiper-pagination"></div>
	                            <div class="swiper-button-prev swiper-button-white"></div> <!-- 白色 -->
	                            <div class="swiper-button-next swiper-button-white"></div>
	                        </div>
	                        @endif
	                    </div>
                        <!-- 右侧小广告哦 -->
	                    <div class="pic_list">
	                    	@foreach($data['ind_rig_adv'] as $k=>$ira)
	                        <p class="pic_lists">
	                            <a href="{{$ira['href']}}" target="_blank">
	                                <img src="{{asset($ira['cover'])}}" alt="">
                                    <i class="pic_tit">{{$ira['title']}}</i>
	                                <!-- <i class="pic_tit">{{$ira['title']}}<span>top</span>{{$k+1}}</i> -->
	                            </a>
	                        </p>
	                        @endforeach
	                    </div>
                	</div>
                    <!-- 分类及下面的文章 -->
                    <div class="main_tab">
                        <ul id="myTab" class="nav_bot nav-tabs">
                        	@foreach($data['cate'] as $k=>$cate)
                            <li class="{{$k==0 ? 'active' : ''}}">
                                <a href="#ios_{{$k}}" data-toggle="tab">{{$cate['cg_name']}}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div id="myTabContent" class="tab-content">
                        	@foreach($data['cate'] as $k=>$cate)
                            <div class="tab-pane fade {{$k==0 ? 'in active' : ''}}" id="ios_{{$k}}">
                            	<div class="cont_list">
	                            	@foreach($cate['content'] as $cont)
	                                <dl class="tab_list">
	                                    @if($cont->type ==1)
			                            <a href="{{url('article/id/'.$cont->id)}}" target="_blank">
			                            @else
			                            <a href="{{url('video/id/'.$cont->id)}}" target="_blank">
                                            <img class="bofang" src="{{asset('Home/images/bfang.png')}}" alt="">
			                            @endif
	                                        <dt>
	                                            <img src={{asset($cont->cover)}} alt="">
	                                        </dt>
	                                        <dd>
	                                            <h4 class="tab_tit">{{$cont->title}}</h4>
	                                            <p class="tab_con">{{$cont->intro}}</p>
	                                            <p class="tab_time">{{substr($cont->publish_time,0,10)}}</p>
	                                            <span>{{$cont->n_name}}</span>
	                                        </dd>
	                                    </a>
	                                </dl>
	                                @endforeach

                                </div>
                                @if($cate['content'])
                                <div class="btn_more">
									<button cgid="{{$cate['id']}}" page="{{config('hint.show_num')}}" class="ckgd" style="width: 100%;height:30px;text-align: center;line-height: 30px;font-size: 16px;color: #00f;">查看更多</button>
								</div>
                                @else
                                <p style="width: 100%;text-align: center;">没有相关内容</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="main-right">
                	<!-- 编辑精选 -->
                    <div class="rig-top">
                        <h3 class="rig_tit"><i class="icons"></i>编辑精选</h3>
                        @foreach($data['choi'] as $k=>$choi)
                        	
	                        <dl class="rig_dls">
	                        	@if($choi->type ==1)
	                            <a href="{{url('article/id/'.$choi->cho_id)}}" target="_blank">
	                            @else
	                            <a href="{{url('video/id/'.$choi->cho_id)}}" target="_blank">
	                            @endif
	                            	@if($k < 2)
	                                <dt class="dls_img">
	                                    <img src="{{asset($choi->cover)}}" alt="">
	                                </dt>
	                                <dd class="dls_tit">{{$choi->title}}</dd>
	                                @else
									<dt class="dls_imgs">
	                                    <img src="{{asset($choi->cover)}}" alt="">
	                                </dt>
	                                <dd class="dls_list">
	                                    <p>{{$choi->title}}</p>
	                                    <p class="dls_time">{{substr($choi->publish_time,0,10)}}</p>
	                                </dd>
	                                @endif
	                            </a>
	                        </dl>
                        @endforeach
                    </div>
                    <!-- 导师与学员 -->
                    <div class="rig-bot">
                        <h3 class="rig_tit"><i class="icons"></i>导师与学员</h3>
                        @foreach($data['tutor'] as $totur)
                        <dl class="tutor">
                            <a href="{{url('tutorStudent/detail/id/'.$totur->id)}}" target="_blank">
                                <dt class="tutor-img">
                                    <img src="{{asset($totur->head_pic)}}" alt="">
                                </dt>
                                <dd>
                                    <p class="tutor-name">{{$totur->name}}</p>
                                    <p class="tutor-txt">{{$totur->position}}</p>
                                    <p class="classify">{{$totur->type == 1 ? '导师' : '学员 '}}</p>
									<p class="tutor-con">{{$totur->intro}}</p>
                                </dd>
                            </a>
                        </dl>
                        @endforeach
                        <button  id="more" onClick="location.href='{{url('tutorStudent/oneId/3/secId/11')}}'">查看更多导师与学员</button>
                    </div>
                </div>
            </div>
    	</div>
    </div>
    <input type="hidden" name="url" value="{{url('getCategoryPage')}}">
    @include('layouts._footer')
    <script src="{{asset('Home/js/swiper.min.js')}}"></script>
    <script type="text/javascript">
        window.onload = function() {
            var mySwiper = new Swiper ('.swiper-container', {
				autoplay:3000,//自动滚动
				//loop:true,//循环
				//speed:1000,//滚动速度
				resistanceRatio : 0,
                pagination : '.swiper-pagination',
                paginationClickable :true,
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                autoplayDisableOnInteraction : false,    //注意此参数，默认为true
            });

			
        } 

        // setTimeout(function () {
        //     $(".box_cover").hide();
        // }, 1500);  
    </script>
    <script type="text/javascript">
    	var url = $('[name=url]').val();
    	$('.btn_more').click(function(){
    		var thisObj = $(this);
    		var cgid = thisObj.find('button').attr('cgid'),
    			page = thisObj.find('button').attr('page');
    		$.ajax({url:url,
    				type:'GET',
    				data:{cgid:cgid,page:page},
    				dataType:'json',
    				success:function(d){
    					thisObj.find('button').attr('page',parseInt(page)+{{config('hint.show_num')}});
    					var html = '';
    					console.log(d);
    					if (d != 0) {
    						$.each(d,function(index,item){
    							html += '<dl class="tab_list"><a href="'+item.url+'" target="_blank">';
                                if (item.type==2) {
                                    html += '<img class="bofang" src={{asset("Home/images/bfang.png")}} alt="">';
                                }
    							html += '<dt><img src="'+item.cover+'" alt=""></dt>';
    							html += '<dd><h4 class="tab_tit">'+item.title+'</h4>';
    							html += '<p class="tab_con">'+item.intro+'</p>';
    							html += '<p class="tab_time">'+item.publish_time.substr(0,10)+'</p><span>'+item.n_name+'</span></dd></a></dl>';
    						});
    					}else{
    						 html += '<p style="width: 100%;height:30px;text-align: center;line-height: 30px;font-size: 16px;color: #db9651;">已经到最底部了</p>';
    						 thisObj.hide();
    					}
    					thisObj.prev().append(html);
    				}})
    		
    	})
		
		if($(".swiper-slide").length==1){
            $(".swiper-button-prev").hide();
            $(".swiper-button-next").hide();
            $(".swiper-container").addClass("swiper-no-swiping")
        } 
    </script>
@stop