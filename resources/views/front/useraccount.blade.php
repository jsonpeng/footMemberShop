

@extends('front.base')

@section('css')
    <style type="text/css">
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
        .list,.share{
            width: 100%;
            padding-left: 5%;
            padding-right: 5%;
            float: left;
            height: auto;
            margin-top: 20px;
        }
    </style>
@endsection


@section('content')

    <div class="title">钱包账户余额:￥{!! $account_price !!}元</div>
    
    <div class="list">
    <a class="chongzhi">充值</a>
    <a class="bank_manage" href="/bank_manage">银行卡管理</a>
    <a class="tixian" data-bankstatus="{!! empty($user->bankinfo())?'false':'true' !!}" data-banknum="{!! $user->bankinfo()->count() !!}" data-yue="{!! $account_price !!}" data-bankinfo='{!! $user->bankinfo()->get() !!}'>提现</a>
    </div>

      <div class="list">
    <a class="chongzhi_num" href="/recharge_record">充值记录</a>
    <a class="tixian_num" href="/withdraw_record">提现记录</a>
    <a class="xiaofei_num" href="/consume_record">消费记录</a>
    </div>

<div class="weui_dialog_confirm">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">弹窗标题</strong></div>
        <div class="weui_dialog_bd">自定义弹窗内容<br>...</div>
        <div class="weui_dialog_ft">
            <a href="javascript:;" class="weui_btn_dialog default">取消</a>
            <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
$(function(){
    $iosDialog2.fadeIn(200);
});
$('.chongzhi').click(function(){

 layer.open({
    type: 1
    ,content: '<div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">充值金额</label></div><div class="weui-cell__bd"><input class="weui-input" type="number" name="chongzhi_price" placeholder="请输入充值金额"></div></div><div class="weui-btn-area"><a class="weui-btn weui-btn_primary" href="javascript:" id="goto_pay_chongzhi" onclick="goto_pay_chongzhi()">下一步</a></div>'
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 130px; padding:10px 0; border:none;'
  });
});


$('.tixian').click(function(){
    var status=$(this).data('bankstatus');
    var banknum=$(this).data('banknum');
    var bankinfo=$(this).data('bankinfo');
    if(status ){
        
                var html='';
                for(var i=0;i<bankinfo.length;i++){
        
                    html +='<div class="weui-cell" onclick="choose_card_to_pay('+bankinfo[i].id+')"><div class="weui-cell__bd"><p>'+bankinfo[i].card_name+'</p></div><div class="weui-cell__ft">'+bankinfo[i].card_no+'</div></div>';
                }
                layer.open({
    type: 1
    ,content: '<div class="weui-cell">请选择一个银行卡进行提现</div>'+html
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 150px; padding:10px 0; border:none;'
  });
         
    }else{
 layer.open({
    type: 1
    ,content: '<div style="text-align:center;"><div>请输入银行卡名称:<input type="text" name="bank_name" /></div><div>请输入开户行:<input type="text" name="bank_kaihu" /></div><div>请输入姓名:<input type="text" name="user_name" /></div><div>请输入开户手机号:<input type="number" name="bank_mobile" /></div><div>请输入银行卡账号:<input type="text" name="bank_account" /></div><div><button class="bank_blind" onclick="bank_blind()">绑定</button></div></div>'
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 150px; padding:10px 0; border:none;'
  });
}
});

//账户充值
function goto_pay_chongzhi(){
    var price=$("input[name='chongzhi_price']").val();

   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
   $.ajax({
         url:'/recharge_account',
         type:'POST',
         data:'price='+price+'&type=账户充值',
         success:function(data){
                // layer.open({
                //         content: data.msg
                //         ,btn: '我知道了'
                //     });
             
               // window.location.href="/success_callback?text="+data.msg+"&info="+"查看充值记录";
                window.location.reload();
         }
     });
}

//选择指定银行卡提现
function choose_card_to_pay(id){
     layer.open({
    type: 1
    ,content: '<div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">提现金额</label></div><div class="weui-cell__bd"><input class="weui-input" type="number" name="tixian_price" placeholder="请输入提现金额"></div></div><div class="weui-btn-area"><a class="weui-btn weui-btn_primary" href="javascript:" id="start_tixian" onclick="start_tixian('+id+')">下一步</a></div>'
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 140px; padding:10px 0; border:none;'
  });
}

//账户提现
function start_tixian(id){
    var price=$("input[name='tixian_price']").val();
    var varify_yue=$('.tixian').data('yue');
    if(price>varify_yue){
        alert("您的余额不足以提现");
        return false;
    }
   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
   $.ajax({
         url:'/withdraw_account',
         type:'POST',
         data:'price='+price+'&type=账户提现'+'&status=发起提现'+'&bankid='+id,
         success:function(data){
            if(data.status){
                layer.open({
                        content: data.msg
                        ,btn: '我知道了'
                    });
                window.location.reload();
            }else{
                alert(data.msg);
                 window.location.reload();
            }
         }
     });
}

//绑定银行卡
function bank_blind(){
    var bank_name=$("input[name='bank_name']").val();
    var bank_kaihu=$("input[name='bank_kaihu']").val();
    var user_name=$("input[name='user_name']").val();
    var bank_mobile=$("input[name='bank_mobile']").val();
    var bank_account=$("input[name='bank_account']").val();
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
   $.ajax({
         url:'/blind_bank_card',
         type:'POST',
         data:'bank_name='+bank_name+'&bank_kaihu='+bank_kaihu+'&user_name='+user_name+'&bank_mobile='+bank_mobile+'&bank_account='+bank_account,
         success:function(data){
            if(data.status==true){
                layer.open({
                        content: data.msg
                        ,btn: '我知道了'
                    });
                window.location.reload();
            }
         }
     });
}

</script>

@endsection