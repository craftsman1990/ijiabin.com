<!DOCTYPE html>
<html lang="en">

<head>
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<title>微信公众号支付</title>
  	<link rel="icon" type="image/x-icon" href="{{asset('University/images/wetalkTV.ico')}}" />
  	
	<script src="{{asset('University/js/jquery.min.js')}}"></script>
  	<script src="{{asset('University/js/swiper.min.js')}}"></script>
  	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
	<div>
		<p>订单号：{{$order['out_trade_no']}}</p>
		<p>订单名称：{{$order['body']}}</p>
		<p>订单金额：{{$order['total_fee']}}</p>
		<button onclick="onBridgeReady()">确认支付</button>
	</div>

	<script type="text/javascript">

	 	function onBridgeReady(){
		   WeixinJSBridge.invoke(
		      'getBrandWCPayRequest', {
		         "appId":"{{$wechat_pay->appId}}",     //公众号名称，由商户传入     
		         "timeStamp":"{{$wechat_pay->timeStamp}}",         //时间戳，自1970年以来的秒数     
		         "nonceStr":"{{$wechat_pay->nonceStr}}", //随机串     
		         "package":"{{$wechat_pay->package}}",     
		         "signType":"MD5",         				//微信签名方式：     
		         "paySign":"{{$wechat_pay->paySign}}" //微信签名 
		      },
		      function(res){
		      if(res.err_msg == "get_brand_wcpay_request:ok" ){
		      // 使用以上方式判断前端返回,微信团队郑重提示：
		            //res.err_msg将在用户支付成功后返回ok，但并不保证它绝对可靠。
		            console.log('支付成功');
		      } 
		   }); 
		}

		if (typeof WeixinJSBridge == "undefined"){
		   if( document.addEventListener ){
		       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
		   }else if (document.attachEvent){
		       document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
		       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
		   }
		}else{
		   onBridgeReady();
		}
	</script>
</body>
</html>