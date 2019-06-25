@extends('front.base1')

<link rel="stylesheet" href="{{ asset('css/vendor/PersonalInfo.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendor/PersonalInfo2.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendor/mui.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendor/birth2.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendor/birth1.css') }}">
@section('css')
	<style type="text/css">
		.weui-label{
			width: 65px;
		}
		
		.title{
			margin-top: 15px;
			color: #6d6d72;
			/*font-size: 15px;*/
		}

		body{
		    font-size: 16px;
		    font-family: 微软雅黑;
		}

		#demo1{

		    width: 90%;
		    margin: 5%;
		    border: 1px solid gray;
		    height: 40px;
		    border-radius: 5px;
		    margin-top: 0;
			line-height: 40px;
		}
	</style>

@endsection

@section('content')
	@if ($user->shenfenzheng == null)
		<!--<div class="con">
			<div class="header">
				<img src="img/logo.png"/>
				<h4>实名认证</h4>
			</div>
			
			<div class="other_info">
				<ul>
					<li>
						<div class="pr">
							<a href="#">真实姓名：</a>
							<input type="text" name="name" placeholder="请填写您的真实姓名" />
						</div>
						
					</li>
					
					<li>
						<div class="pr">
							<a href="#">身份证号：</a>
							<input type="text" name="shenfenzheng" placeholder="请填写您的身份证号" />
						</div>
					</li>
				</ul>
			</div>
			
			<div class="footer">
				<a href="javascript:" id="showIOSDialog1" class="btn-block">确定实名认证</a>
			</div>
		</div>-->
		
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left font" href="/index/"></a>
			<h1 class="mui-title">实名认证</h1>
		</header>
		<div class="mui-content">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell mui-media">
					<a href="#">
						<img class="mui-media-object mui-pull-left" src="{{$user->header}}">
						<div class="mui-media-body">
							{{$user->mobile}}
						</div>
					</a>
				</li>
			</ul>
			<div class="title"></div>
			<ul class="mui-table-view">
				 <li class="mui-table-view-cell">
				 	真实姓名
				 	<input type="text" name="name" placeholder="请输入您的真实姓名" />
				 </li>
		         <li class="mui-table-view-cell">
		         	身份证号
		         	<input type="text" name="shenfenzheng" placeholder="请输入您的身份证号" />
		         </li>
			</ul>
			<div class="btn">
				<a href="javascript:" id="showIOSDialog1" class="mui-btn mui-btn-success back">确认实名认证</a>
			</div>
		</div>

		<!--div style="padding: 15px;">实名认证</div>
		<div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="text" name="name" placeholder="请输入姓名">
	        </div>
	    </div>
	    <div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">身份证号</label></div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="text" name="shenfenzheng" placeholder="请输入身份证号">
	        </div>
	    </div>

		<div class="weui-btn-area">
	        <a class="weui-btn weui-btn_primary" href="javascript:" id="showIOSDialog1">确定</a>
	    </div-->
	@else
		
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left font" href="/index/"></a>
			<h1 class="mui-title">个人信息</h1>
		</header>
		<div class="mui-content">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell mui-media">
					<a href="#">
						<img class="mui-media-object mui-pull-left" src="{{$user->header}}">
						<div class="mui-media-body">
							{{$user->mobile}}
						</div>
					</a>
				</li>
			</ul>
			<div class="title"></div>
			<ul class="mui-table-view">
				 <li class="mui-table-view-cell">
				 	<span class="zsxm">真实姓名</span>
				 	<span class="name">{{$user->name}}</span>
				 </li>
		         <li class="mui-table-view-cell">
		         	<span class="zsxm">身份证号</span>
		         	<span class="num">{{$user->shenfenzheng}}</span>
		         </li>
			</ul>
			<a href="/" class="mui-btn mui-btn-success back">返回</a>
		</div>
		
		<!--<div class="con">
			<div class="header">
				<img src="img/logo.png"/>
				<h4>个人信息</h4>
			</div>
			
			<div class="other_info">
				<ul>
					<li>
						<div class="pr">
							<a href="#">真实姓名：</a>
							<span>{{$user->name}}</span>
						</div>
						
					</li>
					
					<li>
						<div class="pr">
							<a href="#">身份证号：</a>
							<span>{{$user->shenfenzheng}}</span>
						</div>
					</li>
				</ul>
			</div>
			
			<div class="footer">
				<a href="/" class="btn-block">返回</a>
			</div>
		</div>-->
		<!--div style="padding: 15px;">个人信息</div>
		<div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="text" name="name" value="{{$user->name}}" disabled="disabled">
	        </div>
	    </div>
	    <div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">身份证号</label></div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="text" name="shenfenzheng" value="{{$user->shenfenzheng}}" disabled="disabled">
	        </div>
	    </div>

		<div class="weui-btn-area">
	        <a class="weui-btn weui-btn_primary" href="/" >返回</a>
	    </div-->
	@endif
	

    <div id="dialogs">

        <div class="js_dialog" id="iosDialog2" style="display: none;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__bd">请输入姓名和身份证号码</div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">好的</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
	<script type="text/javascript">
		/*
		var calendar = new datePicker();
		calendar.init({
		    'trigger': '#demo1',
		    'type': 'date',
		    'minDate':'1900-1-1',
		    'maxDate':'2100-12-31',
		    'onSubmit':function(){
		        var theSelectData=calendar.value;
		        console.log(theSelectData);
		        $('#demo1').text(theSelectData);
		    },
		    'onClose':function(){
		    }
		});
		*/

		//var $iosDialog1 = $('#iosDialog1');
		var $iosDialog2 = $('#iosDialog2');

        $('#dialogs').on('click', '.weui-dialog__btn', function(){
            $(this).parents('.js_dialog').fadeOut(200);
        });

        $('#showIOSDialog1').on('click', function(){
        	if ($("input[name='name']").val() == '') {
        		$iosDialog2.fadeIn(200);
        		return;
        	}
        	if ($("input[name='shenfenzheng']").val() == '') {
        		$iosDialog2.fadeIn(200);
        		return;
        	}

        	setBirthday();
            
        });

        function setBirthday() {
        	event.preventDefault();
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
			$.ajax({
				url: '/set_birthday',
				type: 'GET',
				data: {user_id: {{$user->id}}, name: $("input[name='name']").val(), shenfenzheng: $("input[name='shenfenzheng']").val() },
				success: function(data) {
	               	if (data.code == 1) {
						alert(data.message);
						return;
					}
					if (data.code == 0) {
						alert('恭喜您已经实名认证成功！');
						location.reload();
					}
					//window.location.href = '/index/';
	            },
			});
        }
	</script>
@endsection
