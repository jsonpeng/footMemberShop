@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加新的商品
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'products.store']) !!}

                        @include('products.fields',['cats'=>$cats,'selectedcats'=>[],'products'=>null])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@include('partials.imagemodel')
@endsection
@include('partials.js')