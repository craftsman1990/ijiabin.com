@extends('layouts.admin')
@section('title','订单')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>订单列表</h5>
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
                                    <th >订单号</th>
                                    <th>订单名称</th>
                                    <th>下单用户</th>
                                    <th>订单价格</th>
                                    <th>订单状态</th>
                                    <th>下单时间</th>
                                    <th>支付时间</th>
                                    <th>支付方式</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->order_num}}</td>
                                    <td>{{$v->title}}</td>
                                    <td>{{$v->user}}</td>
                                    <td>{{$v->price}}</td>
                                    <td>
                                        @if($v->status==1)
                                            <span class="label label-info">已支付</span>
                                        @else
                                            <span class="label label-danger">未支付</span>
                                        @endif
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>{{$v->pay_time}}</td>
                                    <td>{{$v->payment_method == 'wechat' ? '微信' : '未知'}}</td>

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