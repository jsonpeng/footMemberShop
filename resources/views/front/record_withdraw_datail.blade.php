@extends('front.base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/api.css') }}" />
        <style>
            html, body { width: 100%;  height: 100%; float: left; background-color: #e5e5e5; font-family: 'Microsoft YaHei';}
            .banklogo{ width: 100%; height: auto; float: left; margin-top: 20px;}
            .banklogo span{ width: 100%; text-align: center; height: 40px; line-height: 40px; float: left;}
            .account{ width: 100%; height: 40px; line-height: 40px; text-align: center; float: left; font-size: 35px; color: #333333;}
            .state{ width: 100%; height: 20px; line-height: 20px; text-align: center; float: left; font-size: 15px; color: #555555;}
            .twoitem{ width: 90%; height: auto; float: left; padding-left: 5%; padding-right: 5%; border-bottom: 1px solid #e3e3e3;}
            .twoitem span:nth-child(1){ width: auto; height: 44px; line-height: 44px; float: left; font-size: 15px; color: #444444;}
            .twoitem span:nth-child(2){ width: auto; height: 44px; line-height: 44px; float: right; font-size: 15px; color: #444444;}
            .jindu{ width: 90%; margin-top: 10px; margin-bottom: 10px; padding-left: 5%; height: auto; padding-right: 5%; float: left;}
            .jindu .jinduname{ width: 80px; height: 44px; line-height: 44px; float: left; font-size: 15px; color: #444444;}
            .jindu .jindulist{ width: calc(100% - 80px); height: auto; float: left; margin-top: 10px;}
            .jindu .jindulist .oneitem{ width: 100%; height: auto; float: left;}
            .jindu .jindulist .oneitem img:nth-child(1){ width: 20px; height: 20px; float: left;}
            .jindu .jindulist .oneitem span:nth-child(2){ margin-left: 10px; width: auto; height: 20px; float: left; font-size: 15px;}
            .jindu .jindulist .oneitem span:nth-child(3){ width: auto; height: 20px; float: right; font-size: 15px; color: #AAAAAA;}
            .jindu .jindulist .line{ width: 1.5px; margin-left: 9px; height: 20px; float: left; margin-right: calc(100% - 21px); background-color: #3a61a2;}
            .jindu .jindulist .oneitem .active{ margin-left: 10px; width: auto; height: 20px; float: left; font-size: 15px; color: #3a61a2;}
            
        </style>
@endsection


@section('content')
    

   
        <div class="banklogo">
            <span id="bank_name">{!! $account_record->card_name !!}</span>
        </div>
        <span id="amount" class="account">{!! $account_record->formatprice !!}</span>
        <span id="tx_state" class="state">交易状态</span>
        <div class="twoitem">
            <span>提现说明</span>
            <span id="tx_ways"></span>
        </div>
        <div class="jindu">
            <span class="jinduname">处理进度</span>
            <div class="jindulist">
                <div class="oneitem">
                    <img src="{{asset('images')}}/is<?php echo $account_record->status=='发起提现'?'':'no';?>has.png" />
                    <span class="{!! $account_record->status=='发起提现'?'active':'' !!}">申请成功</span>
                    <span id="starttime"></span>
                </div>
                <i class="line"></i>
                <div class="oneitem">
                    <img id="yujitime1" src="{{asset('images')}}/is<?php echo $account_record->status=='处理中'?'':'no';?>has.png" />
                    <span class="{!! $account_record->status=='处理中'?'active':'' !!}">预计到账时间</span>
                    <span id="tx_arrival_time">{!! $account_record->arrive_time !!}</span>
                </div>
                <i class="line"></i>
                <div class="oneitem">
                    <img id="yujitime2" src="{{asset('images')}}/is<?php echo $account_record->status=='已完成'?'':'no';?>has.png" />
                    <span class="{!! $account_record->status=='已完成'?'active':'' !!}" id="yujidaozhangs">到账成功</span>
                    <span id="actual_payment_time"></span>
                </div>
            </div>
        </div>
        <div class="twoitem">
            <span>提现到</span>
            <span id="addressmoney">{!! $account_record->card_name !!}</span>
        </div>
        <div class="twoitem">
            <span>创建时间</span>
            <span id="op_time">{!!  $account_record->created_at !!}</span>
        </div>

  
@endsection

@section('js')

    
@endsection