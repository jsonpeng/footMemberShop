@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tuaninfo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tuaninfo, ['route' => ['tuaninfos.update', $tuaninfo->id], 'method' => 'patch']) !!}

                        @include('tuaninfos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection