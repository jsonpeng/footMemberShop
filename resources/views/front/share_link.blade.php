@extends('front.base')

@section('css')
<style>
#shareit {  
  -webkit-user-select: none;  
  display: none;  
  position: absolute;  
  width: 100%;  
  height: 100%;  
  background: rgba(0,0,0,0.85);  
  text-align: center;  
  top: 0;  
  left: 0;  
  z-index: 105;  
}  
#shareit img {  
  max-width: 100%;  
}  
.arrow {  
  position: absolute;  
  right: 10%;  
  top: 5%;  
}  
#share-text {  
  margin-top: 300px;  
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
            
            .huoqu span{
              color: #62b900;
            } 
</style>
 <link rel="stylesheet" type="text/css" href="{{ asset('css/api.css') }}" />
 <link rel="stylesheet" type="text/css" href="{{ asset('css/success.css') }}" />
@endsection

@section('content')
    <div class="good">
      <img class="pic" src="{!! $products->banner !!}" />
      <div class="item">
        <span class="title">{!! $products->name !!}</span>
        <span class="num">{!! $tuan_info->man_num !!}人团</span>
        <span class="price"><i>￥</i>{!! $products->price !!} /件</span>
      </div>
    </div>
    
    <div class="member">
      <ul>
      @foreach($tuan_info->users()->get() as $userinfo)
        <li class="{!! $userinfo->nickname==$tuan_info->tuanzhang->nickname?'active':'' !!}">
          <img class="headpic" src="{{ $userinfo->header }}" />
          <div class="back">
            <span>队</span>
          </div>
        </li>
      @endforeach
      </ul>
    </div>
    
    <span class="oneitem">@if($tuan_info->chanum<=0)参团人数已满@else还差<i>{!! $tuan_info->chanum !!}</i>人,盼你如南方人盼暖气~@endif</span>
    
    <div class="over">
      <span class="line"></span>
      <span class="timedao">{!! $tuan_info->formatendtime !!}结束</span>
      <span class="line"></span>
    </div>
    
    <div class="tuan">
      <img class="pic" src="{!! $tuan_info->tuanzhang->header !!}" />
      <span class="name">{!! $tuan_info->tuanzhang->nickname !!}</span>
      <span class="time">{!! $tuan_info->created_at !!} 开团</span>
    </div>
    
    <div class="bottommenu">
      <div class="btn" data-url="/productList">
        <img src="{{asset('images/shareindex.png')}}" />
      </div>
      <div class="btn" id="share">
        <img src="{{asset('images/shareshare.png')}}" />
      </div>
      <div class="join" data-uid="{{$user->id}}" data-status="{!! $tuan_info->chanum<=0?'true':'false' !!}" data-guoqi="{{$tuan_info->whetherguoqi}}" data-productid="{{$products->id}}" data-tuanid="{{$tuan_info->id}}" data-price="{{$products->price}}" data-mobilestatus="{{empty($user->mobile)}}" style="background-color:{{$tuan_info->whetherguoqi=='已过期'|| $tuan_info->chanum<=0 ?'rgba(0,0,0,0.4)':'#E02E24'}};">
      {{$tuan_info->whetherguoqi}}
      </div>
    </div>

  <div id="shareit">  
    <img class="arrow" src="http://dev.vxtong.com/cases/nuannan/imgs/share-it.png">  
    <a href="#" id="follow">  
      <p id="share-text" style="color:white;font-size:16px;">点击右上角发送给朋友一起拼团吧</p>
    </a>  
  </div>  
    


@endsection

@section('js')
<script type="text/javascript">

 wx.config({!! $jsconfig !!});
     var account_price='{!! $user->account_price !!}';
     var url=window.location.href;
     var products_name='{!! $products->name !!}';
     var tuanid;
     var uid;
     var price;
     var productid=$('.join').data('productid');
     var products_price='{!! $products->price !!}';
     var chanum='{!! $tuan_info->chanum !!}';
    (chanum<=0)?chanum="参团人数已满":chanum="还差"+chanum+"人成团";

        wx.ready(function(){
            //朋友圈
            wx.onMenuShareTimeline({
                title: products_name+products_price+"元抢购,"+chanum+",速速加入", // 分享标题
                desc: products_name+products_price+"元抢购,"+chanum+",速速加入", // 分享描述
                link: url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '{!! $products->banner !!}', // 分享图标
                success: function () { 
                    // 用户确认分享后执行的回调函数
                    layer.open({
                   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: '分享成功'
                        ,btn: '我知道了'
                    });
                  window.location.reload();
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                      layer.open({
                   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: '分享失败'
                        ,btn: '我知道了'
                    });
                  window.location.reload();
                }
            }); 

            //朋友
            wx.onMenuShareAppMessage({
                title: products_name, // 分享标题
                desc: products_name+products_price+"元抢购,"+chanum+",速速加入", // 分享描述
                link: url, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '{!! $products->banner !!}', // 分享图标
                success: function () { 
                    // 用户确认分享后执行的回调函数
                        layer.open({
                   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: '分享成功'
                        ,btn: '我知道了'
                    });
                  window.location.reload();
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                        layer.open({
                   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: '分享失败'
                        ,btn: '我知道了'
                    });
                  window.location.reload();
                }
            });
        });


//跳转回原商品
$('.good').click(function(){
window.location.href="/productContent/"+productid;
});

//跳转到导航
$('.btn').click(function(){
 var url=$(this).data('url');
 if(url !=undefined && url !=''){
 window.location.href=url;
}
});

//分享给朋友
$('#share').click(function(){
  $("#shareit").show(); 
});

//隐藏
$('#shareit').click(function(){
  $("#shareit").hide(); 
});

//参团
$('.join').click(function(){
    if($(this).data('guoqi')=='已过期' || $(this).data('status')==true){
      return;
    }
    tuanid=$(this).data('tuanid');
    uid=$(this).data('uid');
    price=$(this).data('price');
    var productid=$(this).data('productid');
  
    var mobilestatus=$(this).data('mobilestatus');
    if(mobilestatus){
    layer.open({
      type: 1
      ,content: '<div class="weui-cells"><div class="weui-cell weui-cell_select weui-cell_select-before"><div class="weui-cell__hd"><select class="weui-select" name="select2"><option value="1">+86</option><option value="2">+80</option><option value="3">+84</option><option value="4">+87</option></select></div><div class="weui-cell__bd"><input class="weui-input" name="mobile" type="number" maxlength="11" pattern="[0-9]*" placeholder="请输入手机号码"></div><div class="huoqu"><span id="getcode" onclick="sendCode()">获取验证码</span></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">验证码</label></div><div class="weui-cell__bd"><input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入验证码" name="code" id="code"></div></div><div class="weui-btn-area"><a class="weui-btn weui-btn_primary" href="javascript:" id="varifymobile" onclick="enter_mobile_varify()">确定</a></div></div>'
      ,anim: 'up'
      ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 180px; padding:10px 0; border:none;'
    });
   return false;
}
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
       //先验证参团状态
    $.ajax({
         url:'/varifyCantuan',
         type:'POST',
         data:"product_id="+productid+"&tuan_id="+tuanid+"&uid="+uid,
         success:function(data){
                    if(data.status==false){
                             layer.open({
								   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了'
                    });
                        return;
                }else{
            //验证成功
     
                    if(account_price<price){
                      var status_price='不足';
                    }else{
                       var status_price=account_price;
                    }
                    layer.open({
            type: 1
            ,content: '<div class="title">支付方式</div><div id="weixin" value="2" class="type active"  data-weixindata='+data+' onclick="jumpToWeixinPay()"><img src="{{asset("images/weixinjie.png")}}" /><span>微信支付</span><i class="icon-ok"></i></div><div id="yue" value="2" class="type" data-status_price="'+status_price+'" onclick="jumpToYuePay()" ><img src="{{asset("img/3_03.png")}}" /><span>账户余额'+status_price+'</span><i class="icon-ok"></i></div>'
            ,anim: 'up'
            ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
          });
              
          
           
                }
            }
        });
    });
//验证手机号
function enter_mobile_varify(){
    var tuanid=$('.join').data('tuanid');
    var uid=$('.join').data('uid');
    var price=$('.join').data('price');
    var mobile=$("input[name='mobile']").val();
    var code=$('#code').val();
    if(mobile==null || mobile=='' || mobile.length<11 || mobile.length>11){
      alert('手机号格式不正确');
      return false;
    }

        if(code==null || code=='' || code.length<4 || code.length>4){
      alert('验证码格式不正确');
      return false;
    }
    
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

//先更新手机号

    $.ajax({
      url:'/post_register',
      type:'POST',
      data: {mobile:mobile, code:code},
      success:function(data){
          if(data==='成功'){
  //先验证参团状态
   $.ajax({
         url:'/varifyCantuan',
         type:'POST',
         data:"product_id="+productid+"&tuan_id="+tuanid+"&uid="+uid,
         success:function(data){
                    if(data.status==false){
                             layer.open({
								   title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了'
                    });
                        return;
                }else{
         
          
                    //data = JSON.parse(data)
                  if(account_price<price){
                      var status_price='不足';
                    }else{
                       var status_price=account_price;
                    }
                    layer.open({
            type: 1
            ,content: '<div class="title">支付方式</div><div id="weixin" value="2" class="type active"  onclick="jumpToWeixinPay()"><img src="{{asset("images/weixinjie.png")}}" /><span>微信支付</span><i class="icon-ok"></i></div><div id="yue" value="2" class="type" data-status_price="'+status_price+'" onclick="jumpToYuePay()" ><img src="{{asset("img/3_03.png")}}" /><span>账户余额'+status_price+'</span><i class="icon-ok"></i></div>'
            ,anim: 'up'
            ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
          });

             
             
                }
            }
        });


          }else{
            alert('输入信息不正确');
          }
      }
    })

     
}
//微信支付
function jumpToWeixinPay(){
        $.ajax({
                url: '/starttuan',
                type: 'POST',
                data: {product_id: productid, user_id: uid ,price:price,type:'微信支付'},
                success: function(data) {
                    if (data.code == 1) {
                       // alert();
                        layer.open({
                title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.message
                        ,btn: '我知道了'
                    });
                        return;
                    }

                    data = data.message;
                    data=JSON.parse(data);
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
                         
                    $.ajax({
                url: '/JoinProductTuan',
                type: 'POST',
                data: "uid="+uid+"&tuan_id="+tuanid,
                success: function(data) {
                    if(data.status){
                        layer.open({
                title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: '参团成功'
                        ,btn: '我知道了'
                        });
                    window.location.reload();
                    }else{
                         layer.open({
                 title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了'
                        });
                         return false;
                    }
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
                            window.location.reload();
                        }
                      }
                    );
        }
        });
}

//使用账户余额支付
function jumpToYuePay(){
  var status_price=document.getElementById("yue").dataset.status_price;
  console.log(status_price);

        $.ajax({
                url: '/starttuan',
                type: 'POST',
                data: {product_id: productid, user_id: uid ,price:price,type:'账户余额支付'},
                success: function(data) {
                    if (data.code == 1) {
                       // alert();
                        layer.open({
                title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.message
                        ,btn: '我知道了'
                    });
                        return;
                    }
  if(status_price!="不足"){
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                                url:'/updateAccountprice',
                                 type: 'POST',
                                data: "price="+price,
                                success: function(data) {
                                    if(data.status){
           $.ajax({
                url: '/JoinProductTuan',
                type: 'POST',
                data: "uid="+uid+"&tuan_id="+tuanid,
                success: function(data) {
                    if(data.status){
                        layer.open({
                title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: '参团成功'
                        ,btn: '我知道了'
                        });
                    window.location.reload();
                    }else{
                         layer.open({
                 title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                        content: data.msg
                        ,btn: '我知道了'
                        });
                         return false;
                    }
                   }
                });
}
}
   });
  }else{
    console.log('账户余额不足');
  }
}
});

}

    //发送验证码
    function sendCode() {
    var mobile=$("input[name='mobile']").val();
      var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
      if(!myreg.test(mobile)) 
      { 
          alert('请输入有效的手机号码！'); 
          return false; 
      } 

      event.preventDefault();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      $.ajax({
        url: '/sendCode',
        type: 'GET',
        data: {mobile:mobile},
      });

      time();
    }


    var wait=60;
    function time() {
      o = $('#getcode');
      if (wait == 0) {
        o.removeAttr("disabled");   
        o.text("获取验证码");
        wait = 60;
      } else { 

        o.attr("disabled", true);
        o.text("重新发送(" + wait + ")");
        wait--;
        setTimeout(function() {
          time()
        }, 1000)
      }
    }

</script>
    
@endsection