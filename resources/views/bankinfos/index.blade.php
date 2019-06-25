@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">用户银行卡信息</h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>
 
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('bankinfos.table')
            </div>
        </div>
  {!! $bankinfos->appends("")->links()  !!}
    </div>
@endsection

