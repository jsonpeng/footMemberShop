@extends('front.base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/api.css')}}" />
        <style>
            html,
            body {
                width: 100%;
                height: 100%;
                float: left;
                background-color: #EEEEEE;
            }
            
            input,
            button,
            select,
            textarea {
                outline: none;
                box-shadow: none;
                background: none;
                border: none;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
            
            textarea {
                resize: none;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
            
            a {
                color: #d9d9d9;
            }
            
            .accountlist {
                width: 100%;
                height: auto;
                float: left;
                margin-top: 5px;
            }
            
            .accountlist ul {
                width: 100%;
                height: 100%;
                float: left;
            }
            
            .accountlist ul li {
                width: calc(100% - 20px);
                margin-left: 10px;
                border-radius: 5px;
                margin-top: 10px;
                height: auto;
                float: left;
                background-color: #FFFFFF;
            }
            
            .accountlist ul li img:nth-child(1) {
                width: 50px;
                height: 50px;
                margin-top: 10px;
                margin-left: 10px;
                float: left;
                border-radius: 100px;
            }
            
            .accountlist ul li span:nth-child(2) {
                width: calc(100% - 70px);
                margin-left: 10px;
                height: 25px;
                margin-top: 10px;
                line-height: 25px;
                float: left;
            }
            
            .accountlist ul li span:nth-child(3) {
                width: calc(100% - 70px);
                margin-left: 10px;
                height: 25px;
                line-height: 25px;
                float: left;
            }
            
            .accountlist ul li span:nth-child(4) {
                width: calc(100% - 10px);
                height: 25px;
                margin-top: 10px;
                margin-bottom: 10px;
                line-height: 25px;
                font-size: 20px;
                float: left;
                text-align: right;
            }
            
            .addbank {
                width: calc(100% - 20px);
                margin-left: 10px;
                height: 50px;
                margin-top: 10px;
                border-bottom: 1px solid #EEEEEE;
                float: left;
            }
            
            .addbank img {
                width: 25px;
                height: 25px;
                margin-left: 12.5px;
                margin-top: 12.5px;
                float: left;
            }
            
            .addbank span {
                width: auto;
                height: 50px;
                line-height: 50px;
                float: left;
                color: #AAAAAA;
                margin-left: 10px;
            }
         
        </style>
@endsection


@section('content')

  @foreach($bank_list as $list)
        <div class="accountlist">
            <ul id="list">
                <li data-bankid="{!! $list->id !!}" >
                    <img src="{{ asset('images/banklogo/yinhang.png') }}" />
                    <span>{!! $list->card_name !!}</span>
                    <span>{!! $list->type !!}</span>
                    <span>************{!! $list->subcardno !!}</span>
                </li>
            </ul>
        </div>
  @endforeach

        <div  class="addbank" id="add_card">
            <img src="{{ asset('images/jiahao.png') }}" />
            <span>添加银行卡</span>
        </div>
   
@endsection



@section('js')
<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script type="text/javascript">
    //验证手机号数字
    function varify_mobile_number(){
       var x= document.getElementById("mobile_num");
         x.value=x.value.replace(/[^\d.]/g,'');
    }

    function varify_bank_number(){
          var x= document.getElementById("bank_num");
         x.value=x.value.replace(/[^\d.]/g,'');
    }


    $('#add_card').click(function(){
 layer.open({
    type: 1
    ,content: '<div class="weui-cells weui-cells_form" style:"z-index:0;"><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">银行卡名称</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_name" onclick="showPicker()" placeholder="请选择银行卡名称"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">银行卡类型</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_type" value="储蓄卡" placeholder="请选择银行卡类型"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">姓名</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="user_name" placeholder="请输入持卡人姓名"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">手机号</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_mobile" id="mobile_num" onkeyup="varify_mobile_number()" maxlength="11" placeholder="请输入持卡人手机号"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">开户行</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_kaihu" placeholder="请输入开户行地址"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">银行卡卡号</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_account" id="bank_num" onkeyup="varify_bank_number()" placeholder="请输入银行卡卡号"></div></div></div><div class="weui-btn-area"><a class="weui-btn weui-btn_primary" href="javascript:" onclick="bank_blind()">确定</a></div>'
    ,anim: 'up'
    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
  });
    });


function showPicker(){
        layer.closeAll();
        var banklist=[
            {
                label: '中国农业银行',
                value: 0
            },
             {
                label: '中国建设银行',
                value: 1
            }, 
            {
                label: '中国工商银行',
                value: 2
            },
            {
                label: '中国银行',
                value: 3
            }, 
            {
                label: '交通银行',
                value: 4
            },
             {
                label: '招商银行',
                value: 5
            },
             {
                label: '邮政储蓄银行',
                value: 6
            },
             {
                label: '兴业银行',
                value: 7
            },
              {
                label: '中国光大银行',
                value: 8
            },
              {
                label: '中国民生银行',
                value: 9
            },
        ];
        weui.picker(banklist, {
            onChange: function (result) {
                //console.log(result);
            },
            onConfirm: function (result) {
               // console.log(banklist[result[0]].label);
                 layer.open({
                        type: 1
                        ,content: '<div class="weui-cells weui-cells_form" style:"z-index:0;"><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">银行卡名称</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_name" onclick="showPicker()" placeholder="请选择银行卡名称" value='+banklist[result[0]].label+'></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">银行卡类型</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_type" value="储蓄卡" placeholder="请选择银行卡类型"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">姓名</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="user_name" placeholder="请输入持卡人姓名"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">手机号</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_mobile" id="mobile_num" onkeyup="varify_mobile_number()" placeholder="请输入持卡人手机号"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">开户行</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_kaihu" placeholder="请输入开户行地址"></div></div><div class="weui-cell "><div class="weui-cell__hd"><label class="weui-label">银行卡卡号</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" name="bank_account" id="bank_num" onkeyup="varify_bank_number()" placeholder="请输入银行卡卡号"></div></div></div><div class="weui-btn-area"><a class="weui-btn weui-btn_primary" href="javascript:" onclick="bank_blind()">确定</a></div>'
                        ,anim: 'up'
                        ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
                      });
            }
        });
 
    // layer.open({
    //     type:1,
    //     content:'<div class="weui-picker weui-animate-slide-up"><div class="weui-picker__hd"><a href="javascript:;" data-action="cancel" class="weui-picker__action">取消</a><a href="javascript:;" data-action="select" class="weui-picker__action" id="weui-picker-confirm">确定</a></div><div class="weui-picker__bd"><div class="weui-picker__group"><div class="weui-picker__mask"></div><div class="weui-picker__indicator"></div><div class="weui-picker__content" style="transform: translate3d(0px, -34px, 0px);"><div class="weui-picker__item">飞机票</div><div class="weui-picker__item">火车票</div><div class="weui-picker__item">的士票</div><div class="weui-picker__item weui-picker__item_disabled">公交票 (disabled)</div><div class="weui-picker__item">其他</div></div></div></div></div>',
    //     anim:'up',style:'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
    // });
}



//绑定银行卡
function bank_blind(){
    var bank_name=$("input[name='bank_name']").val();
    var bank_kaihu=$("input[name='bank_kaihu']").val();
    var user_name=$("input[name='user_name']").val();
    var bank_mobile=$("input[name='bank_mobile']").val();
    var bank_account=$("input[name='bank_account']").val();
    var bank_type=$("input[name='bank_type']").val();
    if(bank_name !='' && bank_kaihu !='' && user_name !='' && bank_mobile !='' && bank_account !='' && bank_type !=''){
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
         url:'/blind_bank_card',
         type:'POST',
         data:'bank_name='+bank_name+'&bank_kaihu='+bank_kaihu+'&user_name='+user_name+'&bank_mobile='+bank_mobile+'&bank_account='+bank_account+'&bank_type='+bank_type,
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
}else{
       layer.open({
                        content: '信息填写不完整!'
                        ,btn: '我知道了'
                    });
       return false;
}
}
//删除银行卡
$(".del_card").click(function(){
    var that=this;
    var bankid=$(this).data('bankid');
                   layer.open({
    content: '确定要删除吗'
    ,btn: ['确定', '不要']
    ,yes: function(index){
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
         url:'/del_bank_card',
         type:'POST',
         data:'bankid='+bankid,
         success:function(data){
            if(data.status){
                layer.open({
                        content: data.msg
                        ,btn: '我知道了'
                    });
            $(that).parent().remove();
             
            }
         }
     });
    }

    });


});

//解除绑定银行卡
$("#list>li").mouseup(function(){ 
    var bankid=$(this).data('bankid');
    var that=this;

     layer.open({
    content: '确定要解除绑定吗？'
    ,btn: ['确定', '不要'],skin: 'footer'
    ,yes: function(index){
    $.ajaxSetup({
        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
         url:'/del_bank_card',
         type:'POST',
         data:'bankid='+bankid,
         success:function(data){
            if(data.status==true){
                layer.open({
                        content: data.msg
                        ,btn: '我知道了'
                    });
            $(that).remove();
             
            }
         }
     });     
    }
  });
});  
</script>
    

@endsection


             