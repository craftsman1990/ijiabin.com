@extends('layouts.admin')
@section('title','导航')
@section('content')
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>导航树</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="buttons.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="javascript:;">选项1</a>
                        </li>
                        <li><a href="javascript:;">选项2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="ibox-content">
                <div class="">
                    <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加导航</button>
                </div>
                 @include('layouts.admin_error')
                <div id="treeview6" class="test"></div>
            </div>
        </div>
    </div>
    <button style="display: none;" data-toggle="modal" data-target="#myModalMod" id="operation">操作</button>  
     @include('layouts.admin_js')
    <script src={{asset("Admin/js/plugins/footable/footable.all.min.js")}}></script>
    <!-- <script src={{asset("Admin/js/plugins/layer/layer.min.js")}}></script> -->
    <script src={{asset("Admin/js/plugins/sweetalert/sweetalert.min.js")}}></script>
    <script src={{asset("Admin/js/plugins/treeview/bootstrap-treeview.js")}}></script>
    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});
    </script>
    <!-- 弹框(添加) -->
    <div class="modal inmodal" id="myModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="navAdd" method="post" action={{url('admin/navigation')}} class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加导航</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">导航名称：</label>
                        <div class="col-sm-8">
                            <input  name="n_name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
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
                        <label class="col-sm-3 control-label">导航父级：</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="parent_id">
                                <option value="0" >无</option>
                                @foreach($list['arr'] as $v)
                                    <option value={{$v['id']}}><?php echo str_repeat('|--', $v['level']) ?>{{$v['n_name']}}</option>
                                @endforeach
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
            <form id="navMod" method="post" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">导航详情</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">导航名称：</label>
                        <div class="col-sm-8">
                            <input  name="n_name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" id="mod_name">
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">导航排序：</label>
                        <div class="col-sm-8">
                            <input  name="sort" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error" id="mod_sort">
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 值越大，排序越靠前，值相同按创建时间排序</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">导航父级：</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="parent_id">
                                <option value="0" >无</option>
                                @foreach($list['arr'] as $v)
                                    <option value={{$v['id']}} class="xuanze"><?php echo str_repeat('|--', $v['level']) ?>  {{$v['n_name']}}</option>
                                @endforeach
                            </select>
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 注意：修改父级，子级也会跟随改变</span>
                        </div>
                    </div>       
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }} 
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" id="deleteNav">删除</button>
                    <button type="submit" class="btn btn-primary" >修改</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- 删除 -->
    @include('layouts.admin_delete')
    <textarea id="list" style="display: none;">{{$list['json']}}</textarea>
    <script type="text/javascript">
        $(function() {
            var o = $('#list').val();
            $("#treeview6").treeview({
                color: "#428bca",
                expandIcon: "glyphicon glyphicon-chevron-right",
                collapseIcon: "glyphicon glyphicon-chevron-down",
                nodeIcon: "glyphicon glyphicon-bookmark",
                levels:1,
                showTags: !0,
                data: o,
                onNodeSelected: function(e, o) {
                    var optObj = $('.xuanze');
                    var len = optObj.length;
                    var href = o.href;
                    for(var i=0;i<len;i++){
                        if (optObj.eq(i).val() == o.parent_id) {
                            optObj.eq(i).attr('selected',true)
                        }
                    }
                    // console.log(o.parent_id);
                    $("#mod_name").val(o.text);
                    $("#mod_sort").val(o.sort);
                    $("#navMod").attr('action',o.href);
                    $("#deleteNav").attr('onclick',"cancel('"+href+"')");
                    $('#operation').trigger('click');

                }
            })
        });

        
    </script>
@stop