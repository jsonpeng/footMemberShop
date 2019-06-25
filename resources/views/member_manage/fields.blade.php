
<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('姓名', '姓名:') !!}
    {!! Form::text('nickname', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('手机号', '手机号:') !!}
    {!! Form::number('mobile', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('状态', '状态:') !!}

   
  {!! Form::text('status', null, ['class' => 'form-control','id'=>'now_state','style'=>'display:none;']) !!} 

         <select class="form-control" id="status_change">
              <option value="开启" @if($status=='开启')selected @endif>开启</option>
              <option value="禁止"  @if($status=='禁止')selected @endif>禁止</option>
        </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('memberManage.index') !!}" class="btn btn-default">返回</a>
</div>
