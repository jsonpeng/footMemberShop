<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '分类名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
 {!! Form::label('分类图', '分类图:') !!}
  <div class="input-append">
                        {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
                        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">更改</a>
                        <img src="@if($cats)
                            {{$cats->image}}
                        @endif" style="max-width: 100%; max-height: 50px; display: block;">
                    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cats.index') !!}" class="btn btn-default">返回</a>
</div>
