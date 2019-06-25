@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Card Buy
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cardBuy, ['route' => ['cardBuys.update', $cardBuy->id], 'method' => 'patch']) !!}

                        @include('card_buys.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection