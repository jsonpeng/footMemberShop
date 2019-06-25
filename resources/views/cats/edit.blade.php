@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑商品分类
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cats, ['route' => ['cats.update', $cats->id], 'method' => 'patch']) !!}

                        @include('cats.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@include('partials.imagemodel')
@endsection
@include('partials.js')