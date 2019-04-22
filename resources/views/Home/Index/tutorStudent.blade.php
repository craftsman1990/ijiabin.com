@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/program.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/study.css')}}">
<style type="text/css">
    .footer{
        margin-top: 30px!important;
    }
</style>
<div class="wrapper">
         @include('layouts._header')
    <div class="main1 clearfix">
        <div class="main_tab">
            <div class="nav_mytab">
                <ul id="myTab" class="nav_bot nav-tabs">
                    @foreach($data['towNav'] as $towNav)
                    <li class="{{$towNav->id == $data['secId'] ? 'active' : ''}} cate">
                        <a href="#tutor_{{$towNav->id}}" data-toggle="tab" typeid="{{$towNav->id}}" dj="{{$towNav->id==$data['secId'] ? '1' : '0'}}">
                            {{$towNav->n_name}}
                        </a>
                    </li>
                    @endforeach
                </ul>    
            </div>
            
            <div id="myTabContent" class="tab-content">
                @foreach($data['towNav'] as $towNav)
                <div class="tab-pane fade {{$towNav->id == $data['secId'] ? 'in active' : ''}}" id="tutor_{{$towNav->id}}" page="{{config('hint.ts_show_tust')}}">
                    <p class="hint">*排名不分先后</p>
                    <div class="stu-list">
                        @foreach($towNav->user as $user)
                        <div class="stu-box">
                            <a href="{{url('tutorStudent/detail/id/'.$user->id)}}" target="_blank">
                                <div class="stu-con"><img src="{{asset($user->head_pic)}}" alt=""></div>
                                <div class="superstratum">
                                    <p class="stu-name">{{$user->name}}</p>
                                    <p class="stu-tit">{{$user->position}}</p>
                                    <div class="stu-text">
                                        <p>{{$user->intro}}</p>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        @endforeach 
                     
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="url" value="{{url('getPeopleMessge')}}">
<input type="hidden" name="show_num" value="{{config('hint.ts_show_tust')}}">
<input type="hidden" name="typeid" value="{{$data['secId']}}">
@include('layouts._footer')
<script type="text/javascript">
    var url = $('[name=url]').val(),
        show_num = $('[name=show_num]').val();
    //分类点击获取数据
    $('.cate').click(function(){
        var thisObj = $(this).find('a');
        var href = thisObj.attr('href'),
            typeid = thisObj.attr('typeid'),
            dj = thisObj.attr('dj');
        $('[name=typeid]').val(typeid);
        if (typeid ==11) {
            var type = 1;
        }else{
            var type = 2;
        }
        if (dj==0) {
            $.ajax({url:url,
                type:'GET',
                data:{type:type},
                dataType:'json',
                async: false,
                success:function(d){
                    console.log(d);
                    thisObj.attr('dj',1);
                    var html = '';
                    if (d !=0) {
                       $.each(d,function(index,item){
                            html += '<div class="stu-box">';
                            html += '<a href="'+item.url+'" target="_blank">';
                            html += '<div class="stu-con"><img src="'+item.head_pic+'" alt=""></div>';
                            html += '<div class="superstratum"><p class="stu-name">'+item.name+'</p>';
                            html += '<p class="stu-tit">'+item.position+'</p><div class="stu-text">';
                            html += '<p>'+item.intro+'</p></div></div></a></div>';
                            
                        }); 
                    }else{
                        $(href).find('.stu-list').empty();
                        html += '<p style="width: 100%;text-align: center;">没有相关内容</p>';
                    }
                    $(href).find('.stu-list').append(html);
                }})
            }    
    })

    //分页获取数据
    $(window).scroll(function(){
        var scrT = $(window).scrollTop();
        var height = $(document).height()-$(window).height(); 
        if(scrT >= height){
            var typeid = $('[name=typeid]').val();
            var page = $('#tutor_'+typeid).attr('page');
            if (typeid ==11) {
                var type = 1;
            }else{
                var type = 2;
            }
            $.ajax({url:url,
                type:'GET',
                data:{type:type,page:page},
                dataType:'json',
                async: false,
                success:function(d){
                    console.log(d);
                    $('#tutor_'+typeid).attr('page',parseInt(page)+parseInt(show_num));
                    var html = '';
                    if (d !=0) {
                       $.each(d,function(index,item){
                            html += '<div class="stu-box">';
                            html += '<a href="'+item.url+'" target="_blank">';
                            html += '<div class="stu-con"><img src="'+item.head_pic+'" alt=""></div>';
                            html += '<div class="superstratum"><p class="stu-name">'+item.name+'</p>';
                            html += '<p class="stu-tit">'+item.position+'</p><div class="stu-text">';
                            html += '<p>'+item.intro+'</p></div></div></a></div>';
                            
                        }); 
                    // }else{
                        // $(href).find('.stu-list').empty();
                        // html += '<p style="width: 100%;text-align: center;">没有相关内容</p>';
                    }
                    $('#tutor_'+typeid).find('.stu-list').append(html);
                }
            })
        }
    });

    $(".stu-box").each(function(){
        console.log($('.stu-text p').height())
        console.log($('.stu-text').height())
        
    });
</script>
@stop