@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            设置
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($setting, ['route' => ['settings.update', $setting->id], 'method' => 'patch',  'enctype' => 'multipart/form-data']) !!}

                        @include('settings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection