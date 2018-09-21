@extends('layouts.admin')
@section('title','分类')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>分类列表</h5>
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
                            <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加分类</button>
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>分类名称</th>
                                    <th>排序</th>
                                    <th>状态</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->cg_name}}</td>
                                    <td>{{$v->sort}}</td>
                                    <td>
                                        @if($v->status == 1)
                                            <span class="label label-info">显示</span>
                                        @else
                                            <span class="label label-danger">不显示</span>
                                        @endif        
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;">详情</a></li>
                                                <li><a class="font-bold cgedit" data-toggle="modal" data-target="#myModalMod" url={{url('admin/category/'.$v->id)}} status={{$v->status}} >修改</a></li>
                                                <li><a href="javascript:;">禁用</a></li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/category/'.$v->id)}}">删除</a>
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
    <!-- 弹框(添加) -->
    <div class="modal inmodal" id="myModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryAdd" method="post" action={{url('admin/category')}} class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加分类</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类名称：</label>
                        <div class="col-sm-8">
                            <input  name="cg_name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类排序：</label>
                        <div class="col-sm-8">
                            <input  name="sort" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error">
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 值越大，排序越靠前，值相同按创建时间排序</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类状态：</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="status">
                                <option value="1" >显示</option>
                                <option value="0" >不显示</option>
                            </select>
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
            <form id="categoryMod" method="post" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">分类修改</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类名称：</label>
                        <div class="col-sm-8">
                            <input  name="cg_name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" id="mod_cgname">
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类排序：</label>
                        <div class="col-sm-8">
                            <input  name="sort" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error" id="mod_cgsort">
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 值越大，排序越靠前，值相同按创建时间排序</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类状态：</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="status">
                                <option value="1" class="yxs">显示</option>
                                <option value="0" class="noxs">不显示</option>
                            </select>
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
            var cgstatus = $(this).attr('status');
            var cgsort = $(this).parent().parent().parent().parent().prev().prev().prev().html();
            var cgname = $(this).parent().parent().parent().parent().prev().prev().prev().prev().html();
            var url = $(this).attr('url');
            $('#mod_cgsort').val(cgsort);
            $('#mod_cgname').val(cgname);
            $('#categoryMod').attr('action',url);
            if (cgstatus==1) {
                $('.noxs').attr('selected',false);
                $('.yxs').attr('selected',true);
            }else{
                $('.yxs').attr('selected',false);
                $('.noxs').attr('selected',true);
            }
            // console.log(cgname);
            // console.log(cgsort);
        });
    </script>
@stop