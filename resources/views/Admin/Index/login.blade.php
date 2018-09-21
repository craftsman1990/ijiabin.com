@extends('layouts.admin')
@section('title','登录')
@section('content')
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">J+</h1>

            </div>
            <h3>嘉宾传媒 管理平台</h3>
            <form class="m-t" role="form" action="{{url('admin/login')}}" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" name="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" name="password">
                </div>
                {{ csrf_field() }}

                @include('layouts.admin_error')
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
                <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
                </p>

            </form>
        </div>
    </div>
    <script src={{asset("Admin/js/jquery.min.js?v=2.1.4")}}></script>
    <script src={{asset("Admin/js/bootstrap.min.js?v=3.3.6")}}></script>
@stop
