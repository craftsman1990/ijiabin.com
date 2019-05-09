@extends('layouts.admin')
@section('title','评论列表')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>评论列表</h5>
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

                        @include('layouts.admin_error')
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th >ID</th>
                                <th>评论人</th>
                                <th>评论时间</th>
                                <th>评论内容</th>
                                <th>点赞数</th>
                                <th>评分</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $v)
                                <tr class="gradeC">
                                    <td class="center">{{$v->id}}</td>
                                    <td class="center">{{$v->user_name}}</td>
                                    <td class="center">{{$v->created_at}}</td>
                                    <td class="center">{{$v->content}}</td>
                                    <td class="center">{{$v->praise}}</td>
                                    <td class="center">{{$v->grade}}</td>
                                    <td class="center">
                                        @if($v->status==1)
                                            <span class="label label-info">正常</span>
                                        @else
                                            <span class="label label-danger">禁用</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    @if($v->status == 1)
                                                        <a href="javascript:;" id ="{{$v->id}}" class="demo4 update_status" url="{{url('admin/jbdx/comment/'.$v->id)}}" data_status = "{{$v->status}}">禁用</a>
                                                    @else
                                                        <a href="javascript:;" id ="{{$v->id}}" class="demo4 update_status" url="{{url('admin/jbdx/comment/'.$v->id)}}" data_status = "{{$v->status}}">解除禁用</a>
                                                    @endif
                                                </li>
                                            <!-- <li><a class="font-bold cgedit" href="{{url('admin/jbdx/discussion/'.$v->id.'/edit')}}">修改</a></li> -->
{{--                                                <li><a href="#" class="demo4">暂不提供操作</a></li>--}}
{{--                                                <li class="divider"></li>--}}
                                            <!-- <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/jbdx/discussion/'.$v->id)}}">删除</a> -->
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
    @include('layouts.admin_update_status')

@stop
