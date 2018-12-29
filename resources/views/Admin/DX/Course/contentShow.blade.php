 @extends('layouts.admin')
@section('title','自测题')
<style type="text/css">
    .duan{width: 10%;}
</style>
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>第 {{$content->chapter}} 节 自测题</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">选项 01</a>
                            </li>
                            <li><a href="#">选项 02</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                     <div class="">
                        <button class="btn btn-primary J_menuItem" data-toggle="modal" data-target="#myModalAdd">添加问题</button>
                        <a class="btn btn-outline btn-default" href="{{url('admin/jbdx/course/'.$content->course_id)}}">返回章节</a>
                    </div>
                    @include('layouts.admin_error')    

                    @foreach($list as $quiz)
                    <div class="faq-item">
                        <div class="row">
                            <div class="col-md-7">
                                <a data-toggle="collapse" href="faq.html#faq{{$quiz->id}}" class="">{{$quiz->title}}</a>
                            </div>
                            <div class="col-md-2 text-right">
                                <!-- <a class="small font-bold addAnswer" qid="{{$quiz->id}}" data-toggle="modal" data-target="#myModalAddAnswer">添加/修改答案 </a> -->
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="font-bold qaedit" data-toggle="modal" data-target="#myModalMod" url="{{url('admin/jbdx/quiz/'.$quiz->id)}}" qid="{{$quiz->id}}">修改</a></li>
                                        <li><a href="" class="addAnswer" qid="{{$quiz->id}}" data-toggle="modal" data-target="#myModalAddAnswer">添加/修改答案</a></li>
                                        <li class="divider"></li>
                                        <li><a href="javascript:;" id="{{$quiz->id}}" class="delete" url="{{url('admin/jbdx/quiz/'.$quiz->id)}}">删除</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="faq{{$quiz->id}}" class="panel-collapse collapse faq-answer">
                                    <p>
                                        @foreach($quiz->allAnswer as $answer)
                                        {{$answer->card}}、{{$answer->answer}}<br>
                                        @endforeach
                                       
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>   
     @include('layouts.admin_js')
    <script src="{{asset('Admin/js/plugins/footable/footable.all.min.js')}}"></script>
    <script src="{{asset('Admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});
    </script>
    @include('layouts.admin_delete')
    
    <!-- 弹框(添加问题) -->
    <div class="modal inmodal" id="myModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryAdd" method="post" action="{{url('admin/jbdx/quiz')}}" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加题目</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">问题：</label>
                        <div class="col-sm-8">
                            <textarea id="titleAdd" style="width: 100%;height: 60px;resize: none;" name="title">{{old('title')}}</textarea>
                            <p><span id="text-titleAdd">255</span>/255</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">正确答案：</label>
                        <div class="col-sm-8">
                            <input  name="answer" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">问题解析：</label>
                        <div class="col-sm-8">
                            <textarea id="analysisAdd" style="width: 100%;height: 60px;resize: none;" name="analysis">{{old('analysis')}}</textarea>
                            <p><span id="text-analysisAdd">255</span>/255</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="content_id" value="{{$content->id}}"/>
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >保存</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $('#titleAdd').on('input propertychange',function(){
            var $this = $(this),
                _val = $this.val(),
                count = "";
            if (_val.length > 255) {
                $this.val(_val.substring(0, 255));
            }
            count = 255 - $this.val().length;
            $("#text-titleAdd").text(count);   
        });
        $('#analysisAdd').on('input propertychange',function(){
            var $this = $(this),
                _val = $this.val(),
                count = "";
            if (_val.length > 255) {
                $this.val(_val.substring(0, 255));
            }
            count = 255 - $this.val().length;
            $("#text-analysisAdd").text(count);   
        });
    </script>

    <!-- 弹框(修改问题) -->
    <div class="modal inmodal" id="myModalMod" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="quizMod" method="post" action="" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">修改题目</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">问题：</label>
                        <div class="col-sm-8">
                            <textarea id="titleMod" style="width: 100%;height: 60px;resize: none;" name="title">{{old('title')}}</textarea>
                            <p><span id="text-titleMod">255</span>/255</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">正确答案：</label>
                        <div class="col-sm-8">
                            <input id="answerMod" name="answer" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">问题解析：</label>
                        <div class="col-sm-8">
                            <textarea id="analysisMod" style="width: 100%;height: 60px;resize: none;" name="analysis">{{old('analysis')}}</textarea>
                            <p><span id="text-analysisMod">255</span>/255</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }} 
                    <input type="hidden" name="content_id" value="{{$content->id}}"/>
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >保存</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $('.qaedit').click(function(){
            var updateUrl = $(this).attr('url'),
                qid = $(this).attr('qid'),
                url = "{{url('admin/jbdx/getQuiz')}}";
            $('#quizMod').attr('action',updateUrl);
             $.ajax({url:url,
                    type:'GET',
                    data:{qid:qid},
                    dataType:'json',
                    success:function(d){
                       if (d != 0) {
                            $('#titleMod').val(d.title);
                            $('#answerMod').val(d.answer);
                            $('#analysisMod').val(d.analysis);
                            var titleMod = $('#titleMod').val();
                            $("#text-titleMod").text(255-titleMod.length);
                            var analysisMod = $('#analysisMod').val();
                            $("#text-analysisMod").text(255-analysisMod.length);
                       }else{
                            alert('该条信息不存在，请刷新重试！');
                       }     
                    }
                });
        });
       
        $('#titleMod').on('input propertychange',function(){
            var $this = $(this),
                _val = $this.val(),
                count = "";
            if (_val.length > 255) {
                $this.val(_val.substring(0, 255));
            }
            count = 255 - $this.val().length;
            $("#text-titleMod").text(count);   
        });
        $('#analysisMod').on('input propertychange',function(){
            var $this = $(this),
                _val = $this.val(),
                count = "";
            if (_val.length > 255) {
                $this.val(_val.substring(0, 255));
            }
            count = 255 - $this.val().length;
            $("#text-analysisMod").text(count);   
        });
    </script>
    <!-- 弹框(添加答案) -->
    <div class="modal inmodal" id="myModalAddAnswer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryAdd" method="post" action="{{url('admin/jbdx/answer')}}" class="form-horizontal m-t">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">添加答案</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="duan">编号</th>
                                    <th>答案</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                         <div class="btn-group hidden-xs">
                                            <button type="button" class="btn btn-outline btn-default plus">
                                                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="quiz_id" value="1" id="quiz_id" />
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >保存</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function transhClick(){
            $('.trash').click(function(){
                $(this).parent().parent().parent().remove();
            });
        }
        var tr = '<tr><td class="duan"><input type="text" name="card[]" class="form-control"></td><td><input type="text" name="answer[]" class="form-control"></td><td><div class="btn-group hidden-xs"><button type="button" class="btn btn-outline btn-default trash"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button></div></td></tr>';
        $('.plus').click(function(){
            // console.log($(this).parent().parent().parent().parent().prev().html());
            $(this).parent().parent().parent().parent().prev().append(tr);
            transhClick();
        })
        

        $('.addAnswer').click(function(){
            var thisObj = $(this);
            var qid = thisObj.attr('qid');
            var url = "{{url('admin/jbdx/getAnswer')}}";
            $('#quiz_id').val(qid);
            $.ajax({url:url,
                    type:'GET',
                    data:{qid:qid},
                    dataType:'json',
                    success:function(d){
                        var html = '';
                        console.log(d);
                        if (d != 0) {
                            $.each(d,function(index,item){
                                html += '<tr>';
                                html += '<td class="duan"><input type="text" name="card[]" class="form-control" value="'+item.card+'"></td>';
                                html += '<td><input type="text" name="answer[]" class="form-control" value="'+item.answer+'"></td>';
                                html += '<td><div class="btn-group hidden-xs"><button type="button" class="btn btn-outline btn-default trash"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button></div></td>';
                                html += '</tr><input type="hidden" name="CRUD" value="1">';
                            });

                        }else{
                            html += tr+tr+tr;
                            html += '</tr><input type="hidden" name="CRUD" value="0">';
                        }
                        $('#tbody').empty().append(html);
                        transhClick();
                        // thisObj.prev().append(html);

                    }})
            // console.log(qid);
            // alert(123);
        });
    </script>
@stop