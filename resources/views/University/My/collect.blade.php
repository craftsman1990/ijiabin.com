@extends('layouts.university')
@section('title','我的收藏')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
@if($data['commentCount'] != 0)
  <link rel="stylesheet" href="{{asset('University/css/mine_collect.css')}}">
  <div class="wrapper">
    <div id="centera">
      <!-- <div class="orangerb">
        <ul id="oranger"> 
          <li class="hover">观点<span>(<em id="commentCount">{{$data['commentCount']}}</em>)</span></li> 
          <li>课程<span>({{$data['courseCount']}})</span></li> 
        </ul>
      </div> -->
      <div id="tablea" class="tablea">
         <div class="box">
          <div class="boxBefore2">
            <div class="tabBtn11">
              <p class="view">观点<span>(<em id="commentCount">{{$data['commentCount']}}</em>)</span></p>
              <p class="bianji"><img src="{{asset('University/images/bianji@2x.png')}}" alt="">编辑</p>
            </div>
            <div class="tabBtn22">
              <p class="text">已选中<span id="comment_total">0</span>条记录</p>
              <p class="checkboxF">
                <input type="checkbox" id="awesome2" />
                <label for="awesome2" id="all2"></label>全选
              </p>
            </div>
            @if(isset($data['comment']))
            @foreach($data['comment'] as $comment)
            <div class="boxs boxs2">
              <p class="checkboxF22">
                  <label class="my_protocol">
                    <input class="input_agreement_protocol" type="checkbox" name="items2" value="{{$comment->collect_id}}" />
                    <span class="sp comment_xz"></span>
                  </label>
              </p>
              <div class="detailsTop detailsTop2">
                <div class="detaileName">
                  <dl>
                    <dd><img src="{{$comment->user_pic}}" alt=""></dd>
                    <dt>
                      <p class="dt_name">{{$comment->user_name}}</p>
                    </dt>
                  </dl>
                </div>
                <div class="detailCon" onclick="window.location.href='{{url("university/discussion/commentDetail/id/".$comment->id)}}'">{{$comment->content}}</div>
                <div class="detailTit" onclick="window.location.href='{{url("university/discussion/detail/id/".$comment->discussion_id)}}'">
                  <p class="tit"># {{$comment->dis_title}}</p>
                  <p class="t_con">
                    <span class="time">{{$comment->dis_time}}</span>
                    <span class="con">{{$comment->dis_count}}人发表观点</span>
                  </p>
                </div>
              </div>
            </div>
            @endforeach
            @endif
            <div class="delete2">
              <button id="del2">删除</button>
              <button id="cancel2">取消</button>
            </div>
          </div>
          
        </div>
        <div class="box">
          <div class="boxBefore">
            <p class="tabBtn"><img src="{{asset('University/images/icon_bianji@2x.png')}}" alt="">编辑</p>
            <div class="tabBtn2">
              <p class="text">已选中1条记录</p>
              <p class="checkboxF">
                <input type="checkbox" id="awesome" />
                <label for="awesome" id="all"></label>全选
              </p>
            </div>
            @if(isset($data['course']))
            @foreach($data['course'] as $course)
            <div class="boxs">
              <p class="checkboxF2">
                  <label class="my_protocol">
                    <input class="input_agreement_protocol" type="checkbox" name="items" value="{{$course->collect_id}}" />
                    <span></span>
                  </label>
              </p>
              <dl class="comB2">
                <dt><img src="{{asset($course->lengthways_cover)}}" alt=""></dt>
                <dd>
                  <p class="dl_tit2">{{$course->name}}</p>
                  <p class="dl_introfuce2">{{$course->teacher}}「{{$course->professional}}」</p>
                  <p class="dl_time2">学习至 第{{$course->learningCount}}节／共{{$course->contentsCount}}节</p>
                </dd>
              </dl>
            </div>
            @endforeach
            @endif
            <div class="delete">
              <button id="del">删除</button>
              <button id="cancel">取消</button>
            </div>
          </div>
          
        </div>


       
      </div>
    </div>
    <div class="cover1">未选中任何项</div>
    <div class="cover">
      <div class="box2">
        <p class="boxtit">确认删除？</p>
        <div class="btns">
          <p class="yesl" id="destory">确认</p>
          <p class="nor">取消</p>
        </div>
      </div>
    </div>
  </div>

  
  <script>
    $(document).ready(function () {
      $(".tablea").find(".box:first").show();    //为每个BOX的第一个元素显示   
      $("#oranger li").on("mouseover",function(){ //给a标签添加事件  
        var index=$(this).index();  //获取当前a标签的个数  
        $(this).parent().parent().next().find(".box").hide().eq(index).show(); //返回上一层，在下面查找css名为box隐藏，然后选中的显示  
        $(this).addClass("hover").siblings().removeClass("hover"); //a标签显示，同辈元素隐藏  
      }) 

      //编辑点击
      $(".tabBtn").click(function(){
        $(".tabBtn").css("display","none");
        $(".tabBtn2").css("display","block");
        $('.checkboxF2').css('display','block');
        $('.delete').css('display','block');
      })

      $("#cancel").click(function(){
        $(".tabBtn").css("display","block");
        $(".tabBtn2").css("display","none");
        $('.checkboxF2').css('display','none');
        $('.delete').css('display','none');
      })

      $(".tabBtn11").click(function(){
        $(".tabBtn11").css("display","none");
        $(".tabBtn22").css("display","block");
        $('.checkboxF22').css('display','block');
        $('.delete2').css('display','block');
      })

      $("#cancel2").click(function(){
        $(".tabBtn11").css("display","block");
        $(".tabBtn22").css("display","none");
        $('.checkboxF22').css('display','none');
        $('.delete2').css('display','none');
        // window.location.reload();
      })

      $('#all').on('click',function(){
        if($('#awesome').is(":checked")){
          $(':checkbox[name=items]').prop('checked',false);
        }else{
          $(':checkbox[name=items]').prop('checked',true);
        }
      })

      $('#all2').on('click',function(){
        comment_total();
        if($('#awesome2').is(":checked")){
          $(':checkbox[name=items2]').prop('checked',false);
        }else{
          $(':checkbox[name=items2]').prop('checked',true);
        }
      })

      // $("#del").click(function(){
      //   var checks = $("input[name='items']:checked");
      //   if(checks.length == 0){
      //     $(".cover1").css("display","block");
      //     setTimeout(function(){//定时器 
      //       $(".cover1").css("display","none");
      //     },3000);
      //   }else{
      //     $('.cover').css('display','block');
      //     $('.yesl').click(function(){
      //       var course_ids = new Array();
      //       for (var i = checks.length - 1; i >= 0; i--) {
      //         course_ids[i] = checks[i].value
      //       }
      //       cancelCollect(course_ids)
      //       $("input[name='items']:checked").parents(".boxs").remove();
      //       $('.cover').css('display','none');
      //     })
      //     $('.nor').click(function(){
      //       $('.cover').css('display','none');
      //     })
      //   }
      // })
      
      $("#del2").click(function(){
        var checks = $("input[name='items2']:checked");
        if(checks.length == 0){
          $(".cover1").css("display","block");
          setTimeout(function(){//定时器 
            $(".cover1").css("display","none");
          },2000);
        }else{
          $('.cover').css('display','block');
          $('#destory').unbind('click').click(function(){
            var comment_ids = new Array();
            for (var i = checks.length - 1; i >= 0; i--) {
              comment_ids[i] = checks[i].value
            }
            cancelCollect(comment_ids)
            $("input[name='items2']:checked").parents(".boxs").remove();
            $('.cover').css('display','none');
          })
          $('.nor').click(function(){
            $('.cover').css('display','none');
          })
        }
      })
    })

    var cancelCollect = function(ids){
      console.log(ids)
      $.ajax({
          url:"{{url('university/my/cancelCollect')}}",
          data:{_token:"{{csrf_token()}}",ids:ids},
          type:'POST',
          dataType:'json',
          success:function(d){
            console.log(d)
            var commentCount = $('#commentCount').text();
            // console.log(parseInt(commentCount));
            // console.log(parseInt(d.data))
            $('#commentCount').text(parseInt(commentCount)-parseInt(d.data));
            comment_total();
          }
      })
    }

    $('.comment_xz').click(function(){
      comment_total();
    })

    //计算选中个数
    function comment_total() {
      setTimeout(function(){//定时器 
        
        var checks = $("input[name='items2']:checked");
        // console.log(commentCount)
        
        $('#comment_total').text(checks.length);
      },500)
    }
  </script>
@else
<link rel="stylesheet" href="{{asset('University/css/mine.css')}}">
<div class="wrapper">
  <div class="imgbox1"><img src="{{asset('University/images/quesheng_shoucang@2x.png')}}" alt=""></div>
  <p class="tNone tNone1">您还没有收藏任何内容哦~</p>
</div>
@endif
@stop