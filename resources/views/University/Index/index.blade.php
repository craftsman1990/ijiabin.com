@extends('layouts.university')
@section('title','发现')
@section('content')
	<link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/all.css')}}">
	<link rel="stylesheet" href="{{asset('University/css/index.css')}}">

	<style>
	  /* 清除标签默认边距 */
	  body,ul,li,ol,img {
	    margin: 0;
	    padding: 0;
	  }
	  
	  /* 清除 ul 等标签前面的“小圆点” */
	  ul,li,ol {
	    list-style-type: none;
	  }

	  /* 图片自适应 */
	  .box img,.box2 img {
	    width: 100%;
	    height: 200px;
	    border: none;
	    /* ie8 */
	    display: block;
	    -ms-interpolation-mode: bicubic;
	    /*为了照顾ie图片缩放失真*/
	  }

	  /* 轮播图最外层盒子 */
	  .carousel,.carousel2 {
	    position: relative;
	    overflow: hidden;
	  }

	  .carousel ul,.carousel2 ul {
	    /* 这个高度需要在JS里面动态添加 */
	  }

	  .carousel ul li,.carousel2 ul li {
	    position: absolute;
	    width: 100%;
	    left: 0;
	    top: 0;
	    /* 使用 transform:translaX(300%) 暂时将 li 移动到屏幕外面去*/
	    -webkit-transform: translateX(300%);
	    transform: translateX(300%);
	  }

	  /* 小圆点盒子 */
	  .carousel .points,.carousel2 .points2 {
	    /* 未知宽度的盒子，使用 absolute 定位，结合 transform 的方式进行居中 */
	    position: absolute;
	    left: 50%;
	    bottom: 10px;
	    transform: translateX(-50%);
	  }

	  /* 小圆点 */
	  .carousel .points li,.carousel2 .points2 li {
	    width:.05rem;
	    height:.025rem;
	    float:left;
	    border-radius:.03rem;
	    background:rgba(125,125,125,1);
	    margin-left:5px;
	  }

	  /* 选中小圆点的样式类 */
	  .carousel .points li.active,.carousel2 .points2 li.active {
	    width:.08rem;
	    height:.025rem;
	    float:left;
	    border-radius:.03rem;
	    background:rgba(229,229,229,1);
	    margin-left:5px;
	  }
	</style>
	
	<div class="wrapper">
		<div class="banner">
		  <section class="carousel">
		    <ul class="box">
		    	@foreach($adver as $ad)
		      	<li><a href="{{$ad['href']}}"><img src="{{asset($ad['cover'])}}" alt=""></a></li>
		      	@endforeach
		    </ul>
		    <ol class="points"></ol>
		  </section>
		  <!-- <video controls>
		    <source src="somevideo.webm" type="video/webm">
		    <source src="somevideo.mp4" type="video/mp4">
		  </video>  -->
		</div>
		<div class="classify">
		  <div class="classify1" onclick="window.location.href='{{url("university/jbp")}}'">
		    <img src="{{asset('University/images/jiabinpai@2x.png')}}" alt="">
		  </div>
		  <div class="classify1" onclick="window.location.href='{{url("university/gjkc")}}'">
		    <img src="{{asset('University/images/guojikecheng@2x.png')}}" alt="">
		  </div>
		  <div class="classify1" onclick="window.location.href='{{url("university/courseCategory/cgid/1")}}'">
		    <img src="{{asset('University/images/gongkaike@2x.png')}}" alt="">
		  </div>

		</div>
		{{--议题--}}
		<div class="diacuss_box">
		  <h4 class="dia_tit">
		  	<em></em>今日议题
		  	<img src="{{asset('University/images/icon_gengduo@2x.png')}}" alt="" onclick="window.location.href='{{url("university/discussion/detail/id/".$discussion->id)}}'">
		  </h4>
		  <h3 class="dia_topic">{{$discussion->title}}</h3>
		  <p class="dia_label">出题人：{{$discussion->author}}</p>
		  <p class="dia_con">{{strip_tags($discussion->content)}}</p>
		  @if($comment)
		  <div class="observer" onclick="window.location.href='{{url("university/discussion/commentDetail/id/".$comment->id)}}'">
		    <p class="ob_name"><img src="{{$comment->user_pic}}" alt="">{{$comment->user_name}}</p>
		    <p class="ob_con">{{$comment->content}}</p>
		  </div>
		  @endif
		</div>
		<div class="boutique_box">
		  <h4 class="bou_tit">精品课</h4>
		  <div class="banner2">
		    <section class="carousel2">
		      <ul class="box2">
		      	@foreach($course['boutique'] as $bout)
		        <li><a href="{{url('university/course/show/id/'.$bout->id)}}"><img src="{{url($bout->crosswise_cover)}}" alt=""></a></li>
		        @endforeach
		      </ul>
		      <ol class="points2"></ol>
		    </section>
		    <!-- <video controls>
		      <source src="somevideo.webm" type="video/webm">
		      <source src="somevideo.mp4" type="video/mp4">
		    </video>  -->
		  </div>
		</div>
		<div class="business_box">
		  <h4 class="bus_tit">商业案例课</h4>
		  @foreach($course['business'] as $busi)
		  <dl class="bus_list">
		      <a href="{{url('university/course/show/id/'.$busi->id)}}">
		        <dt class="list-img"><img src="{{asset($busi->lengthways_cover)}}" alt=""></dt>
		        <dd>
		          <p class="list-tit">{{$busi->name}}</p>
		          <p class="list_int">{{$busi->teacher}}<span>{{$busi->professional}}</span></p>
		          <p class="list-but"><img src="{{asset('University/images/icon_liulan@2x.png')}}" alt="">{{$busi->looks}}</p>
		        </dd>
		      </a>
		  </dl>
		  @endforeach
		</div>
	</div>

  	<footer class="foot">
	    <a href="{{url('university/index')}}" class="Imgbox one clo"><img src="{{asset('University/images/icon_faxiandianliang@2x.png')}}" />发现</a>
	    <a href="{{url('university/discussion/index')}}" class="Imgbox"><img src="{{asset('University/images/icon_meiriyiyi@2x.png')}}" />议一议</a>
	    <a href="{{url('university/my/index')}}" class="Imgbox"><img src="{{asset('University/images/icon_wode@2x.png')}}" />我的</a>
  	</footer>
	<script>
	  window.onload = function () {
	    var carousel2 = document.querySelector('.carousel2');
	    var carouselUl2 = carousel2.querySelector('.box2');
	    var carouselLis2 = carouselUl2.querySelectorAll('li');
	    var points2 = carousel2.querySelector('.points2');
	    // 屏幕的宽度
	    var screenWidth2 = document.documentElement.offsetWidth;
	    var timer2 = null;

	    // 设置 ul 的高度
	    carouselUl2.style.height = carouselLis2[0].offsetHeight + 'px';

	    // 动态生成小圆点
	    for (var i = 0; i < carouselLis2.length; i++) {
	      var li2 = document.createElement('li');
	      if (i == 0) {
	        li2.classList.add('active');
	      }
	      points2.appendChild(li2);
	    }

	    // 初始三个固定的位置
	    var left2 = carouselLis2.length - 1;
	    var center2 = 0;
	    var right2 = 1;

	    // 归位（多次使用，封装成函数）
	    setTransform2();

	    // 调用定时器
	    timer2 = setInterval(showNext2, 2000);

	    // 分别绑定touch事件
	    var startX2 = 0; // 手指落点
	    var startTime2 = null; // 开始触摸时间
	    carouselUl2.addEventListener('touchstart', touchstartHandler2); // 滑动开始绑定的函数 touchstartHandler2
	    carouselUl2.addEventListener('touchmove', touchmoveHandler2); // 持续滑动绑定的函数 touchmoveHandler2
	    carouselUl2.addEventListener('touchend', touchendHandeler2); // 滑动结束绑定的函数 touchendHandeler2

	    // 轮播图片切换下一张
	    function showNext2() {
	      // 轮转下标
	      left2 = center2;
	      center2 = right2;
	      right2++;
	      //　极值判断
	      if (right2 > carouselLis2.length - 1) {
	        right2 = 0;
	      }
	      //添加过渡（多次使用，封装成函数）
	      setTransition2(1, 1, 0);
	      // 归位
	      setTransform2();
	      // 自动设置小圆点
	      setPoint2();
	    }

	    // 轮播图片切换上一张
	    function showPrev() {
	      // 轮转下标
	      right2 = center2;
	      center2 = left2;
	      left2--;
	      //　极值判断
	      if (left2 < 0) {
	        left2 = carouselLis2.length - 1;
	      }
	      //添加过渡
	      setTransition2(0, 1, 1);
	      // 归位
	      setTransform2();
	      // 自动设置小圆点
	      setPoint2();
	    }

	    // 滑动开始
	    function touchstartHandler2(e) {
	      // 清除定时器
	      clearInterval(timer2);
	      // 记录滑动开始的时间
	      startTime2 = Date.now();
	      // 记录手指最开始的落点
	      startX2 = e.changedTouches[0].clientX;
	    }
	    // 滑动持续中
	    function touchmoveHandler2(e) {
	      // 获取差值 自带正负
	      var dx = e.changedTouches[0].clientX - startX2;
	      // 干掉过渡
	      setTransition2(0, 0, 0);
	      // 归位
	      setTransform2(dx);
	    }
	    //　滑动结束
	    function touchendHandeler2(e) {
	      // 在手指松开的时候，要判断当前是否滑动成功
	      var dx = e.changedTouches[0].clientX - startX2;
	      // 获取时间差
	      var dTime = Date.now() - startTime2;
	      // 滑动成功的依据是滑动的距离（绝对值）超过屏幕的三分之一 或者滑动的时间小于300毫秒同时滑动的距离大于30
	      if (Math.abs(dx) > screenWidth2 / 3 || (dTime < 300 && Math.abs(dx) > 30)) {
	        // 滑动成功了
	        // 判断用户是往哪个方向滑
	        if (dx > 0) {
	          // 往右滑 看到上一张
	          showPrev();
	        } else {
	          // 往左滑 看到下一张
	          showNext2();
	        }
	      } else {
	        // 添加上过渡
	        setTransition2(1, 1, 1);
	        // 滑动失败了
	        setTransform2();
	      }

	      // 重新启动定时器
	      clearInterval(timer2);
	      // 调用定时器
	      timer2 = setInterval(showNext2, 2000);
	    }
	    // 设置过渡
	    function setTransition2(a, b, c) {
	      if (a) {
	        carouselLis2[left2].style.transition = 'transform 1s';
	      } else {
	        carouselLis2[left2].style.transition = 'none';
	      }
	      if (b) {
	        carouselLis2[center2].style.transition = 'transform 1s';
	      } else {
	        carouselLis2[center2].style.transition = 'none';
	      }
	      if (c) {
	        carouselLis2[right2].style.transition = 'transform 1s';
	      } else {
	        carouselLis2[right2].style.transition = 'none';
	      }
	    }

	    //　封装归位
	    function setTransform2(dx) {
	      dx = dx || 0;
	      carouselLis2[left2].style.transform = 'translateX(' + (-screenWidth2 + dx) + 'px)';
	      carouselLis2[center2].style.transform = 'translateX(' + dx + 'px)';
	      carouselLis2[right2].style.transform = 'translateX(' + (screenWidth2 + dx) + 'px)';
	    }
	    // 动态设置小圆点的active类
	    var pointsLis2 = points2.querySelectorAll('li');

	    function setPoint2() {
	      for (var i = 0; i < pointsLis2.length; i++) {
	        pointsLis2[i].classList.remove('active');
	      }
	      pointsLis2[center2].classList.add('active');
	    }



	    var carousel = document.querySelector('.carousel');
	    var carouselUl = carousel.querySelector('.box');
	    var carouselLis = carouselUl.querySelectorAll('li');
	    var points = carousel.querySelector('.points');
	    // 屏幕的宽度
	    var screenWidth = document.documentElement.offsetWidth;
	    var timer = null;

	    // 设置 ul 的高度
	    carouselUl.style.height = carouselLis[0].offsetHeight + 'px';

	    // 动态生成小圆点
	    for (var i = 0; i < carouselLis.length; i++) {
	      var li = document.createElement('li');
	      if (i == 0) {
	        li.classList.add('active');
	      }
	      points.appendChild(li);
	    }

	    // 初始三个固定的位置
	    var left = carouselLis.length - 1;
	    var center = 0;
	    var right = 1;

	    // 归位（多次使用，封装成函数）
	    setTransform();

	    // 调用定时器
	    timer = setInterval(showNext, 2000);

	    // 分别绑定touch事件
	    var startX = 0; // 手指落点
	    var startTime = null; // 开始触摸时间
	    carouselUl.addEventListener('touchstart', touchstartHandler); // 滑动开始绑定的函数 touchstartHandler
	    carouselUl.addEventListener('touchmove', touchmoveHandler); // 持续滑动绑定的函数 touchmoveHandler
	    carouselUl.addEventListener('touchend', touchendHandeler); // 滑动结束绑定的函数 touchendHandeler

	    // 轮播图片切换下一张
	    function showNext() {
	      // 轮转下标
	      left = center;
	      center = right;
	      right++;
	      //　极值判断
	      if (right > carouselLis.length - 1) {
	        right = 0;
	      }
	      //添加过渡（多次使用，封装成函数）
	      setTransition(1, 1, 0);
	      // 归位
	      setTransform();
	      // 自动设置小圆点
	      setPoint();
	    }

	    // 轮播图片切换上一张
	    function showPrev() {
	      // 轮转下标
	      right = center;
	      center = left;
	      left--;
	      //　极值判断
	      if (left < 0) {
	        left = carouselLis.length - 1;
	      }
	      //添加过渡
	      setTransition(0, 1, 1);
	      // 归位
	      setTransform();
	      // 自动设置小圆点
	      setPoint();
	    }

	    // 滑动开始
	    function touchstartHandler(e) {
	      // 清除定时器
	      clearInterval(timer);
	      // 记录滑动开始的时间
	      startTime = Date.now();
	      // 记录手指最开始的落点
	      startX = e.changedTouches[0].clientX;
	    }
	    // 滑动持续中
	    function touchmoveHandler(e) {
	      // 获取差值 自带正负
	      var dx = e.changedTouches[0].clientX - startX;
	      // 干掉过渡
	      setTransition(0, 0, 0);
	      // 归位
	      setTransform(dx);
	    }
	    //　滑动结束
	    function touchendHandeler(e) {
	      // 在手指松开的时候，要判断当前是否滑动成功
	      var dx = e.changedTouches[0].clientX - startX;
	      // 获取时间差
	      var dTime = Date.now() - startTime;
	      // 滑动成功的依据是滑动的距离（绝对值）超过屏幕的三分之一 或者滑动的时间小于300毫秒同时滑动的距离大于30
	      if (Math.abs(dx) > screenWidth / 3 || (dTime < 300 && Math.abs(dx) > 30)) {
	        // 滑动成功了
	        // 判断用户是往哪个方向滑
	        if (dx > 0) {
	          // 往右滑 看到上一张
	          showPrev();
	        } else {
	          // 往左滑 看到下一张
	          showNext();
	        }
	      } else {
	        // 添加上过渡
	        setTransition(1, 1, 1);
	        // 滑动失败了
	        setTransform();
	      }

	      // 重新启动定时器
	      clearInterval(timer);
	      // 调用定时器
	      timer = setInterval(showNext, 2000);
	    }
	    // 设置过渡
	    function setTransition(a, b, c) {
	      if (a) {
	        carouselLis[left].style.transition = 'transform 1s';
	      } else {
	        carouselLis[left].style.transition = 'none';
	      }
	      if (b) {
	        carouselLis[center].style.transition = 'transform 1s';
	      } else {
	        carouselLis[center].style.transition = 'none';
	      }
	      if (c) {
	        carouselLis[right].style.transition = 'transform 1s';
	      } else {
	        carouselLis[right].style.transition = 'none';
	      }
	    }

	    //　封装归位
	    function setTransform(dx) {
	      dx = dx || 0;
	      carouselLis[left].style.transform = 'translateX(' + (-screenWidth + dx) + 'px)';
	      carouselLis[center].style.transform = 'translateX(' + dx + 'px)';
	      carouselLis[right].style.transform = 'translateX(' + (screenWidth + dx) + 'px)';
	    }
	    // 动态设置小圆点的active类
	    var pointsLis = points.querySelectorAll('li');

	    function setPoint() {
	      for (var i = 0; i < pointsLis.length; i++) {
	        pointsLis[i].classList.remove('active');
	      }
	      pointsLis[center].classList.add('active');
	    }
	  }
	</script>
  
    
@stop
