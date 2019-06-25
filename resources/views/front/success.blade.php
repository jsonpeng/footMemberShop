@extends('front.base')

@section('css')

@endsection

@section('content')
<div class="page msg_success js_show">
<div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">{!! $msg !!}</h2>
            <p class="weui-msg__desc">内容详情，可根据实际需要安排，如果换行则不超过规定长度，居中展现<a href="javascript:void(0);">文字链接</a></p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="javascript:history.back();" class="weui-btn weui-btn_primary">回到首页</a>
                <a href="javascript:history.back();" class="weui-btn weui-btn_default">查看记录</a>
            </p>
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">
                <p class="weui-footer__links">
                    <a href="javascript:void(0);" class="weui-footer__link">成功操作</a>
                </p>
                <p class="weui-footer__text">Copyright © 2008-2017 三不馆</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection