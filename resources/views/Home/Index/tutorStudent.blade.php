@extends('layouts.home')
@section('title',$data['title'])
@section('content')
<link rel="stylesheet" href="{{asset('Home/css/program.css')}}">
<link rel="stylesheet" href="{{asset('Home/css/study.css')}}">
<div class="wrapper">
         @include('layouts._header')
    <div class="main1 clearfix">
        <div class="main_tab">
            <div class="nav_mytab">
                <ul id="myTab" class="nav_bot nav-tabs">
                    @foreach($data['towNav'] as $towNav)
                    <li class="{{$towNav->id == $data['secId'] ? 'active' : ''}}">
                        <a href="#tutor_{{$towNav->id}}" data-toggle="tab">
                            {{$towNav->n_name}}
                        </a>
                    </li>
                    @endforeach
                </ul>    
            </div>
            
            <div id="myTabContent" class="tab-content">
                @foreach($data['towNav'] as $towNav)
                <div class="tab-pane fade {{$towNav->id == $data['secId'] ? 'in active' : ''}}" id="tutor_{{$towNav->id}}">
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

@include('layouts._footer')
@stop