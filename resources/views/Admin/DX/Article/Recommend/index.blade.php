@extends('layouts.admin')
@section('title','文章推荐位')
@section('content')
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
                            <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加文章推荐位</button>
                        </div>
                        <form action="" >
                            <div class="form-group">
                                <div class="col-sm-1 juzhong"><label class="dinwei">推荐位：</label></div>
                                <div class="col-sm-2">
                                    <select class="form-control" name="rec_id">
                                        <option value="0">请选择推荐位</option>
                                        @if($data['recommend_info'])
                                            @foreach($data['recommend_info'] as $rec)
                                                <option value="{{$rec['id']}}" {{$data['rec_id'] == $rec['id'] ? 'selected' : ''}} >{{$rec['title']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-1 juzhong"><label class="dinwei">类别：</label></div>
                                <div class="col-sm-2">
                                    <select class="form-control" name="type">
                                        <option value="0">请选择类别</option>
                                        <option value="1" {{$data['type'] == 1 ? 'selected' : ''}} >文章</option>
                                        <option value="2" {{$data['type'] == 2 ? 'selected' : ''}} >视频</option>

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
                                <th>推荐位</th>
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
                                    <td class="center">{{$v->re_name}}</td>
                                    <td class="center">{{$v->created_at}}</td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                    <li><a href="{{url('admin/jbdx/article/recommend/delRecommend/id/'.$v->id.'/recommend_id/'.$v->recommend_id)}}" >取消推荐</a></li>
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
            <form id="categoryAdd" method="post" action={{url('admin/jbdx/article/recommend')}} class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加推荐位</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">文章ID：</label>
                        <div class="col-sm-8">
                            <input  name="aids" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 视频或文章最多可添加16个，多个ID用逗号(,)隔开</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">推荐位：</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="recommend_id">
                                <option value="0">请选择推荐位</option>
                                @if($data['recommend_info'])
                                    @foreach($data['recommend_info'] as $rec)
                                        <option value="{{$rec['id']}}" {{$data['rec_id'] == $rec['id'] ? 'selected' : ''}} >{{$rec['title']}}</option>
                                    @endforeach
                                @endif
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
@stop