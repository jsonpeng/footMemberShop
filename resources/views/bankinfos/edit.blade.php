@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
          编辑银行卡信息
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($bankinfo, ['route' => ['bankinfos.update', $bankinfo->id], 'method' => 'patch']) !!}

                        @include('bankinfos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection