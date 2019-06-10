<form id="update_status" action="" method="post" >
    <input type="hidden" name="status" id="status" value=""/>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    {{ csrf_field() }}
</form>
<script type="text/javascript">

    $('.update_status').on('click',function(){
        var url = $(this).attr('url');

        $('#status').val($(this).attr('data_status'));
        $('#status').value = $(this).attr('data_status');

        if ($(this).attr('data_status') == 1){
            var text = '下架后将无法购买，请谨慎操作！';
            var confirmButtonText = '下架'
        } else{
            var text = '上架后将正常购买！';
            var confirmButtonText = '上架'
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
