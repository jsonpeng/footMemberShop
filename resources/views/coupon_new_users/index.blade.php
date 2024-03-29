@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">优惠券设置</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    {!! Form::model($couponNewUser, ['route' => ['couponNewUsers.update', $couponNewUser->id], 'method' => 'patch']) !!}

                        @include('coupon_new_users.fields')

                   {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

