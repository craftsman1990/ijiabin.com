@extends('layouts.admin')
@section('title','新文章')
@section('content')
<style type="text/css">
    .juzhong{text-align: right;}
    .dinwei{margin-top: 10px;}
</style>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>新文章列表  {{$list->total()}}</h5>
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
                            <a href="article/create" class="btn btn-primary J_menuItem">添加文章</a>
                            <a href="article/create/createVideo" class="btn btn-primary J_menuItem">添加视频</a>
                            <a href="article/add" class="btn btn-primary J_menuItem">导入微信公众号文章</a>
                        </div>
                        <form action="" >
                            <div class="form-group">
                                    <div class="col-sm-1 juzhong"><label class="dinwei">分类：</label></div>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="cg_id">
                                            <option value="0">请选择分类</option>
                                            @foreach($data['cate'] as $cate)
                                            <option value="{{$cate->id}}" {{$data['cg_id'] == $cate->id ? 'selected' : ''}} >{{$cate->cg_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-sm-1 juzhong"><label class="dinwei">标题：</label></div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="title" value="{{$data['title']}}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">搜索</button>
                            </div>
                        </form>

                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>标题</th>
                                    <th>分类</th>
                                    <th>状态</th>
                                    <th>类别</th>
                                    <th>精选推荐</th>
                                    <th>上传时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->title}}</td>
                                    <td class="center">{{$v->cg_name}}</td>
                                    <td class="center">
                                        @if($v->status == 1)
                                            <span class="label label-info">正常</span>
                                        @else
                                            <span class="label label-danger">禁用</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($v->type == 1)
                                            <span class="label label-info">文章</span>
                                        @else
                                            <span class="label label-danger">视频</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($v->rec == 1)
                                            精选推荐
                                        @else
                                            未知
                                        @endif
                                    </td>
                                    <td class="center">{{$v->publish_time}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('article/id/'.$v->id)}}" target="_blank">详情</a></li>
                                                <li><a href='{{url( $v->type == 1 ? "admin/jbdx/article/$v->id/edit" : "admin/jbdx/article/update/editVideo/$v->id")}}' class="font-bold">修改</a></li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/jbdx/article/'.$v->id)}}">删除</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php echo $list->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     @include('layouts.admin_js')
    <script src={{asset("Admin/js/plugins/footable/footable.all.min.js")}}></script>
    <!-- <script src={{asset("Admin/js/plugins/layer/layer.min.js")}}></script> -->
    <script src={{asset("Admin/js/plugins/sweetalert/sweetalert.min.js")}}></script>
    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});
    </script>
    @include('layouts.admin_delete')
@stop