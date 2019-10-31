@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            分店
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($shop, ['route' => ['shops.update', $shop->id], 'method' => 'patch']) !!}

                        @include('shops.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection