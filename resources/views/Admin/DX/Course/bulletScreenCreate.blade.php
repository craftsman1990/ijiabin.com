@extends('layouts.admin')
@section('title','添加弹幕')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加弹幕</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="{{url('admin/jbdx/content/bulletScreen')}}" class="form-horizontal m-t" id="signupForm" method="POST" enctype="multipart/form-data">
                        @include('layouts.admin_error')
                        <!-- 属性： -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><label class="dinwei">用户名：</label></label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="user_id">
                                        <option value="0">请选择用户</option>
                                        @foreach($data['user'] as $nav)
                                            <option value="{{$nav['id']}}" {{$nav['id'] == $nav['id'] ? 'selected' : ''}}>{{$nav['nickname']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- 章节内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">章节内容：</label>
                                <div class="col-sm-8">
                                    <textarea id="content" style="width: 100%;height: 300px;resize: none;" name="text"></textarea>
                                    <p><span id="text-content">500</span>/500</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="content_id" value="{{$data['content_id']}}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default"  href="{{url('admin/jbdx/content/bulletScreen/'.$data['content_id'])}}" >返回</a>
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
        //内容
        $('#content').on('input propertychange',function(){
            var $this = $(this),
                _val = $this.val(),
                count = "";
            if (_val.length > 500) {
                $this.val(_val.substring(0, 500));
            }
            count = 500 - $this.val().length;
            $("#text-content").text(count);
        });
    </script>
@stop
