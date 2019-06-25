@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            拼团设置
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tuansetting, ['route' => ['tuansettings.update', $tuansetting->id], 'method' => 'patch']) !!}

                        @include('tuansettings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection