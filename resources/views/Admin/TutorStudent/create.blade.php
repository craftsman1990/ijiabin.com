@extends('layouts.admin')
@section('title','添加导师/学员')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加导师/学员</h5>
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
                        <form action={{url('admin/tutorStudent')}} class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 用户名： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">姓名：</label>
                                <div class="col-sm-3">
                                    <input  name="name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{old('name')}}">
                                </div>
                            </div>
                            <!-- 身份 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">身份：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="type">
                                        <option value="1">导师</option>
                                        <option value="2">学员</option>
                                    </select>
                                </div>
                            </div>
                            <!-- 职位 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">职位：</label>
                                <div class="col-sm-6">
                                    <input name="position" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{old('position')}}">
                                </div>
                            </div>
                            
                            <!-- 头像： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">头像：</label>
                                <div class="col-sm-8">
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button> -->
                                    <button type="button" class="btn btn-primary choi"> 选择图片</button>
                                    <span class="m-b-none" style="color:red;">
                                        <i class="fa fa-info-circle"></i> 为保证图片展示效果，请上传分辨率为570*790，小于100k的图片
                                    </span>
                                </div>
                            </div>

                            <!-- 头像-图片展示 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <img width="100px;" src="{{old('head_pic')}}" id="head_pic">
                                </div>
                            </div>

                            <!-- 经典语录 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">经典语录：</label>
                                <div class="col-sm-8">
                                    <textarea class="form-group" style="width: 100%;height: 150px;resize: none;" name="classic_quote">{{old('classic_quote')}}</textarea>
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 多条用；分开</span>
                                </div>
                            </div>

                            <!-- 简介 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">简介：</label>
                                <div class="col-sm-8">
                                    <textarea class="form-group" style="width: 100%;height: 150px;resize: none;" name="intro">{{old('intro')}}</textarea>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <!-- <input type="hidden" name="head_pic" value="{{old('head_pic')}}"> -->
                            <input type="file" name="head_pic" style="display: none;" value="{{old('head_pic')}}">
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href={{url("admin/tutorStudent")}} >返回</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin_js')
    <!-- @include('layouts.admin_picpro') -->
    <script type="text/javascript">
    //截图上传
        /*var stw = $('[name=scre_ts_width]').val(),
            sth = $('[name=scre_ts_height]').val(),
            otw = $('[name=opt_ts_width]').val(),
            oth = $('[name=opt_ts_height]').val();
        var clipArea = new bjj.PhotoClip("#clipArea", {
            size: [stw, sth],
            outputSize: [otw, oth],
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
                $('#head_pic').attr('src',dataURL);
                $('[name=head_pic]').attr('value',dataURL);
            }
        });*/
    // 普通上传
        $('.choi').click(function(){
            $('[name=head_pic]').trigger('click');
        })
        $('[name=head_pic]').change(function(){
            var imgurl = getObjectURL(this.files[0]);
            // console.log(imgurl);
            $('#head_pic').attr('src',imgurl);
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
    </script>
@stop
