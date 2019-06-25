@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            新用户赠送优惠券设置
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'couponSettings.store']) !!}

                        @include('coupon_settings.fields', ['coupons' => $coupons])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
