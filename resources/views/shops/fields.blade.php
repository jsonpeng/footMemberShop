<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('shop_id', '店铺ID:') !!}
    {!! Form::text('shop_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('card_price', '会员卡价格:') !!}
    {!! Form::text('card_price', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('card_limit', '当日最大消费次数:') !!}
    {!! Form::number('card_limit', null, ['class' => 'form-control']) !!}
</div>


<!-- <div class="form-group col-sm-6">
    {!! Form::label('card_pic', '会员卡图片:') !!}
    {!! Form::text('card_pic', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('card_intro', '会员卡说明:') !!}
    {!! Form::text('card_intro', null, ['class' => 'form-control']) !!}
</div> -->


<!-- Intro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro', '介绍:') !!}
    {!! Form::text('intro', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('shops.index') !!}" class="btn btn-default">取消</a>
</div>
