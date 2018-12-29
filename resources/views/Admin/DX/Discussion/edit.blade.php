@extends('layouts.admin')
@section('title','修改议题')
@section('content')
 
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>修改议题</h5>
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
                        <form action="{{url('admin/jbdx/discussion/'.$discussion->id)}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-8">
                                    <input  name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{$discussion->title}}">
                                </div>
                            </div>
                           
                           
                            <!-- 发布时间 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">出题时间：</label>
                                <div class="col-sm-6">
                                    <input class="form-control layer-date" placeholder="YYYY-MM-DD hh:mm:ss" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="time" value="{{$discussion->time}}">
                                    <label class="laydate-icon"></label>
                                </div>
                            </div>
                            <!-- 发布者 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">出题人：</label>
                                <div class="col-sm-8">
                                    <input name="author" class="form-control" type="text" value="{{$discussion->author}}">
                                </div>
                            </div>
                            
                            <!-- 封面 -->
                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">封面：</label>
                                <div class="col-sm-8">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button>
                                </div>
                            </div> -->
                            <!-- 封面 -->
                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <img width="100px;" src="{{old('cover')}}" id="cover">
                                </div>
                            </div> -->
                            <!-- 内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <div id="div1" style="border: 1px solid #ccc;"></div>
                                    <div id="editor" style="width: 100%;border: 1px solid #ccc;height: 800px;">
                                        {!! $discussion->content !!}
                                    </div>
                                    <textarea name="content" id="text1" style="display: none;">{!! $discussion->content !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="_method" value="put"/>
                                    <!-- <input type="hidden" name="cover" value="{{old('cover')}}"> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/discussion')}}" >返回</a>
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
    <!-- 截图上传 -->
    @include('layouts.admin_picpro')
    <!-- 编辑器 -->
    <script type="text/javascript" src="{{asset('release/wangEditor.js')}}"></script>
    <script type="text/javascript">
        var E = window.wangEditor
        var editor = new E('#div1','#editor')
        editor.customConfig.uploadImgServer = '/api/upload'  // 上传图片到服务器
        // editor.customConfig.debug=true;                // 开启调试

        var $text1 = $('#text1')
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html)
        }
        editor.create()
        // 初始化 textarea 的值
        $text1.val(editor.txt.html())
    </script>
    <script type="text/javascript">
        //截图上传
           /* var sgw = $('[name=scre_gm_width]').val(),
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
            });*/
        // 普通上传
            /*$('.choi').click(function(){
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
            }*/
    </script>
@stop
