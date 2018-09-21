<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield('title', '嘉宾大学')</title>
    <link rel="icon" type="image/x-icon" href={{asset("Home/images/wetalkTV.ico")}} />
    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/normalize/4.2.0/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Home/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href={{asset("Home/css/all.css")}}>
    <link rel="stylesheet" href={{asset("Home/css/header.css")}}>
    <link rel="stylesheet" href={{asset("Home/css/footer.css")}}>
    <link rel="stylesheet" href={{asset("Home/fonts/iconfont.css")}}>
    
</head>
<body>

            @yield('content')
    

</body>

</html>