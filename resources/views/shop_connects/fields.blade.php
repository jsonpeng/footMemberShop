<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shop_id', '分店ID:') !!}
    {!! Form::text('shop_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '店铺名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Shop Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shop_connet_id', '关联分店:') !!}
    {!! Form::select('shop_connet_id', $shops , null, ['class' => 'form-control selectpicker conpon_type']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('shopConnects.index') !!}" class="btn btn-default">取消</a>
</div>
