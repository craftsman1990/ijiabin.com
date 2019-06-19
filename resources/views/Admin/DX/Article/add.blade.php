@extends('layouts.admin')
@section('title','公众号导入数据')
@section('content')
 
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>公众号导入数据</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action={{url('admin/jbdx/article/add')}} class="form-horizontal m-t" id="signupForm" method="GET">
                            @include('layouts.admin_error')
                           <!-- 分类 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类：</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="cg_id">
                                        @foreach($data['cate'] as $cate)
                                        <option value={{$cate['id']}} {{$cate['id'] == '3' ? 'selected' : ''}}>{{$cate['cg_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- 标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公众号文章地址：</label>
                                <div class="col-sm-8">
                                    <input  name="url" class="form-control" type="url" aria-required="true" aria-invalid="true" class="error" value="" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">抓取</button>
                                    <a class="btn btn-outline btn-default" href={{url("admin/jbdx/article")}} >返回</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin_js')
    <script src={{asset("Admin/js/plugins/layer/laydate/laydate.js")}}></script>
    @include('layouts.admin_picpro')
    <script type="text/javascript" src="{{asset('release/wangEditor.js')}}"></script>
    
