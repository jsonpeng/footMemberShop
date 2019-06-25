@extends('front.base')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/api.css') }}"/>
    <style>
        .list{ width: 100%; height: auto; float: left;}
        .list ul{ width: 100%; height: auto; float: left;}
        .list ul li{ width: 90%; padding-left: 5%; padding-right: 5%; height: auto; float: left; border-bottom: 1px solid #e5e5e5; padding-top: 10px; padding-bottom: 10px;}
        .list ul li .oneitem{ width: 50%; height: auto; float: left;}
        .list ul li .oneitem2{ width: 50%; height: auto; float: left;}
        .list ul li .oneitem span:nth-child(1){ width: 100%; float: left; height: 25px; line-height: 25px; font-size: 18px;}
        .list ul li .oneitem span:nth-child(2){ width: 100%; float: left; height: 20px; line-height: 20px; font-size: 15px; color: #AAAAAA; margin-top: 5px;}
        .list ul li .oneitem2 span:nth-child(1){ width: 100%; float: left; height: 20px; line-height: 20px; font-size: 15px; text-align: right;}
        .list ul li .oneitem2 span:nth-child(2){ width: 100%; float: left; height: 25px; line-height: 25px; font-size: 18px; text-align: right; margin-top: 5px;}
        
    </style>
@endsection

@section('content')
    @if(count($account_record)==0)
    <div style="text-align:center;">这里空空如也~</div>
    @endif
    @foreach($account_record as $record)
    <div class="list">
        <ul id="list">
            <li>
                <div class="oneitem">
                    <span>充值</span>
                    <span>余额{{$record->account_tem}}</span>
                </div>
                <div class="oneitem2">
                    <span>{{$record->formatdate}}</span>
                    <span>+{{$record->formatprice}}</span>
                </div>
            </li>
        </ul>
    </div>
    @endforeach
@endsection

@section('js')

    
@endsection