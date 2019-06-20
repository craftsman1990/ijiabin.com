@extends('layouts.admin')
@section('title','抓取内容添加')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>抓取内容添加</h5>
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
                        <form action="{{url('admin/jbdx/article/content')}}" class="form-horizontal m-t" id="signupForm" method="POST">
                            @include('layouts.admin_error')
                            <!-- 标题： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-8">
                                    <input  name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{$result['data']['article_title']}}">
                                </div>
                            </div>
                             <!-- 发布时间 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发布时间：</label>
                                <div class="col-sm-6">
                                    <input class="form-control layer-date" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" name="publish_time" value="<?php echo date('Y-m-d H:i:s',$result['data']['article_publish_time'])?>">
                                    <label class="laydate-icon"></label>
                                </div>
                            </div>
                            <!-- 发布者 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发布者：</label>
                                <div class="col-sm-8">
                                    <input name="author" class="form-control" type="text" value="{{$result['data']['article_author']}}">
                                </div>
                            </div>
                            <!-- 标签 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标签：</label>
                                <div class="col-sm-6">
                                     @foreach($result['data']['label'] as $label)
                                         <input type="checkbox" name="labels[]" value="{{$label['id']}}" onclick="oneChoice()" > {{$label['name']}}: <input type="number" style="width: 60px; display: inline-block" min="0.0" max="1.0" value="0.0" name="ranks" step="0.1" onclick="oneChoice()"> &ensp;
                                    @endforeach
                                </div>
                            </div>
                            <!-- 封面 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">封面：</label>
                                <div class="col-sm-8">
                                    <img width="100px;" src="{{asset($result['data']['article_cdn_url'])}}" id="cover">
                                </div>
                            </div>
                             <!-- 简介 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">简介：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 100px;resize: none;" name="intro">{{$result['data']['article_desc']}}</textarea>
                                    <p><span id="text-intro">80</span>/80</p>
                                    <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                </div>
                            </div>
                            <!-- 关键词 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">关键词：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" style="width: 100%;height: 100px;resize: none;" name="tag"></textarea>
                                    <p><span id="text-intro">80</span>/80</p>
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 多个标签用英文","逗号隔开</span>
                                </div>
                            </div>
                             <!-- 内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <div id="div1" style="border: 1px solid #ccc;"></div>
                                    <div id="editor" style="width: 100%;border: 1px solid #ccc;">
                                        {!!$result['data']['article_content']!!}
                                    </div>
                                    <textarea name="content" id="text1" style="display: none;">
                                    {{!!$result['data']['article_content']!!}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="_method" value="put"/>
                                    <input type="hidden" name="cg_id" value="{{$_GET['cg_id']}}"/>
                                    <input type="text" id ="label_id" name="label_id" style="display: none" >
                                    <input type="hidden" name="old_pic" value="{{asset($result['data']['article_cdn_url'])}}"/>
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
   <!--   {{--百度编辑器--}}
    <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.config.js")}}></script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.parse.js")}}></script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.all.min.js")}}> </script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/lang/zh-cn/zh-cn.js")}}></script>
    <script type="text/javascript">
        var ue = UE.getEditor('editor');
    </script> -->
     <!-- 编辑器 -->
    <script type="text/javascript" src="{{asset('release/wangEditor.js')}}"></script>
    <script type="text/javascript">
        //首次进入页面刷新一次
        $(document).ready(function () {
            if(location.href.indexOf("#reloaded")==-1){
                location.href=location.href+"#reloaded";
                location.reload();
            } 
        });
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
        //图片比例 268:151
        var clipArea = new bjj.PhotoClip("#clipArea", {
            size: [sgw,sgh],
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
    //普通上传
        /*$('.choi').click(function(){
            $('[name=cover]').trigger('click');
        })
        $('[name=cover]').change(function(){
            var imgurl = getObjectURL(this.files[0]);
            console.log(imgurl);
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
    // 限制
        var intro = $('[name=intro').val();
        $("#text-intro").text(80-intro.length);
        $('#intro').on('input propertychange',function(){
                     var $this = $(this),
                         _val = $this.val(),
                         count = "";
            if (_val.length > 80) {
                $this.val(_val.substring(0, 80));
            }
            count = 80 - $this.val().length;
            $("#text-intro").text(count);   
        });
    </script>
@stop
