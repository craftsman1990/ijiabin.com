@extends('layouts.admin')
@section('title','添加视频')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加视频</h5>
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
                        <form action="{{url('admin/video')}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-8">
                                    <input  name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{old('title')}}">
                                </div>
                            </div>
                            <!-- 视频地址 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">视频地址：</label>
                                <div class="col-sm-8">
                                    <input name="address" class="form-control" type="text" value="{{old('address')}}">
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <!-- 视频时长 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">视频时长：</label>
                                <div class="col-sm-8">
                                    <input name="duration" class="form-control" type="text" value="{{old('duration')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 时长格式：时：分：秒，例 00:21:46</span>
                                </div>
                            </div>
                            <!-- 分类 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类：</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="cg_id">
                                        @foreach($data['cate'] as $cate)
                                        <option value={{$cate['id']}}>{{$cate['cg_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- 导航 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">来源：</label>
                               <div class="col-sm-6">
                                <select class="form-control" name="nav_id">
                                    @foreach($data['nav'] as $nav)
                                    <option value={{$nav['id']}}>{{$nav['text']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <!-- 发布时间 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发布时间：</label>
                                <div class="col-sm-6">
                                    <input class="form-control layer-date" placeholder="YYYY-MM-DD hh:mm:ss" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="publish_time" value="{{old('publish_time')}}">
                                    <label class="laydate-icon"></label>
                                </div>
                            </div>
                            <!-- 发布者 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发布者：</label>
                                <div class="col-sm-8">
                                    <input name="author" class="form-control" type="text" value="{{old('author')}}">
                                </div>
                            </div>
                            <!-- 标签 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标签：</label>
                                <div class="col-sm-6">
                                    @foreach($data['label'] as $label)
                                        <input type="checkbox" name="labels[]" value="{{$label['name']}}" > {{$label['name']}}
                                    @endforeach
                                </div>
                            </div>
                            <!-- 封面 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">封面：</label>
                                <div class="col-sm-8">
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button> -->
                                    <button type="button" class="btn btn-primary choi"> 选择图片</button>
                                    <span class="m-b-none" style="color:red;">
                                        <i class="fa fa-info-circle"></i> 为保证图片展示效果，请上传分辨率为536*302，小于100k的图片
                                    </span>
                                </div>
                            </div>
                             <!-- 封面 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <img width="100px;" src="{{old('cover')}}" id="cover">
                                </div>
                            </div>
                            <!-- 简介 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">简介：</label>
                                <div class="col-sm-8">
                                    <textarea style="width: 100%;height: 80px;resize: none;" name="intro">{{old('intro')}}</textarea>
                                    <p><span id="text-intro">80</span>/80</p>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <!-- 内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <textarea style="width: 100%;height: 150px;resize: none;" name="content">{{old('content')}}</textarea>
                                    <p><span id="text-content">255</span>/255</p>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="cover" value="{{old('cover')}}">
                                    <input type="file" name="cover" style="display: none;" value="{{old('cover')}}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href={{url("admin/video")}} >返回</a>
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

    <!-- <script src={{asset("Admin/js/plugins/chosen/chosen.jquery.js")}}></script> -->
    <!-- <script src={{asset("Admin/js/demo/form-advanced-demo.min.js")}}></script> -->
    @include('layouts.admin_picpro')
    <script type="text/javascript">
    //截图上传
        /*var sgw = $('[name=scre_gm_width]').val(),
            sgh = $('[name=scre_gm_height]').val(),
            ogw = $('[name=opt_gm_width]').val(),
            ogh = $('[name=opt_gm_height]').val();
        //图片比例 814:513
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
        });*/
    // 普通上传
        $('.choi').click(function(){
            $('[name=cover]').trigger('click');
        })
        $('[name=cover]').change(function(){
            var imgurl = getObjectURL(this.files[0]);
            // console.log(imgurl);
            $('#cover').attr('src',imgurl);
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
    //简介
        $('[name=intro]').on('input propertychange',function(){
                     var $this = $(this),
                         _val = $this.val(),
                         count = "";
            if (_val.length > 80) {
                $this.val(_val.substring(0, 80));
            }
            count = 80 - $this.val().length;
            $("#text-intro").text(count);   
        });
    //内容
        $('[name=content]').on('input propertychange',function(){
                     var $this = $(this),
                         _val = $this.val(),
                         count = "";
            if (_val.length > 255) {
                $this.val(_val.substring(0, 255));
            }
            count = 255 - $this.val().length;
            $("#text-content").text(count);   
        });
    
    </script>
@stop
