@extends('layouts.admin')
@section('title','导师学员')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>导师学员列表 {{$list->total()}}</h5>
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
                            <a href="tutorStudent/create" class="btn btn-primary J_menuItem">添加导师/学员</a>
                        </div>
                        @include('layouts.admin_error')
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th>姓名</th>
                                    <th>头像</th>
                                    <th>职位</th>
                                    <th>身份</th>
                                    <th>排序</th>
                                    <th>首页展示</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td><img src="{{asset($v->head_pic)}}" width="40px"></td>
                                    <td class="center">{{$v->position}}</td>
                                    <td class="center">
                                        @if($v->type == 1)
                                            <span class="label label-info">导师</span>
                                        @else
                                            <span class="label label-danger">学员</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <input type="text" name="sort" value="{{$v->sort}}" style="width: 50px;border: none;">
                                    </td>
                                    <td class="center">
                                        @if($v->show_index == 1)
                                            <span class="label label-info">是</span>
                                        @else
                                            <span class="label label-danger">否</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;">详情</a></li>
                                                <li><a href={{url("admin/tutorStudent/$v->id/edit")}} class="font-bold">修改</a></li>
                                                <li>
                                                    <a href="{{url('admin/tutorStudent/showIndex/id/'.$v->id)}}">{{$v->show_index == 1 ? '取消首页展示' : '设置首页展示'}}</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/tutorStudent/'.$v->id)}}">删除</a>
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
     <input type="hidden" name="url" value="{{url('admin/tutorStudent/changeSort')}}">   
     @include('layouts.admin_js')
    <script src={{asset("Admin/js/plugins/footable/footable.all.min.js")}}></script>
    <!-- <script src={{asset("Admin/js/plugins/layer/layer.min.js")}}></script> -->
    <script src={{asset("Admin/js/plugins/sweetalert/sweetalert.min.js")}}></script>
    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});
        $('[name=sort]').blur(function(){
            var id = $(this).parent().prev().prev().prev().prev().prev().text();
            var sort = $(this).val();
            var url = $('[name=url]').val();
            var changeUrl = url+'/id/'+id+'/sort/'+sort;
            $.ajax({
                url:changeUrl,
                type:'GET',
                success:function(d){
                    console.log(d);
                }
            });   
        });
    </script>
    @include('layouts.admin_delete')
@stop 