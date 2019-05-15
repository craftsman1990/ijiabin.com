@extends('layouts.admin')
@section('title','添加弹幕')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <form action="{{url('admin/jbdx/content/bulletScreen/'.$bulletScreen->id)}}" class="form-horizontal m-t" method="POST" enctype="multipart/form-data">
                        @include('layouts.admin_error')
                        <!-- 弹幕时长 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">播放时长：</label>
                                <div class="col-sm-8">
                                    <input name="pace" class="form-control" type="number"  max="{{$content->time}}" min="0" value="{{old('pace')}}">
                                </div>
                            </div>
                            <!-- 章节内容 -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">弹幕内容：</label>
                                <div class="col-sm-8">
                                    <textarea id="content" style="width: 100%;height: 300px;resize: none;" name="text">{{$bulletScreen->text}}</textarea>
                                    <p><span id="text-content">500</span>/500</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="content_id" value="{{$bulletScreen->content_id}}"/>
                                    <input type="hidden" name="time" value="{{$content->time}}"/>
                                    <input type="hidden" name="user_id" value="{{$bulletScreen->user_id}}"/>
                                    <input type="hidden" name="_method" value="put"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/content/bulletScreen/'.$content['id'])}}" >返回</a>
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
        var intro = $('[name=intro').val();
        $("#text-intro").text(255-intro.length);
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
        var content = $('[name=text]').val();
        $("#text-content").text(-content.length);
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
