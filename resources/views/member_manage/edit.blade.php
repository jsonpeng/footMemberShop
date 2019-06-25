@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑会员
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['memberManage.update', $user->id], 'method' => 'patch']) !!}

                        @include('member_manage.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection