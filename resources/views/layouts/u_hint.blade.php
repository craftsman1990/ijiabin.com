<!-- 提示信息(验证) -->
@if (count($errors) > 0)
<script type="text/javascript">
	alert("{{$errors->all()[0]}}");
</script>

@endif
<!-- 提示信息(失败) -->
@if(session('hint'))
<script type="text/javascript">
	alert("{{session('hint')}}")
</script>
@endif