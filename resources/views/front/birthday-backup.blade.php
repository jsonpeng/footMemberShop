@extends('front.base')

@section('css')
	<style type="text/css">
		.weui-label{
			width: 65px;
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
	<div style="padding: 15px;">实名认证</div>
	<div id="demo1"></div>

	<div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="javascript:" id="showIOSDialog1">确定</a>
    </div>

    <div id="dialogs">
        <!--BEGIN dialog1-->
        <div class="js_dialog" id="iosDialog1" style="display: none;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__hd"><strong class="weui-dialog__title">确认</strong></div>
                <div class="weui-dialog__bd">生日日期一旦设定便不能再更改，确认提交吗？</div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default">取消</a>
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary" onclick="setBirthday()">确认</a>
                </div>
            </div>
        </div>
        <div class="js_dialog" id="iosDialog2" style="display: none;">
            <div class="weui-mask"></div>
            <div class="weui-dialog">
                <div class="weui-dialog__bd">请设置生日日期</div>
                <div class="weui-dialog__ft">
                    <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">好的</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
	<script type="text/javascript">
		var calendar = new datePicker();
		calendar.init({
		    'trigger': '#demo1', /*按钮选择器，用于触发弹出插件*/
		    'type': 'date',/*模式：date日期；datetime日期时间；time时间；ym年月；*/
		    'minDate':'1900-1-1',/*最小日期*/
		    'maxDate':'2100-12-31',/*最大日期*/
		    'onSubmit':function(){/*确认时触发事件*/
		        var theSelectData=calendar.value;
		        console.log(theSelectData);
		        $('#demo1').text(theSelectData);
		    },
		    'onClose':function(){/*取消时触发事件*/
		    }
		});

		var $iosDialog1 = $('#iosDialog1');
		var $iosDialog2 = $('#iosDialog2');

        $('#dialogs').on('click', '.weui-dialog__btn', function(){
            $(this).parents('.js_dialog').fadeOut(200);
        });

        $('#showIOSDialog1').on('click', function(){
        	if ($('#demo1').text() == '') {
        		$iosDialog2.fadeIn(200);
        	} else {
        		$iosDialog1.fadeIn(200);
        	}
            
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
				data: {user_id: {{$user->id}}, birthday: $('#demo1').text() },
				success: function(data) {
	               	if (data.code == 1) {
						alert(data.message);
						return;
					}
					window.location.href = '/index/';
	            },
			});
        }
	</script>
@endsection
