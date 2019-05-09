@extends('layouts.admin')
@section('title','课程')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>课程管理</h5>
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
                            <a class="btn btn-primary J_menuItem" href="course/create">添加课程</a>
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>名称</th>
                                    <th>老师</th>
                                    <th>类别</th>
                                    <th>付费课</th>
                                    <th>价格</th>
                                    <th>观看量</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td class="center">{{$v->teacher}}</td>
                                    <!-- <td><img src="{{asset($v->cover)}}" height="50px"></td> -->
                                    <td class="center">{{config('jbdx.course_ify')[$v->ify]}}</td>
                                    <td class="center">{{$v->is_pay ==1 ? '是' : '否'}}</td>
                                    <td class="center">{{$v->price}}</td>
                                    <td class="center">{{$v->looks}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="font-bold cgedit" href="{{url('admin/jbdx/course/'.$v->id.'/edit')}}">修改</a></li>
                                                <li><a href="{{url('admin/jbdx/course/'.$v->id)}}" class="demo4">内容列表</a></li>
                                                <li><a href="{{url('admin/jbdx/comment/'.$v->id.'?type=2')}}" class="demo4">评论列表</a></li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/jbdx/course/'.$v->id)}}">删除</a>
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