@extends('layouts.university')
@section('title','我的嘉分')
@section('content')
 	{{$score->score}} 嘉分
 	<a href="{{url('university/my/aboutGuesteScore')}}">了解嘉分</a>
@stop