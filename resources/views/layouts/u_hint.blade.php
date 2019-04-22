
<!-- 提示信息(验证) -->
@if (count($errors) > 0)
	<div class="coverMsg error">{{$errors->all()[0]}}</div>
	<script type="text/javascript">
		$(".error").css("display","block");
				setTimeout(function(){//定时器 
					$(".error").css("display","none");
				},3000);
	</script>
@endif
<!-- 提示信息(失败) -->
@if(session('hint'))
<div class="coverMsg" id="hint">{{session('hint')}}</div>
<script type="text/javascript">
	$("#hint").css("display","block");
				setTimeout(function(){//定时器 
					$("#hint").css("display","none");
				},3000);
</script>
@endif