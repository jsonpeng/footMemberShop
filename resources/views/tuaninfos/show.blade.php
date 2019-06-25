@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            中奖信息
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                <?php $userlist=$tuaninfo->users()->get();?>

                @foreach($userlist as $list)
                <div class="form-group ">
                    @if($tuaninfo->tuanzhang->nickname==$list->nickname){!! Form::label('id', '团长:') !!}@else{!! Form::label('id', '中奖人:') !!}@endif
                    {!! $list->nickname !!}
                     {!! Form::label('id', '手机号:') !!}
                    {!! $list->mobile !!}
                </div>
                @endforeach

                    <a href="{!! route('tuaninfos.index') !!}" class="btn btn-default">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
