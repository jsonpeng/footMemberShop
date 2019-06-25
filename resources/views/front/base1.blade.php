<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>金尊卡会员</title>

    <link rel="stylesheet" href="{{ asset('vendor/weui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
     <style>

    .layui-m-layerbtn span[yes] {
        color: #8DCE16 !important;
    }
    .weui-btn{font-size: 16px;}
    .weui-btn-area{
        margin: 0;
        padding: 0 25px;
        padding-bottom: 25px;
    }

    </style>
    @yield('css')
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">你正在使用<strong>过时的</strong> 浏览器. 请 <a href="http://browsehappy.com/">更新你的浏览器</a> 以提升您的上网体验.</p>
<![endif]-->

@yield('content')

</body>

<script src="{{ asset('js/jquery-1.9.0.min.js') }}"></script>
<script src="{{ asset('js/jweixin-1.0.0.js') }}"></script>
<script src="{{ asset('layer_mobile/layer.js') }}"></script>
<script src="{{ asset('js/datePicker.js') }}"></script>
@yield('js')
</html>