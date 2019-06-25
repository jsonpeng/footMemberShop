<!-- Card Intro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tongji_limit', '当日消费次数告警(试图消费超过该次数):') !!}
    {!! Form::number('tongji_limit', null, ['class' => 'form-control']) !!}
</div>

<!-- Card Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('serias_limit', '连续消费天数告警:') !!}
    {!! Form::number('serias_limit', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('settings.index') !!}" class="btn btn-default">取消</a>
</div>
