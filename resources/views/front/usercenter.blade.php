@extends('front.base')

@section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/api.css') }}" />
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"/>
        <style>
            html, body {
                width: 100%;
                height: 100%;
                float: left;
                background-color: #FFFFFF;
            }
            input, button, select, textarea {
                outline: none;
                box-shadow: none;
                background: none;
                border: none;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
            }
            textarea {
                resize: none;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
            }
            a {
                color: #d9d9d9;
            }
            .title{
                width: 92%;
                margin-left: 4%;
                height: 50px;
                float: left;
                line-height: 50px;
                font-size: 1.2em;
            }
            .num{
                width: 92%;
                margin-left: 4%;
                height: 60px;
                float: left;
            }
            .num input{
                width: 100%;
                height: 50px;
                line-height: 50px;
                margin-top: 5px;
                float: left;
                color: #62b900;
                font-size: 30px;
            }
            .num input::-webkit-input-placeholder { /* WebKit browsers */  
                color:    #62b900;  
            }  
            .num input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */  
               color:    #62b900;  
               opacity:  1;  
            }  
            .num input::-moz-placeholder { /* Mozilla Firefox 19+ */  
               color:    #62b900;  
               opacity:  1;  
            }  
            .num input:-ms-input-placeholder { /* Internet Explorer 10+ */  
               color:    #62b900;  
            } 
            .type{
                width: calc(92% - 2px);
                height: 50px;
                float: left;
                margin-left: 4%;
                border: 1px solid #CCCCCC;
                border-radius: 5px;
                margin-top: 5px;
                margin-bottom: 10px;
            }
            .type img{
                width: 30px;
                height: 30px;
                float: left;
                margin: 10px;
            }
            .type span{
                width: auto;
                height: 50px;
                margin-left: 10px;
                line-height: 50px;
                float: left;
            }
            .type i{
                width: 50;
                height: 50px;
                margin-right: 10px;
                line-height: 50px;
                float: right;
                font-size: 1.3em;
                color: #FFFFFF;
            }
            .active{
                border: 1px solid #62b900;
            }
            .active i{
                color: #62b900;
            }
            .chongzhi{
                width: 80%;
                margin-left: 10%;
                height: 50px;
                line-height: 50px;
                text-align: center;
                float: left;
                margin-top: 40px;
                background-color: #62b900;
                color: #FFFFFF;
                font-size: 1.4em;
                border-radius: 25px;
            }
            .bag{font-family: 'Microsoft YaHei'; width: 100%; height: 170px; float: left; background-color: #62b900; margin-bottom: 10px;}
            .bag .one{ width: 100%; height: 50px; line-height: 50px; float: left; text-align: center; font-size: 18px; color: #fff;}
            .bag .two{ width: 100%; height: 50px; line-height: 50px; float: left; text-align: center; font-size: 45px; color: #fff;}
            .bag .caozuo{ width: 100%; height: auto; float: left; margin-top: 20px;}
            .bag .caozuo span{ font-size: 14px; border: 1px solid #F2F2F2; width: 40%; margin-left: 4.6%; margin-right: 4.6%; height: 30px; float: left; line-height: 30px; text-align: center; color: #fff;}
            .item{ width: 100%; height: auto; float: left; border-bottom: 1px solid #F2F2F2;}
            .item span{ width: auto; height: 40px; line-height: 40px; float: left; font-size: 15px; margin-left: 10px; color: #666; font-size: 14px;}
            .item img{ width: 30px; height: 30px; float: right; margin: 5px 10px 5px 0;}
        </style>
@endsection


@section('content')
    <div class="bag">
            <span class="one">账户金额</span>
            <span class="two">{!! number_format($account_price,2) !!}</span>
            <div class="caozuo">
                <span class="recharge" data-uid="{{$user->id}}">充值</span>
                <span class="tixian" data-bankstatus="{!! $user->bankinfo()->count()>0?'true':'false' !!}" data-banknum="{!! $user->bankinfo()->count() !!}" data-yue="{!! $account_price !!}" data-bankinfo='{!! $user->bankinfo()->get() !!}'>提现</span>
            </div>
        </div>
        <div class="item" data-url="/bank_manage">
            <span >银行卡管理</span>
            <img src="{{ asset('images/right.png') }}" />
        </div>
        <div class="item" data-url="/mejoinlist">
            <span >参与记录</span>
            <img src="{{ asset('images/right.png') }}" />
        </div>
        <div class="item" data-url="/consume_record">
            <span>消费记录</span>
            <img src="{{ asset('images/right.png') }}" />
        </div>
        <div class="item" data-url="/recharge_record">
            <span>充值记录</span>
            <img src="{{ asset('images/right.png') }}" />
        </div>
        <div class="item" data-url="/withdraw_record">
            <span>提现记录</span>
            <img src="{{ asset('images/right.png') }}" />
        </div>
        <div class="item" data-url="/return_money">
            <span>返还记录</span>
            <img src="{{ asset('images/right.png') }}" />
        </div>

    <div class="weui-tabbar">
                <a href="/productList/" class="weui-tabbar__item weui-bar__item">
                    <span style="display: inline-block;position: relative;">
                        <img src="{{asset('images/shouye.png')}}" alt="" class="weui-tabbar__icon">
                       <!--  <span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">1</span> -->
                    </span>
                    <p class="weui-tabbar__label">首页</p>
                </a>
            
                <a href="/usercenter/" class="weui-tabbar__item weui-bar__item_on">
                    <img src="{{asset('images/nopart.png')}}" alt="" class="weui-tabbar__icon">
                    <p class="weui-tabbar__label">我的</p>
                </a>
    </div>



@endsection

@section('js')

<script type="text/javascript">

$('.share').click(function(){
 var link=$(this).data('link');
 window.location.href=link;
});
$('.item').click(function(){
    var url=$(this).data('url');
     if(url !=undefined && url !=''){
    window.location.href=url;
}
});
</script>

<script type="text/javascript">

    $('.recharge').click(function(){
         layer.open({
            type: 1
            ,content: '<div class="title">充值金额</div><div class="num"><input id="jine" name="chongzhi_price" onkeyup="varify_jine()" maxlength="6" placeholder="0.00" /></div><div class="title">支付方式</div><div id="a2" value="2" class="type active"><img src="{{asset("images/weixinjie.png")}}" /><span>微信支付</span><i class="icon-ok"></i></div><div class="chongzhi" onclick="goto_pay_chongzhi()">充值</div>'
            ,anim: 'up'
            ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
          });
         
});

$('.tixian').click(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     $.ajax({
                    url: '/get_user_bankinfo',
                    type: 'GET',
                    success: function(data) {

     var status=data.status;
     var bankinfo=data.msg;
    //get_user_bankinfo
    if(status){
                var html='';
                for(var i=0;i<bankinfo.length;i++){
                    html +='<div class="weui-cell" onclick="choose_card_to_pay('+bankinfo[i].id+')"><div class="weui-cell__bd"><p>'+bankinfo[i].card_name+'</p></div><div class="weui-cell__ft">'+bankinfo[i].card_no.substring(bankinfo[i].card_no.length-4,bankinfo[i].card_no.length)+'</div></div>';
                }
                layer.open({
    type: 1
    ,content: '<div class="weui-cell">请选择一个银行卡进行提现</div>'+html
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
  });
         
    }else{

        window.location.href="/bank_manage";
}
}
});

});

//验证金额
function varify_jine(){
   var x= document.getElementById("jine");
     x.value=x.value.replace(/[^\d.]/g,'');
}

//账户充值
function goto_pay_chongzhi(){
    var price=$("input[name='chongzhi_price']").val();
    var uid=$('.recharge').data('uid');
       if(price==''||price<=0){
        layer.open({
                content: '请输入充值金额' 
                ,btn: '我知道了'
            });
        return false;
    }
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
//充值支付接口
     $.ajax({
                    url: '/AccountRecharge',
                    type: 'POST',
                    data: {user_id: uid ,price:price},
                    success: function(data) {
                        if (data.code == 1) {
                           // alert();
                            layer.open({
                            content: data.message
                            ,btn: '我知道了'
                        });
                            return;
                        }

                    data = JSON.parse(data.message);
                    //data = JSON.parse(data)
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
                       var a= JSON.stringify(res);
                        console.log("res:"+a);
                        //return;
                        // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回ok，但并不保证它绝对可靠。
                        if (res.err_msg ==='get_brand_wcpay_request:ok') {
                           $.ajax({
                                 url:'/recharge_account',
                                 type:'POST',
                                 data:'price='+price+'&type=账户充值',
                                 success:function(data){
                                      layer.open({
                      title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了' , yes: function(){
                              window.location.reload();
                        }
                    });
                                 }
                             });
                             } else {
                            layer.open({
								  title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                         content: '支付失败'
                            ,btn: '我知道了'
                            });
                            }
                        }
                    )
                    }
                });


}

//选择指定银行卡提现
function choose_card_to_pay(id){
     layer.open({
    type: 1
    ,content: '<div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">提现金额</label></div><div class="weui-cell__bd"><input class="weui-input" type="number" name="tixian_price" placeholder="请输入提现金额"></div></div><div class="weui-btn-area"><a class="weui-btn weui-btn_primary" href="javascript:" id="start_tixian" onclick="start_tixian('+id+')">下一步</a></div>'
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
  });
}

//账户提现
function start_tixian(id){
    var price=$("input[name='tixian_price']").val();
    var varify_yue=$('.tixian').data('yue');
    if(price>varify_yue){
             layer.open({
				   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                content: '您的余额不足以提现' 
                ,btn: '我知道了'
            });
        return false;
    }
    if(price==''||price<=0){
        layer.open({
                content: '请输入提现金额' 
                ,btn: '我知道了'
            });
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
                       title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了' , yes: function(){
                              window.location.reload();
                        }
                    });
              
            }else{
                  layer.open({
                      title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了' , yes: function(){
                              window.location.reload();
                        }
                    });
         }
     }
     });
}   
</script>


@endsection