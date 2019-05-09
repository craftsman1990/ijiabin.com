@extends('layouts.admin')
@section('title','弹幕')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>弹幕内容</h5>
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
                            <!-- <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加课程</button> -->
                            <a class="btn btn-primary J_menuItem" href="{{url('admin/jbdx/content/bulletScreen/create/content_id/'.$content->id)}}">添加弹幕</a>
                            <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course/'.$content->course_id)}}">返回内容</a>
                        </div>
                        @include('layouts.admin_error')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>弹幕ID</th>
                                <th>用户名</th>
{{--                                <th>内容ID</th>--}}
                                <th>弹幕内容</th>
                                <th>发表时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->userDetail->nickname}}</td>
{{--                                    <td>{{$v->content_id}}</td>--}}
                                    <td>{{$v->text}}</td>
                                    <td class="center">{{$v->created_at}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="font-bold cgedit" href="{{url('admin/jbdx/content/bulletScreen/'.$v->id.'/edit')}}">修改</a></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/jbdx/content/bulletScreen/'.$v->id)}}">删除</a>
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
    @include('layouts.admin_delete')

@stop
