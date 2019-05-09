<form id="update_status" action="" method="post" >
    <input type="hidden" name="status" id="status" value=""/>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
</form>
<script type="text/javascript">

    $('.update_status').on('click',function(){
        var url = $(this).attr('url');

        $('#status').val($(this).attr('data_status'));
         $('#status').value = $(this).attr('data_status');

        if ($(this).attr('data_status') == 1){
            var text = '禁用后将无法恢复，请谨慎操作！';
            var confirmButtonText = '禁用'
        } else{
            var text = '启用后将正常登录！';
            var confirmButtonText = '启用'
        }

        $('#update_status').attr('action',url);
        swal({
            title: "您确定要"+confirmButtonText+"这条信息吗",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: confirmButtonText,
            closeOnConfirm: false
        }, function () {
            $('#update_status').submit();
        })
    })

    function cancel(e){
        $('#update_status').attr('action',e);
        swal({
            title: "您确定要"+confirmButtonText+"这条信息吗",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: confirmButtonText,
            closeOnConfirm: false
        }, function () {
            $('#update_status').submit();
        })
    }
</script>