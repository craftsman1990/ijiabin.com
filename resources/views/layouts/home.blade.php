<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="嘉宾传媒、我有嘉宾、嘉宾大学、嘉宾吴婷、嘉宾派、商学教育、财经媒体、新商业媒体、新经济产业、企业赋能">
    <meta name="keywords" content="我有嘉宾、嘉宾大学、嘉宾传媒、嘉宾派、嘉宾吴婷、产业共同体、商学教育、财经媒体、商业媒体">
    <meta name="baidu-site-verification" content="45bn6ewMcr" />
    <title>@yield('title', '嘉宾大学')</title>
    <link rel="icon" type="image/x-icon" href={{asset("Home/images/wetalkTV.ico")}} />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="{{asset('Home/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('Home/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('Home/css/header.css')}}">
    <link rel="stylesheet" href="{{asset('Home/css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('Home/fonts/iconfont.css')}}">
    
</head>
<body>
    @yield('content')
</body>

</html>