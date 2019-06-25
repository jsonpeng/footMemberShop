<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Info Field -->
<div class="form-group col-sm-6">
    {!! Form::label('info', 'Info:') !!}
    {!! Form::text('info', null, ['class' => 'form-control']) !!}
</div>

<!-- Backup01 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('backup01', 'Backup01:') !!}
    {!! Form::text('backup01', null, ['class' => 'form-control']) !!}
</div>

<!-- Backup02 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('backup02', 'Backup02:') !!}
    {!! Form::text('backup02', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('counts.index') !!}" class="btn btn-default">Cancel</a>
</div>
