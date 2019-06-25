@extends('front.base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/api.css') }}" />
        <style>
            html,body{ background-color: #f2f2f2;}
            .typelist{ background-color: #fff; padding-bottom: 10px; width: 100%; height: auto; float: left;}
            .typelist ul{ width: 100%; height: auto; float: left;}
            .typelist ul li{ width: 25%; height: auto; float: left;}
            .typelist ul li img{ width: 30px; height: 30px; margin-left: calc(50% - 15px); float: left; margin-top: 8px;}
            .typelist ul li span{ width: 100%; height: auto; float: left; text-align: center; color: #666; font-size: 12px; margin-top: 5px;}
        
            .list{ width: 100%; height: auto; float: left; margin-top: 5px;}
            .list ul{ width: 100%; height: 100%; float: left;padding-bottom: 60px;}
            .list ul li{ width: 49.4%; height:auto;margin-left: 0.3%;margin-top: 2px; float: left; background-color: #fff;}
            .list ul li .showpic{ width: 90%; height:100%;margin: 5px 5% 5px 5%; float: left;}
            .list ul li .title{ width: 90%; height: auto; float: left; line-height: 16px; font-size: 12px; margin-left: 5%;}
            .list ul li .pro{ margin-top: 5px; width: 90%; height: auto; float: left; margin-left: 5%;}
            .list ul li .pro .price{ width: auto; height: 20px; float: left; line-height: 20px; font-size: 14px; color: #C9302C;}
            .list ul li .pro .price i{ font-style: normal; font-size: 12px;}
            .list ul li .pro .num{ width: auto; height: 20px; float: right; line-height: 20px; font-size: 12px; color: #666;}
            .weui-tabbar { position: fixed; }
        </style>
@endsection


@section('content')
    
    <div class="typelist">
            <ul>
                 @foreach ($cats as $cat)
                <li class="redirect_cat" onclick="redirect_cat()" data-url="/productList/{{$cat->id}}">
                    <img src="{{$cat->image}}" />
                    <span >{{$cat->name}}</span>
                </li>
                @endforeach
                <li class="redirect_cat" onclick="redirect_cat()"  data-url="/productList">
                    <img src="{{ asset('images/alltype.png') }}" />
                    <span >全部分类</span>
                </li>
            </ul>
    </div>

    <div class="list">
                <ul>
                 @foreach ($products as $products)
                    <li onclick="redirect_product({{$products->id}})">
                        <div style="height:120px;">
                        <img class="showpic" src="{{$products->banner}}" />
                        </div>
                        <span class="title">{{$products->name}}</span>
                        <div class="pro">
                            <span class="price"><i>￥</i>{{$products->price}}</span>
                            <span class="num">已拼{{$products->joinnum }}人</span>
                        </div>
                    </li>
                @endforeach
                </ul>
    </div>



<div class="weui-tabbar">
                <a href="/productList/" class="weui-tabbar__item weui-bar__item_on">
                    <span style="display: inline-block;position: relative;">
                        <img src="{{asset('images/shouye.png')}}" alt="" class="weui-tabbar__icon">
                 <!--        <span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">1</span> -->
                    </span>
                    <p class="weui-tabbar__label">首页</p>
                </a>
            
                <a href="/usercenter/" class="weui-tabbar__item">
                    <img src="{{asset('images/nopart.png')}}" alt="" class="weui-tabbar__icon">
                    <p class="weui-tabbar__label">我的</p>
                </a>
</div>
@endsection


@section('js')
<script type="text/javascript">
    function redirect_product(product_id){
        window.location.href="/productContent/"+product_id;

    }
   $('.redirect_cat').click(function(){
        var url=$(this).data('url');
         window.location.href=url;
   });
       
</script>
    
@endsection