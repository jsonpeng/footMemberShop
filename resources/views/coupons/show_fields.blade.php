
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', '名称:') !!}
    <p>{!! $coupon->name !!}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', '类型:') !!}
    <p>{!! $coupon->type !!}</p>
</div>

<!-- Time Type Field -->
<div class="form-group">
    {!! Form::label('time_type', '有效期类型:') !!}
    <p>{!! $coupon->time_type !!}</p>
</div>


<!-- Time End Field -->
<div class="form-group">
    {!! Form::label('time_end', '截止时间(适用于固定日期类型):') !!}
    <p>{!! $coupon->time_end !!}</p>
</div>

<!-- Expired Days Field -->
<div class="form-group">
    {!! Form::label('expired_days', '过期天数(适用于固定天数类型):') !!}
    <p>{!! $coupon->expired_days !!}</p>
</div>

<!-- Base Field -->
<div class="form-group">
    {!! Form::label('base', '满额:') !!}
    <p>{!! $coupon->base !!}</p>
</div>

<!-- Given Field -->
<div class="form-group">
    {!! Form::label('given', '优惠金额:') !!}
    <p>{!! $coupon->given !!}</p>
</div>

<!-- Discount Field -->
<div class="form-group">
    {!! Form::label('discount', '折扣:') !!}
    <p>{!! $coupon->discount !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '创建日期:') !!}
    <p>{!! $coupon->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', '更新日期:') !!}
    <p>{!! $coupon->updated_at !!}</p>
</div>

