@extends('front.base1')

<link rel="stylesheet" href="{{ asset('css/vendor/MyCart.css') }}">

@section('css')
	<style type="text/css">
		.weui-label{
			width: 65px;
		}

		.weui-btn-area{
			text-align: center;
			margin-top: 50px;
		}
		
		.birthday{
		    position: absolute;
		    bottom: 30px;
		    left: 10px;
		    font-size: 12px;
		    color: #666;
		}

		.card_date{
			width: 130px;
			height: 30px;
			line-height: 30px;
			/*background: red;*/
			position: absolute;
			bottom: -15px;
			right: 10px;
		}
		p.youxiaoqi{
			font-family: "simsun";
			font-size: 14px;
			
		}


		.coupon{
			position: relative;
			height: 60px;
			width: 100%;
		}
		
		.coupon .price{
			position: absolute;
			left: 5px;
			top: 5px;
			bottom: 5px;
			width: 100px;
			font-size: 36px;
			font-weight: bold;
		}
		.coupon .price span{
			font-size: 24px;
		}

		/*优惠券*/
		.title{ width: 100%; height: 40px; line-height: 40px; float: left; font-size: 18px; color: #666; padding-left: 3%; border-bottom: 1px solid #ccc; margin-bottom: 5px;}
			/*62b900*/
		.list{ width: 94%; height: auto; margin-left: 3%; margin-right: 3%; float: left;}
		.list ul{ width: 100%; height: 100%; float: left;}
		.list ul li{ width: 100%; height: auto; float: left; border:1px solid #ccc; border-radius: 5px; margin-bottom: 20px; box-sizing: border-box;}
		.list ul li .upitem{text-align: left; width: 100%; height: auto; background-image: url({{ asset('img/backyouhui.png') }}); background-position: center; background-size: 50% 100%; float: left; border-radius: 5px 5px 0 0;}
		.list ul li .overtime{background-image: url( {{ asset('img/backyouhuiguo.png') }});}
		.list ul li .upitem .one{ width: 50px; height: 50px; float: left; border-radius: 25px; margin: 15px 5px 15px 5px;}
		.list ul li .upitem .two{ width: auto; height: 20px; line-height: 20px; float: left; font-size: 15px; color: #fff; margin-top: 45px;}
		.list ul li .upitem .three{  width: auto; height: 60px; line-height: 60px; float: left; font-size: 45px; color: #fff; margin-top: 10px;}
		.list ul li .upitem .sonitem{ margin-left: 6px; width: 140px; height: 60px; float: left;margin-top: 15px;}
		.list ul li .upitem .sonitem .four{ width: 100%; height: 25px; line-height: 25px; float: left; font-size: 18px; color: #fff;}
		.list ul li .upitem .sonitem .five{ width: 100%; height: 22px; line-height: 22px; float: left; font-size: 23px; color: #fff;}
		.list ul li .downitem{text-align: left; margin-top: 10px; margin-bottom: 10px; width: 90%; margin-left: 5%; height: auto; float: left; color: #666; font-size: 16px;}
		.list ul li .downitem .one{ width: 50%; height: auto; float: left; line-height: 30px;}
		.list ul li .downitem .two{ width: 50%; height: auto; float: left; line-height: 30px;}
		.list ul li .downitem .three{ width: 100%; height: auto; float: left; line-height: 30px;}

		body{background-color: #eee;}
	</style>
@endsection


@section('content')
	
		@if ($cards->count() > 0)
			<?php $card = $cards->first(); ?>
			<div class="black_bg">
				<div class="cart">
					<img src="../css/vendor/img/cart1.png" />
					<p class="name"><img src="../css/vendor/img/logo1.png" class="img-responsive"/></p>
					<div class="cart_num">
						<p class="kahao">会员卡号</p>
						<p class="number">{{$card->card_no}}</p>
					</div>
					<div class="card_date">
						<p class="youxiaoqi">有效期：<span class="date">{{$card->end->format('Y-m-d')}}</span></p>
					</div>
				</div>
			</div>

			<div class="weui-btn-area">
	    		<div class="btn" onclick="scan()">
					<a href="#" class="btn-block">扫码买单</a>
				</div>

				<div class="weui-btn weui-btn_default" onclick="manual()">
					手动买单
				</div>

		    </div>

			<div class="jifen">
				<ul>
					<li>
						<img src={!! asset("../css/vendor/img/3_13.png") !!} align="middle"/>
						<div class="pr">
							<a href="#">手机号</a>
							<span>{{$user->mobile}}</span>
						</div>
					</li>
					<li>
						<img src="../css/vendor/img/3_18.png"/>
						<div class="pr">
							<a @if ($user->shenfenzheng) href="/birthday" @else  href="/realname" @endif target="_blank">个人信息</a>
							@if (!$user->shenfenzheng)
								<span>完善</span>
							@else
								<img src={!! asset("../css/vendor/img/vrz.png") !!} style="position: absolute; right: 40px; top: 0;">
							@endif
							<i><img src="../css/vendor/img/6_13.png"></i>
						</div>
					</li>
				</ul>
			</div>
			<p class="huodong">商家优惠活动</p>
			<div class="youhui">
				<ul>
					<li>
						<img src="../css/vendor/img/3_14.png"/>
						<div class="pr">
							<a href="/user_coupons">优惠券</a>
							<i><img src="../css/vendor/img/6_13.png" \></i>
						</div>
					</li>
					<li>
						<img src="../css/vendor/img/3_14.png"/>
						<div class="pr">
							<a href="/user_birthday_coupons">生日赠券</a>
							<i><img src="../css/vendor/img/6_13.png" \></i>
						</div>
					</li>
				</ul>
			</div>
			<div class="tell">
				<img src="../css/vendor/img/3_20.png"/>
				<a href="/shopinfo">门店及电话</a>
				<i><img src="../css/vendor/img/6_13.png" \></img\></i>
			</div>
			<div class="other">
				<img src="../css/vendor/img/3_12.png"/>
				<a href="/shop_select/select" target="_blank">选择成为其他门店会员</a>
				<i><img src="../css/vendor/img/6_13.png" \></img\></i>
			</div>
		@else
			<div style="padding: 10px 0; text-align: center;">没有会员卡</div>
		@endif
			


	    <div class="weui-btn-area">
	    	@if ($cards->count() > 0)
			@else
				<a class="weui-btn weui-btn_primary" href="/shop_select/select">成为会员</a>
			@endif

	    </div>


		<div id="coupon" class="weui-mask" style="overflow-y: auto; background-color: #fff; z-index: 9999; display: none;">
			<div class="weui-dialog-self" style="background-color: #fff; width: 90%; margin: 0 5%; ">

				<div class="title">可用优惠券</div>
				<div class="list" style="overflow: hidden;">
					<ul id='coupons'>
					</ul>
				</div>
				<div class="title">近三个月过期优惠券</div>
				<div class="list">
					<ul id='expired_coupons' style="list-style: none;">
					</ul>
				</div>
			</div>
		</div>

	    @if ($cards->count() > 0)
		<div id="dialogs">
			<!--BEGIN dialog2-->
	        <div class="js_dialog" id="iosDialog1" style="display: none;">
	            <div class="weui-mask"></div>
	            <div class="weui-dialog">
	                <div class="weui-dialog__bd">菜品价格应包含原材料成本、房租、人工、门店利润，持金尊卡的客人可享受仅包含原材料成本的菜品价格</div>
	                <div class="weui-dialog__ft">
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">知道了</a>
	                </div>
	            </div>
	        </div>
	        <!--END dialog2-->
			<!--BEGIN dialog2-->
	        <div class="js_dialog" id="iosDialog2" style="display: none;">
	            <div class="weui-mask"></div>
	            <div class="weui-dialog">
	                <div class="weui-dialog__bd">
						您的有效期截止为:{{$card->end->format('Y-m-d')}}
					</div>
	                <div class="weui-dialog__ft">
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">知道了</a>
	                </div>
	            </div>
	        </div>
	        <!--END dialog2-->
	        <!--BEGIN dialog1-->
	        <div class="js_dialog" id="iosDialog3" style="display: none;">
	            <div class="weui-mask"></div>
	            <div class="weui-dialog">
	                <div class="weui-dialog__hd"><strong class="weui-dialog__title">优惠券</strong></div>
	                <div class="weui-dialog__bd">您有可以使用的优惠券，是否现在使用？</div>
	                <div class="weui-dialog__ft">
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default" onclick="notUseConpon()">不使用</a>
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary" onclick="useConpon()">使用</a>
	                </div>
	            </div>
	        </div>
	        <!--END dialog1-->

	        <div class="js_dialog" id="iosDialog4" style="display: none;">
	            <div class="weui-mask"></div>
	            <div class="weui-dialog">
	                <div class="weui-dialog__hd"><strong class="weui-dialog__title">输入金额</strong></div>
	                <div class="weui-dialog__bd">
	                	<div class="weui-cell">
			                <div class="weui-cell__bd">
			                    <input style="text-align: center; font-size: 22px;" class="weui-input" id="manual_money" type="number" pattern="[0-9.]*"  placeholder="请输入金额" onfocus=" this.placeholder='' " onblur="this.placeholder='请输入金额'"/>
			                </div>
			            </div>
	                </div>
	                <div class="weui-dialog__ft">
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
	                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary" onclick="buyManual()">确认</a>
	                </div>
	            </div>
	        </div>
    	</div>
    	@endif
@endsection


@section('js')
	<script type="text/javascript">
	    $(function(){
	    	var $iosDialog1 = $('#iosDialog1');
	        var $iosDialog2 = $('#iosDialog2');
	        $('#dialogs').on('click', '.weui-dialog__btn', function(){
	            $(this).parents('.js_dialog').fadeOut(200);
	        });
	        $('#showIOSDialog1').on('click', function(){
	            $iosDialog1.fadeIn(200);
	        });
	        $('#showIOSDialog2').on('click', function(){
	            $iosDialog2.fadeIn(200);
	        });
	    });
	</script>
	<script type="text/javascript">

		var billInfo = null;
	    var couponInfo = null;
	    var expired_coupons = null;

		function notUseConpon() {
			$('#iosDialog3').hide();
			if (billInfo) {
				payBill(0);
			}
		}

		function manual(){
			$('#iosDialog4').fadeIn(200);
		}

		function buyManual(){
			var obj = new Object(); 
			obj.shopid = 0;
			obj.billid = 0;
			obj.money = parseInt($('#manual_money').val());
			console.log();
			if (!obj.money) {
				alert('请输入正确金额');
				e.preventDefault();
				return;
			}

			billInfo = obj;
		    //获取优惠券信息，未使用且满足使用条件
		    $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
			$.ajax({
				url: '/api/coupon_can_use',
				type: 'GET',
				data: {money: billInfo.money, user_id: {{$user->id}} },
				success: function(data) {
					if (data.code == 1) {
						alert(data.message);
						return;
					}
					couponInfo = data.message;
					expired_coupons = data.expired_coupons;
					if (data.count > 0) {
						$('#iosDialog3').fadeIn(200);
					}else{
						payBill(0);
					}
	            },
			});
		}

		function useConpon() {
			//请求优惠券数据
			$('#iosDialog3').hide();
			//显示优惠券选择界面
			$('#coupons').empty();
			for (var i = 0; i < couponInfo.length; i++){
				if (couponInfo[i].type == '打折券') {
					$('#coupons').append(" \
						<li onclick='payBill(" + couponInfo[i].id +")'>\
							<div class='upitem'>\
								<img class='one' src='http://wx.sanbuguan.com/img/logolv.jpg'/>\
								<span class='two'>￥</span>\
								<span class='three'>"+ couponInfo[i].discount/10 +"</span>\
								<div class='sonitem'>\
									<span class='four'>满"+ couponInfo[i].base +"元使用</span>\
									<span class='five'>折 " + couponInfo[i].type + "</span>\
								</div>\
							</div>\
							<div class='downitem'>\
								<span class='two'>范围:三不馆</span>\
								<span class='three'>有效期:"+ couponInfo[i].time_end.substring(0,10) +"</span>\
							</div>\
						</li>\
					");
				} else {
					$('#coupons').append(" \
						<li onclick='payBill(" + couponInfo[i].id +")'>\
							<div class='upitem'>\
								<img class='one' src='http://wx.sanbuguan.com/img/logolv.jpg'/>\
								<span class='two'>￥</span>\
								<span class='three'>"+ couponInfo[i].given +"</span>\
								<div class='sonitem'>\
									<span class='four'>满"+ couponInfo[i].base +"元使用</span>\
									<span class='five'>元 " + couponInfo[i].type + "</span>\
								</div>\
							</div>\
							<div class='downitem'>\
								<span class='two'>范围:三不馆</span>\
								<span class='three'>有效期:"+ couponInfo[i].time_end.substring(0,10) +"</span>\
							</div>\
						</li>\
					");
				}
			}

			$('#expired_coupons').empty();
			for (var i = 0; i < expired_coupons.length; i++){
				if (expired_coupons[i].type == '打折券') {
					$('#expired_coupons').append(" \
						<li>\
							<div class='upitem overtime'>\
								<img class='one' src='http://wx.sanbuguan.com/img/logohui.jpg'/>\
								<span class='two'>￥</span>\
								<span class='three'>"+ couponInfo[i].discount +"</span>\
								<div class='sonitem'>\
									<span class='four'>满"+ couponInfo[i].base +"元使用</span>\
									<span class='five'>折 " + couponInfo[i].type + "</span>\
								</div>\
							</div>\
							<div class='downitem'>\
								<span class='one'>编号:"+ couponInfo[i].id +"</span>\
								<span class='two'>范围:三不馆</span>\
								<span class='three'>过期时间:"+ couponInfo[i].time_end.substring(0,10) +"</span>\
							</div>\
						</li>\
					");
				} else {
					$('#expired_coupons').append(" \
						<li>\
							<div class='upitem overtime'>\
								<img class='one' src='http://wx.sanbuguan.com/img/logohui.jpg'/>\
								<span class='two'>￥</span>\
								<span class='three'>"+ couponInfo[i].given +"</span>\
								<div class='sonitem'>\
									<span class='four'>满"+ couponInfo[i].base +"元使用</span>\
									<span class='five'>元 " + couponInfo[i].type + "</span>\
								</div>\
							</div>\
							<div class='downitem'>\
								<span class='one'>编号:"+ couponInfo[i].id +"</span>\
								<span class='two'>范围:三不馆</span>\
								<span class='three'>过期时间:"+ couponInfo[i].time_end.substring(0,10) +"</span>\
							</div>\
						</li>\
					");
				}
			}

			$('#coupon').show();
		}

		function payBill(coupon_id) {
			$('#coupon').hide();
			$.ajax({
				url: '/pay_bill',
				type: 'GET',
				data: {shopid: billInfo.shopid, billid: billInfo.billid, money: billInfo.money, user_id: {{$user->id}}, coupon_id: coupon_id },
				success: function(data) {
					if (data.code == 1) {
						alert(data.message);
						return;
					}

	               	data = JSON.parse(data.message)
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
		wx.config({!!$jsconfig!!});
	    wx.ready(function(){
		        
	    });
	    wx.error(function (res) {//错误时调用
	        alert(res.errMsg);
	    });

	    function scan(){
	    	wx.scanQRCode({
			    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
			    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
			    success: function (res) {
				    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
				    billInfo = JSON.parse(result)

				    //获取优惠券信息，未使用且满足使用条件
				    $.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
			        });
					$.ajax({
						url: '/api/coupon_can_use',
						type: 'GET',
						data: {money: billInfo.money, user_id: {{$user->id}} },
						success: function(data) {
							if (data.code == 1) {
								alert(data.message);
								return;
							}
							couponInfo = data.message;
							expired_coupons = data.expired_coupons;
							if (data.count > 0) {
								$('#iosDialog3').fadeIn(200);
							}else{
								payBill(0);
							}
			            },
					});
				}
			}); 
	    }
	</script>
	
@endsection