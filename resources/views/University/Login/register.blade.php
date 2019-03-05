@extends('layouts.university')
@section('title','注册')
@section('content')
 	@include('layouts.admin_error')
	<form action="" method="post">
		<input type="text" name="mobile">
		<a href="javascript:;">发送验证码</a><br>
		<input type="text" name="yzm">
		
		{{ csrf_field() }}
		<button>注册</button>
	</form>
 	<a href="{{url('university/login')}}">密码登陆</a>
 	<a href="{{url('university/quickLogin')}}">快速登陆</a>
@stop