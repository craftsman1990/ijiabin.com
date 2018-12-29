@extends('layouts.admin')
@section('title','线下季课')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>课程内容</h5>
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
                            <a class="btn btn-primary J_menuItem" href="{{url('admin/jbdx/content/create/course_id/'.$id)}}">添加章节</a>
                            <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course')}}">返回课程</a>
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>章节</th>
                                    <th>标题</th>
                                    <th>时长</th>
                                    <th>属性</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->chapter}}</td>
                                    <td>{{$v->title}}</td>
                                    <td class="center">{{$v->time}}</td>
                                    <td class="center">{{$v->type ==1 ? '正课' : '试看'}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="font-bold cgedit" href="{{url('admin/jbdx/content/'.$v->id.'/edit')}}">修改</a></li>
                                                <li><a href="{{url('admin/jbdx/content/'.$v->id)}}" class="demo4">自测试题</a></li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/jbdx/content/'.$v->id)}}">删除</a>
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