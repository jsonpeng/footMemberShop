@extends('front.base1')

<!--<link rel="stylesheet" href="{{ asset('css/vendor/mui.min.css') }}">-->
<link rel="stylesheet" href="{{ asset('css/vendor/RealName.css') }}">

@section('css')
	
@endsection


@section('content')

	<div class="con">
		<div class="header">
			<img src={!! asset("img/smrz1.png") !!} />
			<p>实名认证</p>
		</div>
		<div class="content">
			<div class="content_one">
				<span>您还没有通过实名认证。</span>
				<span>现在通过互联网实名认证，您将拥有以下优势:</span>
			</div>
			<div class="content_two">
				<div class="birth">
					<img src={!! asset("img/mark.png") !!} />
					<p>尊享实名认证标签，更抢眼</p>
				</div>
				<div class="credit">
					<img src={!! asset("img/credit2.png") !!} />
					<p>实名认证用户更容易获得信赖</p>
				</div>
			</div>
			<div class="content_btn">
				<a href="/birthday" class="btn-block">立即认证</a>
			</div>
			<!--<a href="/birthday" class="mui-btn mui-btn-success back">立即认证</a>-->
		</div>
	</div>

	<!--<div class="con">
		<div class="header">
			<img src="img/smrz.png" />
			<p>实名认证</p>
		</div>
		<div class="content">
			<div class="content_one">
				<span>您还没有通过实名认证。</span>
				<span>现在通过实名认证，您将拥有以下优势:</span>
			</div>
			<div class="content_two">
				<div class="birth">
					<img src="img/birth1.jpg" />
					<p>实名认证用户可在生日当天获得蛋糕</p>
				</div>
				<div class="credit">
					<img src="img/credit.png" />
					<p>实名认证用户更容易获得信赖</p>
				</div>
			</div>
			<div class="content_btn">
				<a href="/birthday" class="btn-block">立即认证</a>
			</div>
		</div>
	</div>-->
@endsection
