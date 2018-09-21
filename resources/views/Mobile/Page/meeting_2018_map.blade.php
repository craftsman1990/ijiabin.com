<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>年会地图</title>
  <link rel="icon" type="image/x-icon" href="{{asset('Home/images/meeting.ico')}}" /> 
  <link rel="stylesheet" href="{{asset('Mobile/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('Mobile/css/meeting.css')}}">
</head>
<body> 
   <div id="container"></div>
</body>  
</html>  
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=Ddk4dEgl09mEERDAV94xx6SgeyWmzw8V"></script>
<script type="text/javascript">  
 
    var map = new BMap.Map("container"); 
    var point = new BMap.Point(113.899711,22.477291); 
    map.centerAndZoom(point, 15);  
    var marker = new BMap.Marker(point);  // 创建标注
    map.addOverlay(marker);               // 将标注添加到地图中
    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画


    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            //map.panTo(r.point);//地图中心点移到当前位置
            var latCurrent = r.point.lat;
            var lngCurrent = r.point.lng;
            //alert('我的位置：'+ latCurrent + ',' + lngCurrent);
              location.href="http://api.map.baidu.com/direction?origin="+latCurrent+","+lngCurrent+"&destination=22.477291,113.899711&mode=driving&region=北京&output=html";
        }
        else {
            alert('failed'+this.getStatus());
        }        
    },{enableHighAccuracy: true})
 
 
 
</script>