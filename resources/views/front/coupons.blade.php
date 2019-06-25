@extends('front.base1')


@section('css')
	<style type="text/css">
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
	</style>
@endsection


@section('content')
	

		<div id="coupon" class="weui-mask" style="overflow-y: auto; background-color: #fff;">
			<div class="weui-dialog-self" style="background-color: #fff; width: 90%; margin: 0 5%; ">

				<div class="title">可用优惠券</div>
				<div class="list" style="overflow: hidden;">
					<ul id='coupons'>

						@foreach ($coupons as $coupon)
							@if ($coupon->type == '打折券')
								<li>
									<div class='upitem'>
										<img class='one' src="{{ asset('img/logolv.jpg') }}"/>
										<span class='two'>￥</span>
										<span class='three'>{{$coupon->discount/10 }}</span>
										<div class='sonitem'>
											<span class='four'>满{{$coupon->base}}元使用</span>
											<span class='five'>折 {{$coupon->type}}</span>
										</div>
									</div>
									<div class='downitem'>
										<!--span class='one'>编号:{{$coupon->id }}</span-->
										<span class='two'>范围:三不馆</span>
										<span class='three'>有效期:{{ $coupon->time_end->format('Y-m-d') }}</span>
									</div>
								</li>
							@else
								<li>
									<div class='upitem'>
										<img class='one' src='{{ asset('img/logolv.jpg') }}'/>
										<span class='two'>￥</span>
										<span class='three'>{{$coupon->given }}</span>
										<div class='sonitem'>
											<span class='four'>满{{$coupon->base}}元使用</span>
											<span class='five'>元 {{$coupon->type}}</span>
										</div>
									</div>
									<div class='downitem'>
										<!--span class='one'>编号:{{$coupon->id }}</span-->
										<span class='two'>范围:三不馆</span>
										<span class='three'>有效期:{{ $coupon->time_end->format('Y-m-d') }}</span>
									</div>
								</li>
							@endif
						@endforeach
					</ul>
				</div>

			</div>
		</div>

	
@endsection

