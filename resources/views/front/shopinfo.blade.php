@extends('front.base1')

@section('css')
	<!--<link rel="stylesheet" href="{{ asset('css/vendor/SelectStore.css') }}">-->
	<link rel="stylesheet" href="{{ asset('css/vendor/mui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/vendor/StoreInfo.css') }}">
	<style type="text/css">
		.title {
			margin: 20px 15px 10px;
			color: #6d6d72;
			font-size: 15px;
		}
	</style>

@endsection


@section('content')

	<header class="mui-bar mui-bar-nav">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left font"></a>
		<h1 class="mui-title">门店信息</h1>
	</header>
	<div class="mui-content">
		<div class="title"></div>
		<ul class="mui-table-view">
			<li class="mui-table-view-cell mui-media">
				<a href="javascript:;">
					<img class="mui-media-object mui-pull-left aqh" src="../css/vendor/img/aqh.jpg">
					<div class="mui-media-body">
						爱琴海店
						<p class='mui-ellipsis first'>天津市河东区津滨大道160号天津爱琴海购物公园F4层4F-416</p>
						<p class="mui-ellipsis">022-58536619</p>
					</div>
				</a>
			</li>
			<li class="mui-table-view-cell mui-media">
				<a href="javascript:;">
					<img class="mui-media-object mui-pull-left" src="../css/vendor/img/yywl.jpg">
					<div class="mui-media-body">
						远洋未来店
						<p class='mui-ellipsis first'>天津市河东区新开路71号未来广场购物中心4F层</p>
						<p class="mui-ellipsis">022-27120881</p>
					</div>
				</a>
			</li>
			<li class="mui-table-view-cell mui-media">
				<a href="javascript:;">
					<img class="mui-media-object mui-pull-left thc" src="../css/vendor/img/thc.jpg">
					<div class="mui-media-body">
						天河城店
						<p class='mui-ellipsis first'>天津市和平区大沽北路天河城6楼</p>
						<p class="mui-ellipsis">022-59668799</p>
					</div>
				</a>
			</li>
			<li class="mui-table-view-cell mui-media">
				<a href="javascript:;">
					<img class="mui-media-object mui-pull-left" src="../css/vendor/img/rbl.png">
					<div class="mui-media-body">
						若比邻店
						<p class='mui-ellipsis first'>天津市东丽区外环东路与昆仑路交口保利玫瑰湾溪水河畔花园45号</p>
						<p class="mui-ellipsis">022-xxxxxxxx</p>
					</div>
				</a>
			</li>
		</ul>
		<div class="mui-content-padded tip">
			<h5>提示:</h5>
			<p>1、请点击您经常就餐店门店</p>
			<p>2、金尊卡仅限在您选择店门店内使用</p>
			<p>3、菜品价格应包含原材料成本、房租、人工、门店利润，持金尊卡店客人可享受仅包含原材料成本店菜品价格。</p>
		</div>
	</div>
	<!--<div class="con">
		<div class="header">
			<img src="img/logo.png"/>
			<h4>门店信息</h4>
		</div>
		<div class="store">
			<ul>
				<li>
					<img src="../css/vendor/img/aqh.jpg" class="img-responsive" />
					<div class="pr">
						<h4>爱琴海店</h4>
						<span>天津市河东区津滨大道160号天津爱琴海购物公园F4层4F-416</span>
						<span>022-58536619</span>
					</div>
				</li>
				
				<li>
					<img src="../css/vendor/img/yywl.jpg" class="img-responsive" />
					<div class="pr">
						<h4>远洋未来店</h4>
						<span>天津市河东区新开路71号未来广场购物中心4F层</span>
						<span>022-27120881</span>
					</div>
				</li>
				
				<li>
					<img src="../css/vendor/img/thc.jpg" class="img-responsive" />
					<div class="pr">
						<h4>天河城店</h4>
						<span>天津市和平区大沽北路天河城6楼</span>
						<span>022-59668799</span>
					</div>
				</li>
				
				<li>
					<img src="../css/vendor/img/rbl.png" class="img-responsive" />
					<div class="pr">
						<h4>若比邻店</h4>
						<span>天津市东丽区外环东路与昆仑路交口保利玫瑰湾溪水河畔花园45号</span>
						<span>022-xxxxxxxx</span>
					</div>
				</li>
			</ul>
		</div>
		<div class="tip">
			<h5>提示:</h5>
			<p>1、请点击您经常就餐店门店</p>
			<p>2、金尊卡仅限在您选择店门店内使用</p>
			<p>3、菜品价格应包含原材料成本、房租、人工、门店利润，持金尊卡店客人可享受仅包含原材料成本店菜品价格。</p>
		</div>
	</div>-->
@endsection