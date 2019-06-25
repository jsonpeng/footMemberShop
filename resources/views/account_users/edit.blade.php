@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
          更新操作状态
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($accountUser, ['route' => ['accountUsers.update', $accountUser->id], 'method' => 'patch']) !!}

                        @include('account_users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

