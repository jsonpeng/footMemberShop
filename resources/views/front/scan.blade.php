@extends('front.base1')

@section('css')
	<style type="text/css">
		.weui-label{
			width: 65px;
		}
		.card{
			padding: 25px;
			background-color: #fff;
		}

/*
		#video {  
    height: 400px;  
    width: 400px;  
    display: block;  
    margin: 0;  
    padding: 0;  
}  
#canvas {  
    height: 400px;  
    width: 800px;  
    display: block;  
    margin: 0;  
    padding: 0;  
}  
*/
	</style>
@endsection


@section('content')
	<!--div id="main">

		<div id="mainbody" style="display: inline;">
			<table class="tsel" border="0" width="100%">
			<tbody><tr>
			<td valign="top" align="center" width="50%">
			<table class="tsel" border="0">
			<tbody><tr>
			<td><img class="selector" id="webcamimg" src="vid.png" onclick="setwebcam()" align="left" style="opacity: 1;"></td>
			<td><img class="selector" id="qrimg" src="cam.png" onclick="setimg()" align="right" style="opacity: 0.2;"></td></tr>
			<tr><td colspan="2" align="center">
			<div id="outdiv"><video id="v" autoplay=""></video></div></td></tr>
			</tbody></table>
			</td>
			</tr>
			<tr><td colspan="3" align="center">
			<img src="down.png">
			</td></tr>
			<tr><td colspan="3" align="center">
			<div id="result">- scanning -</div>
			</td></tr>
			</tbody></table>
		</div>&nbsp;

	</div>
	<canvas id="qr-canvas" width="800" height="600" style="width: 800px; height: 600px;"></canvas-->

		
@endsection


@section('js')
	<!--script type="text/javascript" src="{{ asset('vendor/llqrcode.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/webqr.js') }}"></script>
	<script type="text/javascript">load();</script-->

<script type="text/javascript" charset="utf-8">
    wx.config({!!$jsconfig!!});
    wx.ready(function(){
	    wx.scanQRCode({
		    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
		    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
		    success: function (res) {
		    	var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
		    	alert(result);
			}
		});       
    });
    wx.error(function (res) {//错误时调用
        alert(res.errMsg);
    });
</script>
@endsection