<!-- Tuan Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tuan_num', '最大团数量:') !!}
    {!! Form::text('tuan_num', null, ['class' => 'form-control']) !!}
</div>

<!-- Man Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('man_num', '单个团最大参加人数:') !!}
    {!! Form::text('man_num', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
</div>
