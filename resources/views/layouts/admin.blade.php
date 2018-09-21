<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href={{asset("Admin/favicon.ico")}}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '嘉宾传媒')</title>
    <link href={{asset("Admin/css/bootstrap.min14ed.css?v=3.3.6")}} rel="stylesheet">
    <link href={{asset("Admin/css/font-awesome.min93e3.css?v=4.4.0")}} rel="stylesheet">

    <link href={{asset("Admin/css/plugins/iCheck/custom.css")}} rel="stylesheet">
    <link href={{asset("Admin/css/plugins/chosen/chosen.css")}} rel="stylesheet">
    <link href={{asset("Admin/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css")}} rel="stylesheet">
    <link href={{asset("Admin/css/plugins/cropper/cropper.min.css")}} rel="stylesheet">

    

    <link href={{asset("Admin/css/animate.min.css")}} rel="stylesheet">
    <link href={{asset("Admin/css/style.min862f.css?v=4.1.0")}} rel="stylesheet">
    <!-- Data Tables -->
    <link href={{asset("Admin/css/plugins/dataTables/dataTables.bootstrap.css")}} rel="stylesheet">
    <!-- Sweet Alert -->
    <link href={{asset("Admin/css/plugins/sweetalert/sweetalert.css")}} rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
     <link href="{{asset('Admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
</head>
<body class="gray-bg">
     @yield('content')
</body>
</html>