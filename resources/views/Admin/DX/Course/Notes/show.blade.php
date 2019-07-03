<?php
@extends('layouts.admin')
@section('title','小节笔记')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>笔记内容</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">选项 01</a>
                                </li>
                                <li><a href="#">选项 02</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="">
                            <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course/'.$course_id)}}">返回小节</a>
                        </div>
                        @include('layouts.admin_error')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>章节</th>
                                <th>内容</th>
                                <th>时间点</th>
                                <th>用户名</th>
                                <th>点赞数</th>
                                <th>审核状态：1，通过，0未通过</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->content_id}}</td>
                                    <td>{{$v->content}}</td>
                                    <td class="center">{{$v->record_time == 0 ? '':$v->time}}</td>
                                    <td class="center">{{$v->nickname}}</td>
                                    <td class="center">{{$v->praise}}</td>
                                    <td class="center">
                                        @if($v->status == 1)
                                            <span class="label label-info">通过</span>
                                        @else
                                            <span class="label label-danger">未通过</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="font-bold cgedit" href="{{url('admin/jbdx/notes/'.$v->id.'/edit')}}">详情</a></li>
                                                <li class="divider"></li>
                                                <li><a id="{{$v->id}}" data_status ="{{$v->status}}" class="font-bold cgedit update_status" url="{{url('admin/jbdx/notes/updateStatus/'.$v->id)}}" >{{$v->status == 1 ? '未审核' : '通过'}}</a></li>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.admin_js')
    <script src="{{asset('Admin/js/plugins/footable/footable.all.min.js')}}"></script>
    <script src="{{asset('Admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});
    </script>
    {{--    @include('layouts.admin_delete')--}}
    @include('layouts.course_update_status')

@stop