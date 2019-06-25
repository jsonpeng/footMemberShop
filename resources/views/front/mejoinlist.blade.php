@extends('front.base')

@section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/api.css') }}" />
        <style>
            .list{ width: 100%; height: auto; float: left;}
            .list ul{ width: 100%; height: auto; float: left;}
            .list ul li{ width: 96%; padding-left: 2%; padding-right: 2%; height: auto; float: left; padding-bottom: 10px; padding-top: 5px; border-bottom: 10px solid #F2F2F2;}
            .list ul li .zhong{ margin-bottom: 8px; width: 100%; height: 30px; float: left; line-height: 30px; color: #E02E24; font-size: 15px; border-bottom: 1px solid #F2F2F2;}
            .list ul li .pic{ width: 50px; height: 50px; margin-top: 5px; margin-bottom: 5px; float: left;}
            .list ul li .item{ width: calc(100% - 60px); margin-left: 10px; height: 50px; float: left;}
            .list ul li .item .title{ width: 100%; height: auto; line-height: 20px; font-size: 14px; float: left;}
            .list ul li .item .content{ width: 100%; height: 20px; line-height: 20px; float: left; font-size: 13px; color: #666;}
            .list ul li .money{ margin-top: 8px; width: 100%; height: auto; float: left; border-top: 1px solid #f2f2f2;}
            .list ul li .money img{ width: 18px; height: 18px; float: right; margin-top: 8.5px;}
            .list ul li .money span{ width: auto; height: 35px; line-height: 35px; float: right; font-size: 15px; color: #333;}
            .list ul li .enjory{ width: 100px; height: 30px; line-height: 30px; float: right; background-color: #E02E24; color: #fff; font-size: 14px; text-align: center; border-radius: 5px;}
            .nomore{ width: 100%; height: 60px; float: left; line-height: 60px; text-align: center; font-size: 15px; color: #aaa;}
        </style>
@endsection


@section('content')
@if($tuan_info=='' || count($tuan_info)==0)
    <div style="text-align:center;">这里空空如也~</div>
@endif
@if(!empty($tuan_info))
 @foreach($tuan_info as $tuan_infos)
    <?php $link=$tuan_infos->id; ?>
<div class="list">
            <ul>
                <li class="enter_share" data-url="/share/{{$link}}">
                <div >
                    <span class="zhong">@if($tuan_infos->whetherguoqi=='已过期')已过期@elseif($tuan_infos->chanum<=0)参团人数已满@elseif($tuan_infos->chanum>0)拼团中，还差{{$tuan_infos->chanum}}人@endif|@if($tuan_infos->winner=='是')已中奖@elseif($tuan_infos->whether_fanxian=='是')未中奖@else未开奖@endif</span>
                    <img class="pic" src="{!! $tuan_infos->products()->first()->banner !!}" />
                    <div class="item">
                        <span class="title">{{$tuan_infos->products()->first()->name}}</span>
                        <span class="content">数量: 1</span>
                    </div>
                    <div class="money">
                        <span>实付：{{$tuan_infos->products()->first()->price}}</span>
                        <img src="{{ asset('images/money.png') }}" />
                    </div>
                </div>
                    <span class="enjory">邀请好友拼团</span>
                </li>
            </ul>
        </div>
    @endforeach
        <div class="nomore">您已经没有更多订单了</div>
@endsection
@endif

@section('js')
<script type="text/javascript">
$('.enter_share').click(function(){
var url=$(this).data('url');
window.location.href=url;
});
</script>
    
@endsection


             