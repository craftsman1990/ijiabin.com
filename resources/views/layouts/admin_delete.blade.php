<form id="delete" action="" method="post" >
    {{ csrf_field() }}
    {{ method_field('DELETE') }} 
</form>
<script type="text/javascript">

    $('.delete').on('click',function(){
        var url = $(this).attr('url');
        $('#delete').attr('action',url);
       swal({
            title: "您确定要删除这条信息吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            closeOnConfirm: false
        }, function () {
            $('#delete').submit();
            })
    })

    function cancel(e){
        $('#delete').attr('action',e);
        swal({
            title: "您确定要删除这条信息吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            closeOnConfirm: false
        }, function () {
            $('#delete').submit();
            })
    }
</script>
