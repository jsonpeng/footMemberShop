@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Coupon New User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($couponNewUser, ['route' => ['couponNewUsers.update', $couponNewUser->id], 'method' => 'patch']) !!}

                        @include('coupon_new_users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection