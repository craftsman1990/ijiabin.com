@extends('layouts.admin')
@section('title','年会活动')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>年会活动</h5>
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
                            <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加活动</button>
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>活动名称</th>
                                    <th>活动时间</th>
                                    <th>活动场次</th>
                                    <th>活动状态</th>
                                    <!-- <th>最后登陆IP</th> -->
                                    <!-- <th>状态</th> -->
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->title}}</td>
                                    <td>{{$v->time}}</td>
                                    <td class="center">第 <span>{{$v->screening}}</span> 场</td>
                                    <td class="center">
                                        @if($v->status == 1)
                                            <span class="label label-info">进行中</span>
                                        @elseif($v->status ==2)
                                            <span class="label label-default">已结束</span>
                                        @else
                                            <span class="label label-danger">未开始</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('admin/metting/award/ldid/'.$v->id)}}">奖品列表</a></li>
                                                <li><a href="{{url('admin/metting/winners/ldid/'.$v->id)}}">获奖列表</a></li>
                                                <li><a class="font-bold cgedit" data-toggle="modal" data-target="#myModalMod" url="{{url('admin/metting/'.$v->id)}}" >修改</a></li>
                                                <!-- <li><a href="javascript:;" class="demo4">禁用</a></li> -->
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/metting/'.$v->id)}}">删除</a>
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
    <script src={{asset("Admin/js/plugins/layer/laydate/laydate.js")}}></script>
    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});
    </script>
    @include('layouts.admin_delete')
    <!-- 弹框(添加) -->
    <div class="modal inmodal" id="myModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryAdd" method="post" action="{{url('admin/metting')}}" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加活动</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动名称：</label>
                        <div class="col-sm-8">
                            <input  name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动场次：</label>
                        <div class="col-sm-8">
                            <input  name="screening" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动时间：</label>
                        <div class="col-sm-8">
                            <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" name="time" value="{{old('time')}}"><label class="laydate-icon"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >保存</button>
                </div>
            </div>
            </form>
        </div>
    </div>
     <!-- 弹框(修改) -->
    <div class="modal inmodal" id="myModalMod" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="mettingMod" method="post" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">活动修改</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动名称：</label>
                        <div class="col-sm-8">
                            <input  name="title" id="titleMod" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动场次：</label>
                        <div class="col-sm-8">
                            <input  name="screening" id="screeningMod" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动时间：</label>
                        <div class="col-sm-8">
                            <input class="form-control layer-date" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})" name="time" id="timeMod" value="{{old('time')}}"><label class="laydate-icon"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }} 
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >保存</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $('.cgedit').click(function(){
            var title = $(this).parent().parent().parent().parent().prev().prev().prev().prev().html();
            var time = $(this).parent().parent().parent().parent().prev().prev().prev().html();
            var screening = $(this).parent().parent().parent().parent().prev().prev().find('span').html();
            var url = $(this).attr('url');

            $('#titleMod').val(title);
            $('#screeningMod').val(screening);
            $('#timeMod').val(time);
             $('#mettingMod').attr('action',url);

        })
    </script>
@stop