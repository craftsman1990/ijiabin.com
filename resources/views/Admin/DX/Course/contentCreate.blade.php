@extends('layouts.admin')
@section('title','添加章节')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
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
                            <!-- 章节标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节标题：</label>
                                <div class="col-sm-8">
                                    <input name="title" class="form-control" type="text" value="{{old('title')}}">
                                </div>
                            </div>
                            <!-- 章节简介： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 100px;resize: none;" name="intro">{{old('intro')}}</textarea>
                                    <p><span id="text-intro">255</span>/255</p>
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
                                    <input name="time" class="form-control" type="text" value="{{old('time')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 音频和视频的时长</span>
                                </div>
                            </div>
                             <!-- 章节内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节内容：</label>
                                <div class="col-sm-8">
                                    <textarea id="content" style="width: 100%;height: 300px;resize: none;" name="content">{{old('content')}}</textarea>
                                    <p><span id="text-content">1000</span>/1000</p>
                                    

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
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
    <script type="text/javascript">
       
            //简介
            $('#intro').on('input propertychange',function(){
                var $this = $(this),
                    _val = $this.val(),
                    count = "";
                if (_val.length > 255) {
                    $this.val(_val.substring(0, 255));
                }
                count = 255 - $this.val().length;
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
    </script>
@stop
