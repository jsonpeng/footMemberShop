@extends('front.base1')

@section('css')
	<style type="text/css">
		.weui-label{
			width: 65px;
		}
		.card{
			padding: 25px 0;
			background-color: #fff;
		}
		.title{
			width: 90%;
			padding-left: 5%;
			padding-right: 5%;
			float: left;
			height: auto;
			line-height: 50px;
			font-size: 18px;
			border-bottom: 1px solid #F2F2F2;
		}
		.list{
			width: 90%;
			padding-left: 5%;
			padding-right: 5%;
			float: left;
			height: auto;
			margin-top: 20px;
		}
		.list ul{
			width: 100%;
			height: 100%;
			float: left;
			list-style: none;
		}
		.list ul li{
			width: 99%;
			height: auto;
			float: left;
			background-color: #FFFFFF;
			color: #7E181D;
			border-radius: 5px;
			border: 1px solid #7E181D;
			margin-bottom: 20px;
		}
		.list ul li span{
			width: 100%;
			height: 40px;
			line-height: 40px;
			float: left;
			text-align: center;
			font-size: 15px;
		}
		.list ul .active{
			background-color: #7E181D;
			color: #FFFFFF;
		}
		.zhushi{
			width: 90%;
			padding-left: 5%;
			padding-right: 5%;
			height: auto;
			float: left;
			line-height: 25px;
			font-size: 13px;
			color: #999;
		}
		.zhushi span{
			width: 100%;
			height: 40px;
			float: left;
			line-height: 40px;
			color: #666;
			font-size: 15px;
			border-bottom: 1px solid #F2F2F2;
		}

	</style>
@endsection


@section('content')
	
	<!--div>
		<div class="weui-cells__title">选择分店</div>
		<div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select" name="shop_id" id="shop_id">
                    @foreach ($shopes as $shop)
                		<option value="{{$shop->id}}">{{$shop->name}}</option>
                	@endforeach
                </select>
            </div>
        </div>

	    <div class="weui-btn-area">
				<a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips" onclick="pay()">支付</a>
	    </div>
    </div-->
    <div class="title">请选择就餐门店:</div>
	<div class="list">
		<ul>
			@foreach ($shopes as $shop)
				<li onclick="pay({{$shop->id}})">
					<span>{{$shop->name}}</span>
				</li>
        	@endforeach
			<!--li>
				<span>爱琴海店</span>
			</li>
			<li>
				<span>远洋未来店</span>
			</li>
			<li>
				<span>天河城店</span>
			</li-->
		</ul>
	</div>
	<div class="zhushi">
		<span>提示:</span>
		1、请点击您经常就餐的门店。<br/>
		2、金尊卡仅限在您选择的门店内使用。<br/>
		3、菜品价格应包含原材料成本、房租、人工、门店利润，持金尊卡的客人可享受仅包含原材料成本的菜品价格。
	</div>

@endsection


@section('js')
	<script type="text/javascript">
		function pay(shop_id) {
			event.preventDefault();
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
			$.ajax({
				url: '/buy_card',
				type: 'GET',
				data: {shop_id: shop_id, user_id: {{$user->id}} },
				success: function(data) {
	                //提示成功消息
	               	//console.log(data);
	               	//alert(data);
	               	//window.location.href = "/";
	               	if (data.code == 1) {
						alert(data.message);
						return;
					}

	               	data = JSON.parse(data.message)
	               	console.log(data);
	               	//data = JSON.parse(data)

			        /* global WeixinJSBridge:true */
			        WeixinJSBridge.invoke(
			          'getBrandWCPayRequest', {
			            'appId': data.appId, // 公众号名称，由商户传入
			            'timeStamp': data.timeStamp, // 时间戳，自1970年以来的秒数
			            'nonceStr': data.nonceStr, // 随机串
			            'package': data.package,
			            'signType': data.signType, // 微信签名方式：
			            'paySign': data.paySign // 微信签名
			          },
			          function (res) {
			            // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回ok，但并不保证它绝对可靠。
			            if (res.err_msg === 'get_brand_wcpay_request:ok') {
			            	window.location.href = '/index/';
			              //that.$router.push({ path: '/order/1' })
			            } else {
			              alert('支付失败,错误信息: ' + res.err_msg)
			            }
			          }
			        )
	            },
			});
		}
	</script>
	
@endsection