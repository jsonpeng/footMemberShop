@extends('front.base1')

@section('css')
	<style type="text/css">
		.weui-label{
			width: 65px;
		}

		input,button,select,textarea{
		outline:none;
		box-shadow:none;
		background:none;
		border: none;
		-webkit-tap-highlight-color:rgba(0,0,0,0); 

		}
		textarea{resize:none;-webkit-tap-highlight-color:rgba(0,0,0,0);}


		.oneitem {
			width: 100%;
			height: 100px;
			margin-top: 20px;
			position: relative;
			float: left;
		}

		.oneitem .logo {
			width: 180px;
			height: 90px;
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			margin: auto;
		}
		.twoitem{
			width: 94%;
			margin-top: 20px;
			height: auto;
			margin-left: 3%;
			float: left;
		}
		.twoitem .twoson{
			width: 100%;
			height: auto;
			float: left;
			border-bottom: 1px solid #f2f2f2;
		}
		.twoitem .twoson img{
			width: 25px;
			height: 25px;
			margin: 12.5px;
			float: left;
		}
		.twoitem .twoson input{
			width: 130px;
			height: 30px;
			line-height: 30px;
			float: left;
			font-size: 15px;
			margin-top: 10px;
		}
		.twoitem .twoson .huoqu{
			width: auto;
			height: 40px;
			margin-top: 10px;
			float: right;
		}
		.twoitem .twoson .huoqu span{
			width: 100px;
			height: 20px;
			margin-top: 5px;
			line-height: 20px;
			text-align: center;
			float: left;
			font-size: 15px;
			border-left: 1px solid #62b900;
			color: #62b900;
		}
		.denglu{
			width: 94%;
			height: 45px;
			line-height: 45px;
			margin-top: 50px;
			text-align: center;
			float: left;
			margin-left: 3%;
			background-color: #62b900;
			color: #FFFFFF;
			border-radius: 5px;
			font-size: 18px;
		}

	</style>

@endsection


@section('content')
	
	<!--div>
		<div class="weui-cells__title">注册</div>
	    <div class="weui-cell weui-cell_vcode">
	        <div class="weui-cell__hd">
	            <label class="weui-label">手机号</label>
	        </div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="tel" id="tel" name="mobile" placeholder="请输入手机号">
	        </div>
	        <div class="weui-cell__ft">
	            <button class="weui-vcode-btn" onclick="sendCode()" id="getcode">获取验证码</button>
	        </div>
	    </div>

	    <div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入验证码"  name="code" id="code">
	        </div>
	    </div>

	    <div class="weui-btn-area">
	        <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips" onclick="submit()">确定</a>
	    </div>
    </div-->
	<div class="oneitem">
		<img class="logo" src="{{ asset('img/logo.png') }}" />
	</div>
	<div class="twoitem">
		<div class="twoson">
			<img src="{{ asset('img/phone.png') }}" />
			<input placeholder="请输入手机号" id="tel" />
			<div class="huoqu">
				<span id="getcode" onclick="sendCode()">获取验证码</span>
			</div>
		</div>
		<div class="twoson">
			<img src="{{ asset('img/code.png') }}" />
			<input placeholder="请输入验证码" id="code" />
		</div>
	</div>
	<div class="denglu" onclick="submit()">
		登录
	</div>

@endsection

@section('js')
	<script type="text/javascript">
		function sendCode() {

			var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
			if(!myreg.test($("#tel").val())) 
			{ 
			    alert('请输入有效的手机号码！'); 
			    return false; 
			} 

			event.preventDefault();
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
			$.ajax({
				url: '/sendCode',
				type: 'GET',
				data: {mobile: $('#tel').val()},
			});

			time();
		}

		function submit() {
			var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
			if(!myreg.test($("#tel").val())) 
			{ 
			    alert('请输入有效的手机号码！'); 
			    return false; 
			} 
			if ($("#code").val() == '' || $("#code").val().length != 4) {
				alert('请输入有效验证码！'); 
			    return false; 
			}
			event.preventDefault();
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
			$.ajax({
				url: '/post_register',
				type: 'POST',
				data: {mobile: $('#tel').val(), code: $('#code').val()},
				success: function(data) {
	                //提示成功消息
	                if (data == '成功') {
	                	console.log(data);
	               		window.location.href = "/index/";
	                } else {
	                	alert('输入信息不正确');
	                }	               	
	            },
			});
		}

		var wait=60;
		function time() {
			o = $('#getcode');
			if (wait == 0) {
				o.removeAttr("disabled");   
				o.text("获取验证码");
				wait = 60;
			} else { 

				o.attr("disabled", true);
				o.text("重新发送(" + wait + ")");
				wait--;
				setTimeout(function() {
					time()
				}, 1000)
			}
		}

	</script>
@endsection
