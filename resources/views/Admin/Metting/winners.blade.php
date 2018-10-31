@extends('layouts.admin')
@section('title',$metting->title)
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$metting->title}} 中奖</h5>
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
                                    <th>奖品名称</th>
                                    <th>中奖人昵称</th>
                                    <th>中奖人姓名</th>
                                    <th>中奖人电话</th>
                                    <th>地址</th>
                                    <th>是否派发</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($list as $v)
                                <tr class="gradeC">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->award_name}}</td>
                                    <td class="center">{{$v->nickname}}</td>
                                    <td class="center">{{$v->truename}}</td>
                                    <td class="center">{{$v->mobile}}</td>
                                    <td class="center">{{$v->address}}</td>
                                    <td>
                                        @if($v->is_receive == 1)
                                            <span class="label label-info">已派发</span>
                                        @else
                                            <span class="label label-danger">未派发</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{url('admin/metting/winnersDistribute/wid/'.$v->id)}}">派发</a></li>
                                                <!-- <li><a href="javascript:;" class="demo4">禁用</a></li> -->
                                                <li class="divider"></li>
                                                <!-- <li><a href="javascript:;" id="{{$v->id}}" class="delete" url="{{url('admin/metting/awardDestroy/'.$v->id)}}">删除</a> -->
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
@stop