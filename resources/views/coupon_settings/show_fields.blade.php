<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $couponSetting->id !!}</p>
</div>

<!-- Coupon Id Field -->
<div class="form-group">
    {!! Form::label('coupon_id', 'Coupon Id:') !!}
    <p>{!! $couponSetting->coupon_id !!}</p>
</div>

<!-- Number Field -->
<div class="form-group">
    {!! Form::label('number', 'Number:') !!}
    <p>{!! $couponSetting->number !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $couponSetting->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $couponSetting->updated_at !!}</p>
</div>

