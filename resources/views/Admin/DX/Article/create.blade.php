@extends('layouts.admin')
@section('title','添加新文章')
@section('content')
 
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加新文章</h5>
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
                        <form action="{{url('admin/jbdx/article')}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                            @include('layouts.admin_error')
                            <!-- 标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-8">
                                    <input  name="title" maxlength="24" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{old('title')}}">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 最多可输入24个字</span>
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
                            <!-- 栏目 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">栏目：</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="column_id">
                                        <option value = 0 >请选择栏目</option>
                                        @foreach($data['column'] as $column)
                                            <option value={{$column['id']}}>{{$column['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- 标签 -->
                            <div class="form-group ">
                                <label class="col-sm-3 control-label">标签：</label>
                                <div class="col-sm-8">
                                    <table class="line" style="float: left;" border="0">
                                        @foreach($data['label'] as $value)
                                            <tr>
                                            @foreach($value as $label)
                                               <td style="width: 23%"> <input type="checkbox"  style="width: 20px; display: inline-block; margin-bottom: 6px;" name="labels[]" value="{{$label['id']}}" onclick="oneChoice()" > {{$label['name']}}: <input type="number" style="width: 60px; display: inline-block; margin-bottom: 6px;" min="0.0" max="1.0" value="0.0" name="ranks" step="0.1" onclick="oneChoice()"></td>
                                            @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                    <span class="help-block m-b-none" style="float: left;display:block;width:100%;"><i class="fa fa-info-circle"></i> 标签个数(2-5),权重(0.1-1.0)</span>

                                </div>
                            </div>
                            <!-- 关键字： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">关键字：</label>
                                <div class="col-sm-6">
                                    <input name="tag" class="form-control" type="text" value="{{old('tag')}}" maxlength="105">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 关键字，多个用，隔开(个数最多5个，最大字数8个字符）</span>
                                </div>
                            </div>
                            <!-- 封面 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">封面：</label>
                                <div class="col-sm-8">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> 选择图片</button>
                                    <!-- <button type="button" class="btn btn-primary choi"> 选择图片</button> -->
                                    <span class="m-b-none" style="color:red;">
                                        <i class="fa fa-info-circle"></i> 为保证图片展示效果，请上传分辨率为780*438，小于100k的图片
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
                                    <textarea id="intro" style="width: 100%;height: 100px;resize: none;" name="intro">{{old('intro')}}</textarea>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                    <p><span id="text-intro">30</span>/30</p>
                                </div>
                            </div>

                             <!-- 内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <!-- 加载编辑器内容 -->
                                    <!-- <script id="editor" type="text/pslain" style="height:600px;" name="content">{!!old('content')!!}</script> -->
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                    <div id="div1" style="border: 1px solid #ccc;"></div>
                                    <div id="editor" style="width: 100%;border: 1px solid #ccc;height: 800px;">
                                        {!!old('content')!!}
                                    </div>
                                    <textarea name="content" id="text1" style="display: none;">{!!old('content')!!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="cover" value="{{old('cover')}}">
                                    <input type="text" id ="label_id" name="label_id" style="display: none" >
                                    <!-- <input type="file" name="cover" style="display: none;" value="{{old('cover')}}"> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
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

    <!-- <script src={{asset("Admin/js/plugins/chosen/chosen.jquery.js")}}></script> -->
    <!-- <script src={{asset("Admin/js/demo/form-advanced-demo.min.js")}}></script> -->
    <!-- 截图上传 -->
    @include('layouts.admin_picpro')

    {{--百度编辑器--}}
    <!-- <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.config.js")}}></script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.all.min.js")}}> </script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/lang/zh-cn/zh-cn.js")}}></script>
    <script type="text/javascript">
        var ue = UE.getEditor('editor');
    </script> -->
    <!-- 编辑器 -->
    <script type="text/javascript" src="{{asset('release/wangEditor.js')}}"></script>
    <script type="text/javascript">
        //下拉选复选框单选事件
        function oneChoice(){
            var obj_l = $('[name="labels[]"]');
            var obj_r = $('[name="ranks"]');
            check_val = [];
            for(k in obj_l){
                if(obj_l[k].checked)
                    check_val.push(obj_l[k].value+':'+obj_r[k].value)
            }

            $('#label_id').val(check_val);

            var d = $('#label_id').val();
            console.log(d);
        }


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
        //简介
            $('#intro').on('input propertychange',function(){
                var $this = $(this),
                    _val = $this.val(),
                    count = "";
                if (_val.length > 30) {
                    $this.val(_val.substring(0, 30));
                }
                count = 30 - $this.val().length;
                $("#text-intro").text(count);   
            });
    </script>
@stop
