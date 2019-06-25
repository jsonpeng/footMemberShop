@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加会员
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'memberManage.store','method' => 'post']) !!}

                        @include('member_manage.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
