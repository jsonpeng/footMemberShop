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
    
<div class="page">
 <div class="page__hd">
        <!--<h1 class="page__title" style="text-align: left;
    font-size: 20px;
    font-weight: 400;
    padding-left: 10px;
    padding-bottom: 20px;
    padding-top: 20px;">消费记录</h1>-->
        <p class="page__desc"></p>
    </div>
      <div class="page__bd">
    @if(count($consume_record)==0)
    <div style="text-align:center;">这里空空如也~</div>
    @endif
     @foreach($consume_record as $record)
    <div class="weui-form-preview">
            <div class="weui-form-preview__hd">
                <label class="weui-form-preview__label">状态</label>
                <em class="weui-form-preview__value">{!! $record->status !!}</em>
            </div>

            <div class="weui-form-preview__bd">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">单号</label>
                    <span class="weui-form-preview__value">{!! $record->order_num !!}</span>
                </div>

                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">消费时间</label>
                    <span class="weui-form-preview__value">{!! $record->created_at !!}</span>
                </div>
            
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">消费商品名称</label>
                    <span class="weui-form-preview__value">{!! $record->product_name !!}</span>
                </div>

                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">消费金额</label>
                    <span class="weui-form-preview__value">{!! $record->price !!}</span>
                </div>

            <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">支付方式</label>
                    <span class="weui-form-preview__value">{!! $record->type !!}</span>
                </div>
                   
            </div>
        </div>
        <br >
    @endforeach
    </div>
    </div>

@endsection

@section('js')
  
@endsection