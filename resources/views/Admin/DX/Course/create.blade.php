@extends('layouts.admin')
@section('title','添加课程')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加课程</h5>
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
                        <form action="{{url('admin/jbdx/course')}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 用户名： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">课程名称：</label>
                                <div class="col-sm-8">
                                    <input  name="name" class="form-control" type="text"  value="{{old('name')}}" maxlength="30">
                                </div>
                            </div>
                            <!-- 授课老师： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">授课老师：</label>
                                <div class="col-sm-8">
                                    <input name="teacher" class="form-control" type="text" value="{{old('teacher')}}" maxlength="10">
                                </div>
                            </div>
                            <!-- 老师职称： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">老师职称：</label>
                                <div class="col-sm-8">
                                    <input name="professional" class="form-control" type="text" value="{{old('professional')}}" maxlength="20">
                                </div>
                            </div>
                            <!-- 类别： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">类别：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="ify">
                                         @foreach(config('jbdx.course_ify') as $k=>$ify)
                                        <option value="{{$k}}">{{$ify}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- E-mail： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">付费课：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="is_pay">
                                        <option value="0">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </div>
                            </div>
                             <!-- 价格 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">价格：</label>
                                <div class="col-sm-3">
                                    <input name="price" class="form-control" type="number" value="{{old('price')}}">
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <!-- 观看次数： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">观看次数：</label>
                                <div class="col-sm-3">
                                    <input name="looks" class="form-control" type="number" value="{{old('looks')}}">
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <!-- 横向封面图： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">横向封面图：</label>
                                <div class="col-sm-8">
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button> -->
                                    <button type="button" class="btn btn-primary choi-c"> 选择图片</button>
                                </div>
                            </div>
                             <!-- 横向封面图： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <img width="200px;" src="{{old('crosswise_cover')}}" id="crosswise_cover">
                                </div>
                            </div>
                            <!-- 纵向封面图： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">纵向封面图：</label>
                                <div class="col-sm-8">
                                    <button type="button" class="btn btn-primary choi-l"> 选择图片</button>
                                </div>
                            </div>
                             <!-- 纵向封面图： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <img height="200px;" src="{{old('lengthways_cover')}}" id="lengthways_cover">
                                </div>
                            </div>
                             <!-- 简介 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 300px;resize: none;" name="intro">{{old('intro')}}</textarea>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                    <p><span id="text-intro">1000</span>/1000</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <!-- <input type="hidden" name="crosswise_cover" value="{{old('crosswise_cover')}}"> -->
                                    <input type="file" name="crosswise_cover" style="display: none;" value="{{old('crosswise_cover')}}">
                                    <input type="file" name="lengthways_cover" style="display: none;" value="{{old('lengthways_cover')}}">
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
    <!-- @include('layouts.admin_picpro') -->
    <script type="text/javascript">
        //截图上传
            /*var sgw = $('[name=scre_gm_width]').val(),
                sgh = $('[name=scre_gm_height]').val(),
                ogw = $('[name=opt_gm_width]').val(),
                ogh = $('[name=opt_gm_height]').val();*/
            //图片比例 268:161
            /*var clipArea = new bjj.PhotoClip("#clipArea", {
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
                    $('#crosswise_cover').attr('src',dataURL);
                    $('[name=crosswise_cover]').attr('value',dataURL);
                }
            });*/
        
        //普通图片上传
        $('.choi-c').click(function(){
            $('[name=crosswise_cover]').trigger('click');
        })
        $('[name=crosswise_cover]').change(function(){
            var imgurl = getObjectURL(this.files[0]);
            // console.log(imgurl);
            $('#crosswise_cover').attr('src',imgurl);
        });  
        $('.choi-l').click(function(){
            $('[name=lengthways_cover]').trigger('click');
        })
        $('[name=lengthways_cover]').change(function(){
            var imgurl = getObjectURL(this.files[0]);
            // console.log(imgurl);
            $('#lengthways_cover').attr('src',imgurl);
        }); 
        //简介
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
