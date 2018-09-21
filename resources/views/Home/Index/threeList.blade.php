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
                    @foreach($thrNav->art as $art)
                    <dl class="tab_list">
                      @if($art->type == 1)
                      <a href="{{url('article/id/'.$art->id)}}" target="_blank">
                      @else
                      <a href="{{url('video/id/'.$art->id)}}" target="_blank">
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
<script type="text/javascript">
  $('.thr-click').click(function(){
    // console.log($(this).index());
    $('.tcl-list').eq($(this).index()).show().siblings().hide();
  });
</script>
@stop