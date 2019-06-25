@extends('front.base')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{  asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('css/api.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  asset('css/detail.css') }}" />
    <style>
    .more{
    display:none;
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
          /*  .active{
                border: 1px solid #62b900;
            }*/
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

        .a{
        width: 100%;
        height: 100px;
        margin-top: 0px;
      }
      .bbb{
        color: #1C1C1C;
        font-size: 16px;
        display: inline-block;
        margin-top: 10px;
      }
      .ccc{
        font-size: 16px;
        color: red;
        margin-left: 10px;
      }
      .ddd{
        font-size: 12px;
        text-decoration: line-through;
        color: #979797;
        margin-left: 5px;
      }
     .a p{
        color: #aeb362;
        font-size: 13px;
        margin-top: 8px;
      }

    </style>
@endsection


@section('content')
    
  <div id="myCarousel" class="carousel slide">
      <!-- 轮播（Carousel）指标 -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        @if(($products->image()->count()>0))
        <?php $i=0;?>
        @foreach($products->image()->get() as $images)
        <?php $i++;?>
        <li data-target="#myCarousel" data-slide-to="{!! $i !!}"></li>
        @endforeach
        @endif
      </ol>
      <!-- 轮播（Carousel）项目 -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{  $products->banner }}" alt="slide">
          <div class="carousel-caption"></div>
        </div>
        @if(($products->image()->count()>0))
        @foreach($products->image()->get() as $images)
        <div class="item">
          <img src="{{ $images->url }}" alt="slide">
          <div class="carousel-caption"></div>
        </div>
       @endforeach
        @endif
      </div>


    </div>

<div class="overtime"></div>
<div class="container">
<div class="a">
        <span class="bbb">{{$products->name}}</span>
        <span class="ccc">￥{{$products->price}}</span>
        <span class="ddd">￥{{$products->o_price}}</span>
        <p>满{!! $products->tuan_num !!}团开奖·每团{!! $products->man_num !!}人·已拼成{!! $products->pinman !!}个团·中奖团长有额外奖励</p>
      </div>
 <!--    <div class="base">
      <span class="price">￥{{$products->price}}</span>
      <span class="incloud">满{!! $products->tuan_num !!}团开奖·每团{!! $products->man_num !!}人·已拼成{!! $products->pinman !!}个团·团长得两份</span>
    </div> -->
   <!--  <div class="title">{{$products->name}}</div> -->
    </div>
    
    <div class="context">
      <div class="duhao">
        <img src="{{ asset('images/duihao.png') }}" />
        <span>公平公正</span>
      </div>
      <div class="duhao">
        <img src="{{ asset('images/duihao.png') }}" />
        <span>正品保障</span>
      </div>
      <div class="duhao">
        <img src="{{ asset('images/duihao.png') }}" />
        <span>全场包邮</span>
      </div>
      <div class="duhao">
        <img src="{{ asset('images/duihao.png') }}" />
        <span>假一赔十</span>
      </div>
    </div>
    
    <div class="oneitem">
      <span class="one">已开{{$products->tuaninfo()->count()}}个团,{{$products->joinnum }}人正在拼单</span>
      <img class="three" src="{{ asset('images/right.png') }}" />
      <span class="two" id="more" data-status="one">查看更多</span>
    </div>
    
    <div class="partlist">
    @if(!empty($products->tuaninfo()->orderBy('created_at','desc')->first()))
    <?php $first_pro=$products->tuaninfo()->orderBy('created_at','desc')->first(); ?>

    
      <ul class="first">
        <li data-url="/share/{!! $first_pro->id !!}">
          <img class="one" src="{!! $first_pro->tuanzhang->header !!}" />
          <span class="two">{!! $first_pro->tuanzhang->nickname !!}</span>
         @if($first_pro->chanum>0)<span class="four"   style="background-color:{{$first_pro->whetherguoqi=='已过期'?'rgba(0,0,0,0.4)':'#E02E24'}};">{!! $first_pro->whetherguoqi !!}</span>@endif
          <span class="three">@if($first_pro->chanum<=0)参团人数已满@else还差<i>{!! $first_pro->chanum !!}人</i>拼成@endif</span>
        </li>
      </ul>
 

      <ul class="more" >
      @foreach($products->tuaninfo()->orderBy('created_at','desc')->get() as $list)
        <li data-url="/share/{!! $list->id !!}"> 
          <img class="one" src="{!! $list->tuanzhang->header !!}" />
          <span class="two">{!! $list->tuanzhang->nickname !!}</span>
          @if($list->chanum>0)<span class="four"  style="background-color:{{$list->whetherguoqi=='已过期'?'rgba(0,0,0,0.4)':'#E02E24'}};">{!! $list->whetherguoqi !!}</span>@endif
       <span class="three">@if($list->chanum<=0)参团人数已满@else还差<i>{!! $list->chanum !!}人</i>拼成@endif</span>
        </li>
   
      @endforeach
      </ul>
      @endif
    </div>
    
    <div class="detail">
      <span class="title">商品详情</span>
      <div class="tuwen">
        {!! $products->img_content !!}
      </div>
    </div>
    
    <div class="bottommenu">
      <div class="one" onclick="redirectToIndex()">
        <img src="{{ asset('images/shouye.png') }}" />
        <span>首页</span>
      </div>
      <!--
      <div class="one">
        <img src="{{ asset('images/nocollect.png') }}" />
        <span>收藏</span>
      </div>-->
      <div class="two" data-uid="{{$user->id}}" data-guoqi="{{$products->whetherguoqi}}" data-productid="{{$products->id}}" data-price="{{$products->price}}" data-endtime="{{$products->end_time}}" style="background-color:{{$products->whetherguoqi=='已过期'?'rgba(0,0,0,0.4)':'#E02E24'}};" >
     
      </div>
    </div>

@endsection

@section('js')
<script src="{{  asset('js/bootstrap.min.js') }}"></script>
<script src="{{  asset('js/touch.js') }}"></script>
<script type="text/javascript">
var account_price='{!! $user->account_price !!}';
//轮播图左右滑动事件
$("#myCarousel").swipe({
swipeLeft: function() { $(this).carousel('next'); },
swipeRight: function() { $(this).carousel('prev'); },
}); 


//结束倒计时
var interval = 1000;
var end_time ='{!! $products->end_time !!}';
var uid;
var productid;
var price;
var end_time;
end_time=end_time.replace(/-/g, '/');  
var dates=new Date(Date.parse(end_time));
var end_year=dates.getFullYear();
var end_month=dates.getMonth()+1;
var end_day=dates.getDate();
var end_hour=dates.getHours();
var end_min=dates.getMinutes();
var end_sec=dates.getSeconds();
//计算倒计时
function ShowCountDown(year,month,day,hour,min,sec,divname) 
{ 
var now = new Date(); 
var endDate = new Date(year, month-1, day,hour,min,sec); 
var leftTime=endDate.getTime()-now.getTime(); 
var leftsecond = parseInt(leftTime/1000); 

if(leftsecond<=0){
$('.'+divname).html("已过期");
$('.bottommenu>.two').data('guoqi','已过期')
$('.bottommenu>.two').html("已过期");
$('.bottommenu>.two').css("background-color","rgba(0,0,0,0.4)");
return;
}
var day1=Math.floor(leftsecond/(60*60*24)); 
var hour=Math.floor((leftsecond-day1*24*60*60)/3600); 
var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60); 
var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60); 

//cc.innerHTML = "距离"+year+"年"+month+"月"+day+"日还有："+day1+"天"+hour+"小时"+minute+"分"+second+"秒"; 

$('.'+divname).html("距离拼团结束还有："+day1+"天"+hour+"小时"+minute+"分"+second+"秒");
$('.bottommenu>.two').html("一键拼单");
} 
setInterval(function(){ShowCountDown(end_year,end_month,end_day,end_hour,end_min,end_sec,'overtime');}, interval); 

//查看更多
$('.oneitem>.two').click(function(){
  var status=$(this).data('status');
  //console.log('more');
      if(status=="one"){
    $('.partlist>.first').css('display','none');
    $('.partlist>.more').css('display','block');
    $(this).data('status','more');
    }else{
    $('.partlist>.first').css('display','block');
    $('.partlist>.more').css('display','none');
    $(this).data('status','one');
    }
});

//跳转到分享拼单
$('.first>li,.more>li').click(function(){
  //console.log('redirect');
  var url=$(this).data('url');
  window.location.href=url;
});

//开团
$('.bottommenu>.two').click(function(){
      if($(this).data('guoqi')=='已过期'){
      return;
    }
    uid=$(this).data('uid');
    productid=$(this).data('productid');
    price=$(this).data('price');
    end_time=$(this).data('endtime');
   // console.log(end_time);
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       //验证开团状态
       $.ajax({
         url:'/varifyKaituan',
         type:'POST',
         data:'product_id='+productid,
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
                    if(account_price<price){
                      var status_price='不足';
                    }else{
                       var status_price=account_price;
                    }
                    layer.open({
            type: 1
            ,content: '<div class="title">支付方式</div><div id="weixin" value="2" class="type active" onclick="jumpToWeixinPay()"><img src="{{asset("images/weixinjie.png")}}" /><span>微信支付</span><i class="icon-ok"></i></div><div id="yue" value="2" class="type" data-status_price="'+status_price+'" onclick="jumpToYuePay()" ><img src="{{asset("img/3_03.png")}}" /><span>账户余额'+status_price+'</span><i class="icon-ok"></i></div>'
            ,anim: 'up'
            ,style: 'position:fixed; bottom:0; left:0; width: 100%; height:auto; padding:10px 0; border:none;'
          });
                   


                }
         }
       });
    });

//选择微信支付
function jumpToWeixinPay(){
           $.ajax({
                url: '/starttuan',
                type: 'POST',
                data: {product_id: productid, user_id: uid ,price:price,type:'微信支付'},
                success: function(data) {
                    if (data.code == 1) {
                   
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
                                          $.ajaxSetup({
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                          });
                            $.ajax({
                                url: '/KaiProductTuan',
                                type: 'POST',
                                data: "uid="+uid+"&product_id="+productid+"&name="+"测试团"+"&end_time="+end_time,
                                success: function(data) {
                                    if(data.status==true){
                                    layer.open({
                      title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                                        content: '开团成功'
                                        ,btn: '我知道了'
                                    });
                                     //跳转到个人中心
                                 window.location.href='/mejoinlist';
                             }else if(data.status==false){
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
                         content: '支付失败 ' 
                            ,btn: '我知道了'
                            });
                            window.location.reload();

                        }
                      }
                    );

                }
            });
}
//使用钱包余额支付
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
                                url: '/KaiProductTuan',
                                type: 'POST',
                                data: "uid="+uid+"&product_id="+productid+"&name="+"测试团"+"&end_time="+end_time,
                                success: function(data) {
                                    if(data.status==true){
                                    layer.open({
                      title: [
                            '三不馆商城',
                            'background-color:#8DCE16; color:#fff;'
                          ],
                                        content: '开团成功'
                                        ,btn: '我知道了'
                                    });
                                     //跳转到个人中心
                                 window.location.href='/mejoinlist';
                             }else if(data.status==false){
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

function redirectToIndex(){
  window.location.href="/productList";
}


</script>
    
@endsection