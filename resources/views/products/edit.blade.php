@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑商品
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($products, ['route' => ['products.update', $products->id], 'method' => 'patch']) !!}

                        @include('products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
    @include('partials.imagemodel')
@endsection
 @include('partials.js')