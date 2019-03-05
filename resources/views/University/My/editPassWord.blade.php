@extends('layouts.university')
@section('title','我的')
@section('content')
 	@include('layouts.admin_error')
 	<form action="" method="post">
 		密码：<input type="" name="password">
 		确认密码：<input type="" name="password_confirmation">
 		{{ csrf_field() }}
 		<input type="submit" name="" value="确认">
 	</form>
@stop