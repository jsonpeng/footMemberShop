<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control','disabled'=>'true']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', '操作:') !!}
    {!! Form::text('type', null, ['class' => 'form-control','disabled'=>'true']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '金额:') !!}
    {!! Form::text('price', null, ['class' => 'form-control','disabled'=>'true']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', '状态:') !!}
    {!! Form::text('status', null, ['class' => 'form-control','style'=>'display:none;']) !!}
     <select class="form-control" id="status_change" name="status">
              <option value="处理中"   {!! $accountUser->status=='处理中'?'selected':'' !!}>处理中</option>
              <option value="已完成"   {!! $accountUser->status=='已完成'?'selected':'' !!}>已完成</option>
              <option value="发起提现" {!! $accountUser->status=='发起提现'?'selected':'' !!}>发起提现</option>
     </select>
</div>

<!-- Arrive Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('arrive_time', '预计到账时间:') !!}
    {!! Form::text('arrive_time', null, ['class' => 'form-control','id'=>'create_end']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('accountUsers.index') !!}" class="btn btn-default">返回</a>
</div>
