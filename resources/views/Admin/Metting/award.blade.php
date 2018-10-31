@extends('layouts.admin')
@section('title',$metting->title)
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$metting->title}} 奖品列表</h5>
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
                            <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加奖品</button>
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>奖品名称</th>
                                    <th>奖品图片</th>
                                    <th>奖品剩余数量</th>
                                    <!-- <th>最后登陆IP</th> -->
                                    <!-- <th>状态</th> -->
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td><img src="{{asset($v->pic)}}" height="50px"></td>
                                    <td class="center">{{$v->num}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="font-bold cgedit" data-toggle="modal" data-target="#myModalMod" url="{{url('admin/metting/awardUpdate/id/'.$v->id)}}" pic="{{$v->pic}}">修改</a></li>
                                                <!-- <li><a href="javascript:;" class="demo4">禁用</a></li> -->
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/metting/awardDestroy/'.$v->id)}}">删除</a>
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
    <!-- 弹框(添加) -->
    <div class="modal inmodal" id="myModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryAdd" method="post" action="{{url('admin/metting/awardStore')}}" class="form-horizontal m-t" enctype="multipart/form-data">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加奖品</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <!-- 奖品名称 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">奖品名称：</label>
                        <div class="col-sm-8">
                            <input  name="name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <!-- 奖品数量 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">奖品数量：</label>
                        <div class="col-sm-8">
                            <input  name="num" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <!-- 奖品图片 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">奖品图片：</label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-primary" id="addChoi"> 选择图片</button>
                        </div>
                    </div>
                     <!-- 奖品图片 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-8">
                            <img width="100px;" src="{{old('pic')}}" id="addPic">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="file" name="pic" style="display: none;" id="addPicFile" value="{{old('pic')}}">
                    <input type="hidden" name="ld_id" value="{{$metting->id}}">
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
            <form id="awardMod" class="form-horizontal m-t" enctype="multipart/form-data" method="post">
            <div class="modal-content animated bounceInRight">
                <div class="modal-body">
                   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">奖品修改</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <!-- 奖品名称 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">奖品名称：</label>
                        <div class="col-sm-8">
                            <input  name="name" id="modName" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <!-- 奖品数量 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">奖品数量：</label>
                        <div class="col-sm-8">
                            <input  name="num" id="modNum" class="form-control" type="number" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <!-- 奖品图片 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">奖品图片：</label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-primary" id="modChoi"> 选择图片</button>
                        </div>
                    </div>
                     <!-- 奖品图片 -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-8">
                            <img width="100px;" src="{{old('pic')}}" id="modPic">
                        </div>
                    </div>
                <div class="modal-footer">
                     <input type="file" name="pic" style="display: none;" id="modPicFile" value="{{old('pic')}}">
                     <input type="hidden" name="oldpic" id="modOldPic">
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
        // 普通上传
            //添加图片
            $('#addChoi').click(function(){
                $('#addPicFile').trigger('click');
            })
            $('#addPicFile').change(function(){
                var imgurl = getObjectURL(this.files[0]);
                // console.log(imgurl);
                $('#addPic').attr('src',imgurl);
            });

            //图片预览
            function getObjectURL(file){
                var url = null;
                if (window.createObjectURL!=undefined) {  
                  url = window.createObjectURL(file) ;  
                 } else if (window.URL!=undefined) { // mozilla(firefox)  
                  url = window.URL.createObjectURL(file) ;  
                 } else if (window.webkitURL!=undefined) { // webkit or chrome  
                  url = window.webkitURL.createObjectURL(file) ;  
                 }  
                 return url ;
            }

            //修改图片
            $('#modChoi').click(function(){
                $('#modPicFile').trigger('click');
            })
            $('#modPicFile').change(function(){
                var imgurl = getObjectURL(this.files[0]);
                // console.log(imgurl);
                $('#modPic').attr('src',imgurl);
            });
            $('.cgedit').click(function(){
                var name = $(this).parent().parent().parent().parent().prev().prev().prev().html();
                var modPic = $(this).parent().parent().parent().parent().prev().prev().find('img').attr('src');
                var num = $(this).parent().parent().parent().parent().prev().html();
                var oldPic = $(this).attr('pic');
                var url = $(this).attr('url');

                $('#modName').val(name);
                $('#modNum').val(num);
                $('#modOldPic').val(oldPic);
                $('#modPic').attr('src',modPic);
                $('#awardMod').attr('action',url);
            });
    </script>
@stop