@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Count
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($count, ['route' => ['counts.update', $count->id], 'method' => 'patch']) !!}

                        @include('counts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection