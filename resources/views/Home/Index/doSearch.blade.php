@extends('layouts.home')
@section('content')
<link rel="stylesheet" href={{asset("Home/css/index.css")}}>
<link rel="stylesheet" href="{{asset('Home/css/search.css')}}">
    <div class="wrapper">
        @include('layouts._header')
        <div class="main1 clearfix">
            <div class="main">
                <div class="main-left">
                    <form action="" id="dosform">
                    <p class="fond">  
                      <input type="text" name="keybord" value="{{$data['keybord']}}">
                      <input type="submit" value="搜索">
                    </p>
                    </form>
                    <div class="list">
                        @if($data['res'])
                            @foreach($data['res'] as $res)
                            <dl class="tab_list">
                                @if($res->type ==1)
                                <a href="{{url('article/id/'.$res->id)}}" target="_blank">
                                @else
                                <a href="{{url('video/id/'.$res->id)}}" target="_blank">
                                    <img class="bofang" src="{{asset('Home/images/bfang.png')}}" alt="">
                                @endif
                                    <dt>
                                        <img src="{{asset($res->cover)}}" alt="">
                                    </dt>
                                    <dd>
                                        <h4 class="tab_tit">{{$res->title}}</h4>
                                        <p class="tab_con">{{$res->intro}}</p>
                                        <p class="tab_time">{{substr($res->publish_time,0,10)}}</p>
                                        <span>{{$res->n_name}}</span>
                                    </dd>
                                </a>
                            </dl>
                            @endforeach
                           
                        @else
                        <p class="nonee">没有找到相关内容</p>
                        @endif
                    </div>
                    <div class="btn_more">
                        <button page="{{config('hint.show_num')}}" class="ckgd" style="width: 100%;height:30px;text-align: center;line-height: 30px;font-size: 16px;color: #00f;">查看更多</button>
                    </div>
                </div>
                <div class="main-right">
                    <div class="rig-top">
                        <h3 class="rig_tit"><i class="icons"></i>相关推荐</h3>
                        @foreach($data['choi'] as $choi)
                        <dl class="rig_dls">
                            @if($choi->type == 1)
                            <a href="{{url('article/id/'.$choi->cho_id)}}">
                            @else
                            <a href="{{url('video/id/'.$choi->cho_id)}}">
                            @endif
                                <dt class="dls_img">
                                    <img src="{{asset($choi->cover)}}" alt="">
                                </dt>
                                <dd class="dls_tit">{{$choi->title}}</dd>
                            </a>
                        </dl>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="url" value="{{url('api/getSearch')}}">
    @include('layouts._footer')
    <script src="{{asset('Home/js/swiper.min.js')}}"></script>
    <script type="text/javascript">
        var url = $('[name=url]').val();
        $('.btn_more').click(function(){
            var thisObj = $(this);
            var keybord = $('[name=keybord]').val(),
                source = 1,
                page = thisObj.find('button').attr('page');
            $.ajax({url:url,
                    type:'GET',
                    data:{keybord:keybord,source:source,page:page},
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
    </script>
@stop