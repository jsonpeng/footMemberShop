<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', '类型:') !!}
    {!! Form::select('type', ['满减券' => '满减券','打折券' => '打折券','代金券' => '代金券','生日券' => '生日券'] , null, ['class' => 'form-control selectpicker conpon_type']) !!}
</div>

<!-- Together Field -->
<div class="form-group col-sm-12">
    {!! Form::label('base', '消费金额限制:') !!}
    {!! Form::text('base', null, ['class' => 'form-control']) !!}
</div>

<!-- Together Field -->
<div class="form-group col-sm-12 given">
    {!! Form::label('given', '优惠金额:') !!}
    {!! Form::text('given', null, ['class' => 'form-control']) !!}
</div>

<!-- Together Field -->
<div class="form-group col-sm-12 discount">
    {!! Form::label('discount', '折扣(折扣，九折就输入90，不打折就输入100):') !!}
    {!! Form::text('discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('time_type', '有效期类型:') !!}
    {!! Form::select('time_type', ['固定日期' => '固定日期','固定天数' => '固定天数'] , null, ['class' => 'form-control selectpicker type_type']) !!}
</div>

<div class="form-group col-sm-12 fixeddate">
    {!! Form::label('time_end', '固定日期(有效期):') !!}
    <div class='input-group date' id='datetimepicker_end'>
        {!! Form::text('time_end', null, ['class' => 'form-control', 'maxlength' => '10']) !!}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>

<!-- Expired Days Field -->
<div class="form-group col-sm-12 floatdate">
    {!! Form::label('expired_days', '固定天数(领券后有效天数):') !!}
    {!! Form::number('expired_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Together Field -->
<div class="form-group col-sm-12">
    {!! Form::label('limit', '禁用时间(此时间内不能消费):') !!}
    {!! Form::select('limit', ['无' => '无','周末' => '周末','工作日' => '工作日'] , null, ['class' => 'form-control selectpicker type_type']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('coupons.index') !!}" class="btn btn-default">取消</a>
</div>
