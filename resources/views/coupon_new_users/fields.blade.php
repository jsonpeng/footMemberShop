<!-- New Open Field -->
<div class="form-group col-sm-6">
    <label class="fb">{!! Form::checkbox('new_open', 1, null, ['class' => 'field minimal']) !!}向新用户发放生日券</label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('couponNewUsers.index') !!}" class="btn btn-default">取消</a>
</div>
