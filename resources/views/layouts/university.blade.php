<!DOCTYPE html>
<html lang="en">

<head>
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<title>@yield('title', '嘉宾大学')</title>
  	<link rel="icon" type="image/x-icon" href="{{asset('University/images/wetalkTV.ico')}}" />
  	
	<script src="{{asset('University/js/jquery.min.js')}}"></script>
  	<script src="{{asset('University/js/swiper.min.js')}}"></script>
</head>
<body>
	@yield('content')
</body>
</html>