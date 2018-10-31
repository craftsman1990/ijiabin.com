<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{asset('Mobile/metting/css/reset.css')}}">
  <title>Document</title>
  <style>
    .wrapper{
      width:100%;
      height:auto;
    }
    .top,.bot{
      padding:70px 0;
      width: 100%;
      text-align: center;
    }
    .btn-ks{
      border-radius: 0.3rem; 
      background-color: #4382D1; 
      color:#fff; border: none; 
      padding: 0.4rem 1rem;
      display: inline-block;
      width: 30%;
      height: 35px;
      margin: 0 15%;
    }

    .btn-js{
      border-radius: 0.3rem; 
      background-color: #DDD; 
      color:#fff; border: none; 
      padding: 0.4rem 1rem;
      display: inline-block;
      width: 30%;
      height: 35px;
      margin: 0 15%;
    }
  </style>
</head>
<body>
    <div class="wrapper">
      @foreach($data as $lucky)
      <div class="top">
        @if($lucky->status==1)
        <h4>第 {{$lucky->screening}} 场：<span>进行中</span></h4>
         <!-- <button class="btn-js" onclick="window.location.href='{{url('mobile/metting/doControl/status/0/ldid/'.$lucky->id)}}'">结束</button> -->
        @else
         <h4>第 {{$lucky->screening}} 场：<span>未开始</span></h4> 
         <button class="btn-ks" onclick="window.location.href='{{url('mobile/metting/doControl/status/1/ldid/'.$lucky->id)}}'">开始</button>
        @endif
      </div>
      @endforeach
    </div>

</body>
</html>