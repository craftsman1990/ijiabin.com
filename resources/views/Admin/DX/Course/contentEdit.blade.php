@extends('layouts.admin')
@section('title','添加章节')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>章节修改</h5>
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
                        <form action="{{url('admin/jbdx/content/'.$content->id)}}" class="form-horizontal m-t" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 章节编号： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节编号：</label>
                                <div class="col-sm-3">
                                    <input name="chapter" class="form-control" type="number" value="{{$content->chapter}}">
                                </div>
                            </div>
                             <!-- 属性： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">属性：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="type">
                                        <option value="1" {{$content->type==1 ? 'selected' : ''}}>正课</option>
                                        <option value="0" {{$content->type==0 ? 'selected' : ''}}>试看</option>
                                    </select>
                                </div>
                            </div>
                                <!-- 更新上架： -->
                                <div class="form-group" >
                                    <label class="col-sm-3 control-label">更新上架：</label>
                                    <div class="col-sm-3">

                                        <select class="form-control" name="status">
                                            @if($content->status == 0)
                                                 <option value="0" {{$content->status==0 ? 'selected' : ''}}>否</option>
                                                 <option value="1" {{$content->status==1 ? 'selected' : ''}}>是</option>
                                            @else
                                                <option value="1" {{$content->status==1 ? 'selected' : ''}}>是</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            <!-- 章节标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节标题：</label>
                                <div class="col-sm-8">
                                    <input name="title" class="form-control" type="text" value="{{$content->title}}" maxlength="24">
                                </div>
                            </div>
                            <!-- 章节标签： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节标签：</label>
                                <div class="col-sm-8">
                                    <input name="label" class="form-control" type="text" value="{{$content->label}}" maxlength="20">
                                </div>
                            </div>
                            <!-- 章节简介： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 100px;resize: none;" name="intro">{{$content->intro}}</textarea>
                                    <p><span id="text-intro">105</span>/105</p>
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
                                     <img width="200px;" src="{{asset($content->cover)}}" id="cover">
                                 </div>
                             </div>
                            <!-- 章节视频 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节视频：</label>
                                <div class="col-sm-8">
                                    <input name="video" class="form-control" type="text" value="{{$content->video}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 填写视频地址</span>
                                </div>
                            </div>
                            <!-- 章节音频 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节音频：</label>
                                <div class="col-sm-8">
                                    <input name="audio" class="form-control" type="text" value="{{$content->audio}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 填写音频地址</span>
                                </div>
                            </div>
                            <!-- 章节时长： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节时长：</label>
                                <div class="col-sm-3">
                                    <input name="time" class="form-control" type="number" min="0" value="{{$content->time == 0 ? '': $content->time}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 音频和视频的时长(以s秒为单位)</span>
                                </div>
                            </div>
                            <!-- 章节试看时长： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节试看时长：</label>
                                <div class="col-sm-3">
                                    <input name="try_time" class="form-control" type="number" min="0"  value="{{$content->try_time == 0 ? '':$content->try_time }}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 音频和视频的试看时长(以s秒为单位)</span>
                                </div>
                            </div>
                           <!-- 章节内容： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <div id="div1" style="border: 1px solid #ccc;"></div>
                                    <div id="editor" style="width: 100%;border: 1px solid #ccc;">
                                            {!!$content->content!!}
                                    </div>
                                    <textarea name="content" id="text1" style="display: none;">{!!$content->content!!}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="course_id" value="{{$content->course_id}}"/>
                                    <input type="file" name="cover" style="display: none;" value="{{old('cover')}}">
                                    <input type="hidden" name="old_cover" value="{{$content->cover}}">
                                    <input type="hidden" name="_method" value="put"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course/'.$content->course_id)}}" >返回</a>
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

           var intro = $('[name=intro]').val();
            $("#text-intro").text(105-intro.length);
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
            var content = $('[name=content]').val();
            $("#text-content").text(1000-content.length);
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
