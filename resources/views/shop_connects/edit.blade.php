@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            会员卡关联店铺
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($shopConnect, ['route' => ['shopConnects.update', $shopConnect->id], 'method' => 'patch']) !!}

                        @include('shop_connects.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection