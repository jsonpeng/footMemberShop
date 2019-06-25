<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', '用户Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Card Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('card_name', '银行卡名称:') !!}
    {!! Form::text('card_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Starthu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starthu', '开户行:') !!}
    {!! Form::text('starthu', null, ['class' => 'form-control']) !!}
</div>

<!-- User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_name', '姓名:') !!}
    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
</div>

<!-- User Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_mobile', '开户手机号:') !!}
    {!! Form::text('user_mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Card No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('card_no', '银行卡号:') !!}
    {!! Form::text('card_no', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('type', '银行卡类型:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bankinfos.index') !!}" class="btn btn-default">返回</a>
</div>
