<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', '我有嘉宾_遍访天下公司、纪录时代商业')</title>
  <link rel="icon" type="image/x-icon" href="{{asset('Home/images/wetalkTV.ico')}}" />
  <link rel="stylesheet" href="{{asset('Mobile/fonts/iconfont.css')}}">
  <link rel="stylesheet" href="{{asset('Mobile/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('Mobile/css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('Mobile/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('Mobile/css/all.css')}}">
</head>
<body>
   @yield('content')
</body>
</html>