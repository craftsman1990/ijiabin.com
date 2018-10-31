@extends('layouts.mobile')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Mobile/css/two-list.css')}}">
    <div data-role="page" id="pageone">
       @include('layouts.m_header')

      <div class="centera">
        <ul id="oranger"> 
          @foreach($data['towNav'] as $towNav)
          <li typeid="{{$towNav->id}}" dj="{{$towNav->id==$data['secId'] ? '1' : '0'}}">
            <a class="{{$towNav->id == $data['secId'] ? 'hover' : ''}}" href="javascript:;" >{{$towNav->n_name}}</a> 
          </li>
          @endforeach
        </ul>
        <div id="tablea" class="tablea">
          @foreach($data['towNav'] as $towNav)
          <div class="towNav {{$towNav->id == $data['secId'] ? '' : 'box'}}">
            <div class="tutor">
              @foreach($towNav->people as $peo)
              <div class="tutor-list">
                <a href="{{url('mobile/tsDetail/id/'.$peo->id)}}">
                  <img src="{{asset($peo->head_pic)}}" alt="">
                  <div class="superstratum">
                    <p class="stu-name">{{$peo->name}}</p>
                    <p class="stu-tit">{{$peo->position}}</p>
                    <div class="stu-text">
                        <p>{{$peo->intro}} </p>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
            <p class="load" nav="{{$towNav->id}}" page="{{config('hint.m_tust_num')}}">加载更多</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>

  <input type="hidden" name="url" value="{{url('mobile/getPeopleMessge')}}">
  <input type="hidden" name="m_tust_num" value="{{config('hint.m_tust_num')}}">
  <input type="hidden" name="typeid" value="{{$data['secId']}}">
  <script src="{{asset('Mobile/js/jquery-1.10.1.min.js')}}"></script>
  <script src="{{asset('Mobile/js/swiper.min.js')}}"></script>
  <script src="{{asset('Mobile/js/iscroll.js')}}"></script>
  <script>
    // $(".tablea").find(".box:first").show();    //为每个BOX的第一个元素显示        
    $("#oranger li a").on("mouseover",function(){ //给li标签添加事件  
      var index=$(this).parent().index();  //获取当前li标签的个数  
      // $(this).parent().parent().next().find(".box").hide().eq(index).show(); //返回上一层，在下面查找css名为box隐藏，然后选中的显示  
      $('#tablea').find('.towNav').addClass('box').eq(index).removeClass('box')
      $(this).addClass("hover").parent().siblings().children().removeClass("hover"); //a标签样式
    })
    $("#pagehide").click(function(){
      $("#myPanel").toggle()
    })
    $('#myPanel').click(function(){
      $("#myPanel").hide();
    })

    var url = $('[name=url]').val(),
        m_tust_num = $('[name=m_tust_num]').val();
    //分类数据
    $('#oranger li').click(function(){
      var thisObj = $(this);
      var index = $('#oranger li').index(this),
          typeid = thisObj.attr('typeid'),
          dj = thisObj.attr('dj');
      $('[name=typeid]').val(typeid);
      if (dj == 0) {
        $.ajax({
          url : url,
          type : 'GET',
          data : {nav:typeid},
          dataType : 'json',
          success : function(d){
            thisObj.attr('dj',1);
            var html = '';
            if (d != 0) {
                $.each(d,function(index,item){
                  html += '<div class="tutor-list"><a href="'+item.url+'">';
                  html += '<img src="'+item.head_pic+'" alt="">';
                  html += '<div class="superstratum"><p class="stu-name">'+item.name+'</p>';
                  html += ' <p class="stu-tit">'+item.position+'</p>';
                  html += '<div class="stu-text"><p>'+item.intro+' </p></div></div></a></div>';
                });
            // }else{
            //   html += '<p style="width:100%;text-align:center;color:#999999;margin-top:.1rem">已经到底部了</p>';
            //   thisObj.hide();
            }
            // thisObj.prev().after(html);
            $('#tablea .towNav').eq(index).find('.tutor').append(html);
            console.log($('#tablea .towNav').eq(index).find('.tutor'))
          },
          error : function(e){
            console.log(e);
          }
        });
      }
      
    })
    //分页数据
    $('.load').click(function(){
      var thisObj = $(this);
      var nav = thisObj.attr('nav'),
          page = thisObj.attr('page');
      $.ajax({
        url : url,
        type : 'GET',
        data : {nav:nav,page:page},
        dataType : 'json',
        success : function(d){
          thisObj.attr('page',parseInt(page)+parseInt(m_tust_num));
          var html = '';
          if (d != 0) {
              $.each(d,function(index,item){
                html += '<div class="tutor-list"><a href="'+item.url+'">';
                html += '<img src="'+item.head_pic+'" alt="">';
                html += '<div class="superstratum"><p class="stu-name">'+item.name+'</p>';
                html += ' <p class="stu-tit">'+item.position+'</p>';
                html += '<div class="stu-text"><p>'+item.intro+' </p></div></div></a></div>';
              });
            
          }else{
            html += '<p style="width:100%;text-align:center;color:#999999;margin-top:.1rem">已经到底部了</p>';
            thisObj.hide();
          }
          thisObj.prev().append(html);
        },
        error : function(e){
          console.log(e);
        }
      });
    })
  </script>
@stop