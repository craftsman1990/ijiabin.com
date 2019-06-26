@extends('layouts.admin')
@section('title','添加章节')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加章节</h5>
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
                        <form action="{{url('admin/jbdx/content')}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 章节编号： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节编号：</label>
                                <div class="col-sm-3">
                                    <input name="chapter" class="form-control" type="number" value="{{old('chapter')}}">
                                </div>
                            </div>
                             <!-- 属性： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">属性：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="type">
                                        <option value="1">正课</option>
                                        <option value="0">试看</option>
                                    </select>
                                </div>
                            </div>
                                <!-- 是否上架： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否上架：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="status">
                                        <option value="0">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </div>
                            </div>
                            <!-- 章节标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节标题：</label>
                                <div class="col-sm-8">
                                    <input name="title" class="form-control" type="text" value="{{old('title')}}" maxlength="24">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>最多可输入24个字</span>
                                </div>
                            </div>
                            <!-- 是否更新： -->
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">是否更新：</label>
                                 <div class="col-sm-3">
                                    <select class="form-control" name="updated">
                                         <option value="0">否</option>
                                         <option value="1">是</option>
                                    </select>
                                 </div>
                            </div>
                            <!-- 章节标签： -->
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">章节标签：</label>
                                 <div class="col-sm-8">
                                     <input name="label" class="form-control" type="text" value="{{old('label')}}" maxlength="3">
                                     <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 最多可输入3个字</span>
                                 </div>
                             </div>
                            <!-- 章节简介： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 100px;resize: none;" name="intro">{{old('intro')}}</textarea>
                                    <p><span id="text-intro">105</span>/105</p>
                                </div>
                            </div>
                            <!-- 横向封面图： -->
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">横向封面图：</label>
                                  <div class="col-sm-8">
                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button> -->
                                     <button type="button" class="btn btn-primary choi-c"> 选择图片</button>
                                      <span class="m-b-none" style="color:red;">
                                        <i class="fa fa-info-circle"></i> 为保证图片展示效果，请上传分辨率为780*438，小于100k的图片
                                    </span>
                                   </div>
                            </div>
                            <!-- 横向封面图： -->
                             <div class="form-group">
                                 <label class="col-sm-3 control-label"></label>
                                  <div class="col-sm-8">
                                      <img width="200px;" src="{{old('cover')}}" id="cover">
                                  </div>
                             </div>

                            <!-- 章节视频 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节视频：</label>
                                <div class="col-sm-8">
                                    <input name="video" class="form-control" type="text" value="{{old('video')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 填写视频地址</span>
                                </div>
                            </div>
                            <!-- 章节音频 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节音频：</label>
                                <div class="col-sm-8">
                                    <input name="audio" class="form-control" type="text" value="{{old('audio')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 填写音频地址</span>
                                </div>
                            </div>
                            <!-- 章节时长： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节时长：</label>
                                <div class="col-sm-3">
                                    <input name="time" class="form-control"  type="number" min="0"   value="{{old('time')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 音频和视频的时长(以s秒为单位)</span>
                                </div>
                            </div>
                                <!-- 章节试看时长： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节试看时长：</label>
                                <div class="col-sm-3">
                                    <input name="try_time" class="form-control" type="number" min="0"  value="{{old('try_time')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 音频和视频的试看时长(以s秒为单位)</span>
                                </div>
                            </div>
                            <!-- 内容 -->
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">内容：</label>
                                    <div class="col-sm-8">
                                        <!-- 加载编辑器内容 -->
                                     <div id="div1" style="border: 1px solid #ccc;"></div>
                                     <div id="editor" style="width: 100%;border: 1px solid #ccc;height: 500px;">
                                            {!!old('content')!!}
                                     </div>
                                     <textarea name="content" id="text1" style="display: none;">{!!old('content')!!}</textarea>
                                  </div>
                             </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="file" name="cover" style="display: none;" value="{{old('cover')}}">
                                    <input type="hidden" name="course_id" value="{{$request->course_id}}"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course/'.$request->course_id)}}" >返回</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin_js')

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
{{--    @include('layouts.admin_picpro')--}}
    <script type="text/javascript">

        //普通图片上传
        $('.choi-c').click(function(){
            $('[name=cover]').trigger('click');
        });
        $('[name=cover]').change(function(){
            var imgurl = getObjectURL(this.files[0]);
            // console.log(imgurl);
            $('#cover').attr('src',imgurl);
        });

        //简介
            $('#intro').on('input propertychange',function(){
                var $this = $(this),
                    _val = $this.val(),
                    count = "";
                if (_val.length > 105) {
                    $this.val(_val.substring(0, 105));
                }
                count = 105 - $this.val().length;
                $("#text-intro").text(count);
            });
            //内容
            $('#content').on('input propertychange',function(){
                var $this = $(this),
                    _val = $this.val(),
                    count = "";
                if (_val.length > 1000) {
                    $this.val(_val.substring(0, 1000));
                }
                count = 1000 - $this.val().length;
                $("#text-content").text(count);
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
