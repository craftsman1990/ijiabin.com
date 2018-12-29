@extends('layouts.admin')
@section('title','线下报名')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>国际课程</h5>
                        <h5 style="margin-left: 20px;"><a href="jbp">嘉宾派</a></h5>
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
                            <!-- <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加标签</button> -->
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                 <tr>
                                    <th >ID</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>手机号</th>
                                    <th>微信号</th>
                                    <th>邮箱</th>
                                    <th>嘉宾学员</th>
                                    <th>公司名称</th>
                                    <th>职位</th>
                                    <th>行业</th>
                                    <th>签证</th>
                                    <th>渠道</th>
                                    <th>操作</th>
                                </tr>
                               
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>
                                        @if($v->sex==1)
                                            <span class="label label-info">男</span>
                                        @else
                                            <span class="label label-danger">女</span>
                                        @endif
                                    </td>
                                    <td>{{$v->mobile}}</td>
                                    <td>{{$v->weixin}}</td>
                                    <td>{{$v->email}}</td>
                                    <td>
                                        @if($v->is_stu==1)
                                            <span class="label label-info">是</span>
                                        @else
                                            <span class="label label-danger">否</span>
                                        @endif
                                    </td>
                                    <td>{{$v->company}}</td>
                                    <td>{{$v->position}}</td>
                                    <td>{{$v->industry}}</td>
                                    <td>
                                        @if($v->is_visa==1)
                                            <span class="label label-info">有</span>
                                        @else
                                            <span class="label label-danger">无</span>
                                        @endif
                                    </td>
                                    <td>{{$v->channel}}</td>
                                    
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;">详情</a></li>
                                                <!-- <li><a class="font-bold cgedit" data-toggle="modal" data-target="#myModalMod" url="{{url('admin/label/'.$v->id)}}" >修改</a></li> -->
                                                <!-- <li><a href="javascript:;">禁用</a></li> -->
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" >暂不提供操作</a>
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
    <!-- @include('layouts.admin_delete') -->
    
@stop