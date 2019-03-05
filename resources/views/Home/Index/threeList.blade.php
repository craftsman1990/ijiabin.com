@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/program.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/college.css')}}">
<style type="text/css">
  .thr-list-content{
    width:84%;
    max-width: 1180px;
    margin: 0 auto;
    margin-top:18px;
  }
  .tlc-left{
    width: 69.6%;
    float: left;
    padding: 0px;
    margin-bottom: 20px;
  }
  .tlc-right{
    width: 29%;
    float: right;
    padding: 15px 0px;
    margin-left: 1.4%;
    background: #fafafa;
  }
  .tlc-hide{
    display: none;
  }
  .tlc-show{
    display: block;
  }
  .btn_more{
    width:100%;
    position:relative;
    height:50px;
  }
  .ckgd{
    position: absolute;
    bottom:0;
    left:50%;
    margin-left:-14%;
    width:28% !important;
    height:40px !important;
    color:#666666 !important;
    border:1px solid #dedede;
    border-radius:3px;
  }
  .ckgd:hover{
    color:#313b5f !important;
    border:1px solid #313b5f;
    border-radius:3px;
  }
</style>
<div class="wrapper">
        @include('layouts._header')
    <div class="main1 clearfix">
        <div class="main_tab">
            <div class="nav_mytab">
                <ul id="myTab" class="nav_bot nav-tabs">
                @foreach($data['thrNav'] as $thrNav)
                    <li class="thr-click {{$thrNav->id == $data['id'] ? 'active' : ''}}">
                        <a href="#" data-toggle="tab">
                            {{$thrNav->n_name}}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
            
            <div class="thr-list-content">
                <div class="tlc-left">
                  @foreach($data['thrNav'] as $thrNav)
                  <div class="tcl-list {{$thrNav->id == $data['id'] ? 'tlc-show' : 'tlc-hide'}}">
                    <div>
                      @foreach($thrNav->art as $art)
                      <dl class="tab_list">
                        @if($art->type == 1)
                        <a href="{{url('article/id/'.$art->id)}}" target="_blank">
                        @else
                        <a href="{{url('video/id/'.$art->id)}}" target="_blank">
                          <img class="bofang" src="{{asset('Home/images/bfang.png')}}" alt="">
                        @endif    
                            <dt>
                                <img src="{{asset($art->cover)}}" alt="">
                            </dt>
                            <dd>
                                <h4 class="tab_tit">{{$art->title}}</h4>
                                <p class="tab_con">{{$art->intro}}</p>
                                <p class="tab_time">{{substr($art->publish_time,0,10)}}</p>
                            </dd>
                        </a>
                      </dl>
                      @endforeach
                    </div>
                    <div class="btn_more">
                      <button navid="{{$thrNav['id']}}" page="{{config('hint.show_num')}}" class="ckgd">查看更多</button>
                    </div>
                   
                  </div>

                  @endforeach
                </div>
                <div class="tlc-right">
                  <h3 class="rig_tit"><i class="icons"></i>相关推荐</h3>
                  @foreach($data['like'] as $like)
                  <dl class="rig_dls">
                      <a href="{{url('article/id/'.$like->id)}}" target="_blank">
                          <dt class="dls_img">
                              <img src="{{asset($like->cover)}}" alt="">
                          </dt>
                          <dd class="dls_tit">{{$like->title}}</dd>
                      </a>
                  </dl>
                  @endforeach
                  <!-- <dl class="rig_dls">
                      <a href="">
                          <dt class="dls_img">
                              <img src="{{asset('Home/images/list3.png')}}" alt="">
                          </dt>
                          <dd class="dls_tit">放到沙发上豆腐红烧豆腐红烧豆腐还是大放送的护发素地方官方代购的风格</dd>
                      </a>
                  </dl> -->
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts._footer')
<input type="hidden" name="url" value="{{url('getThereMessge')}}">
<input type="hidden" name="show_num" value="{{config('hint.show_num')}}">
<script type="text/javascript">
  $('.thr-click').click(function(){
    // console.log($(this).index());
    $('.tcl-list').eq($(this).index()).show().siblings().hide();
  });

  var show_num = $('[name=show_num]').val(),
      url = $('[name=url]').val();

  //更多点击
      $('.btn_more').click(function(){
        var thisObj = $(this);
        var navid = thisObj.find('button').attr('navid'),
            page = thisObj.find('button').attr('page');
        $.ajax({url:url,
            type:'GET',
            data:{navid:navid,page:page},
            dataType:'json',
            success:function(d){
              thisObj.find('button').attr('page',parseInt(page)+parseInt(show_num));
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
                  html += '<p class="tab_time">'+item.publish_time.substr(0,10)+'</p></dd></a></dl>';
                });
              }else{
                 html += '<p style="width: 100%;height:30px;text-align: center;line-height: 30px;font-size: 16px;color: #db9651;">已经到最底部了</p>';
                 thisObj.hide();
              }
              thisObj.prev().append(html);
            }})
        
      })
</script>
@stop