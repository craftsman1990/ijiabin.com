@extends('layouts.admin')
@section('title','修改课程')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>修改课程</h5>
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
                        <form action="{{url('admin/jbdx/course/'.$course->id)}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 用户名： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">课程名称：</label>
                                <div class="col-sm-8">
                                    <input  name="name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{$course->name}}">
                                </div>
                            </div>
                            <!-- 密码： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">授课老师：</label>
                                <div class="col-sm-8">
                                    <input name="teacher" class="form-control" type="text" value="{{$course->teacher}}">
                                </div>
                            </div>
                            <!-- 确认密码： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">老师职称：</label>
                                <div class="col-sm-8">
                                    <input name="professional" class="form-control" type="text" value="{{$course->professional}}">
                                </div>
                            </div>
                            <!-- 电话： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">类别：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="ify">
                                        @foreach(config('jbdx.course_ify') as $k=>$ify)
                                        <option value="{{$k}}" {{$k==$course->ify ? 'selected' : ''}} >{{$ify}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- E-mail： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">付费课：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="is_pay">
                                        <option value="0"  {{$course->is_pay==0 ? 'selected' : ''}}>否</option>
                                        <option value="1"  {{$course->is_pay==1 ? 'selected' : ''}}>是</option>
                                    </select>
                                </div>
                            </div>
                            <!-- 昵称： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">观看次数：</label>
                                <div class="col-sm-3">
                                    <input name="looks" class="form-control" type="number" value="{{$course->looks}}">
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <!-- 头像： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">封面图：</label>
                                <div class="col-sm-8">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button>
                                </div>
                            </div>
                             <!-- 头像： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <img width="100px;" src="{{asset($course->cover)}}" id="cover">
                                </div>
                            </div>
                             <!-- 简介 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 300px;resize: none;" name="intro">{{$course->intro}}</textarea>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                    <p><span id="text-intro">1000</span>/1000</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="_method" value="put"/>
                                    <input type="hidden" name="cover" value="{{old('cover')}}">
                                    <input type="hidden" name="old_cover" value="{{$course->cover}}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course')}}" >返回</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin_js')
    @include('layouts.admin_picpro')
    <script type="text/javascript">
        //截图上传
            var sgw = $('[name=scre_gm_width]').val(),
                sgh = $('[name=scre_gm_height]').val(),
                ogw = $('[name=opt_gm_width]').val(),
                ogh = $('[name=opt_gm_height]').val();
            //图片比例 268:161
            var clipArea = new bjj.PhotoClip("#clipArea", {
                size: [sgw, sgh],
                outputSize: [ogw, ogh],
                file: "#file",
                view: "#view",
                ok: "#clipBtn",
                loadStart: function() {
                    console.log("照片读取中");
                },
                loadComplete: function() {
                    console.log("照片读取完成");
                },
                clipFinish: function(dataURL) {
                    // console.log(dataURL);
                    $('#cover').attr('src',dataURL);
                    $('[name=cover]').attr('value',dataURL);
                }
            });
            var apic = $('[name=old_cover]').val();
            $('.quxiao').click(function(){
                $('#cover').attr('src',apic)
            })
            //简介
            var intro = $('[name=intro').val();
            $("#text-intro").text(1000-intro.length);
            $('#intro').on('input propertychange',function(){
                var $this = $(this),
                    _val = $this.val(),
                    count = "";
                if (_val.length > 1000) {
                    $this.val(_val.substring(0, 1000));
                }
                count = 1000 - $this.val().length;
                $("#text-intro").text(count);   
            });
    </script>
@stop
