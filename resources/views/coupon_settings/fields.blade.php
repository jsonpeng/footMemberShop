<!-- Coupon Id Field -->
<div class="form-group col-sm-6">
	{!! Form::label('number', '要赠送的优惠券:') !!}
    <select name="coupon_id" class="form-control">
    	@foreach ($coupons as $coupon)
    		<option value="{{$coupon->id}}">{{$coupon->name}}</option>
    	@endforeach
    </select>
</div>

<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', '张数:') !!}
    {!! Form::number('number', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('couponSettings.index') !!}" class="btn btn-default">取消</a>
</div>
