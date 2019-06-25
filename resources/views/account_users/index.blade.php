@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">钱包用户记录</h1>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('accountUsers.create') !!}">Add New</a>
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>
  <div class="nav-tabs-custom" style="margin-top:20px;">
           
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box box-primary" style="border-top: none;">
                            <div class="row">

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-jpy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">收钱总金额</span>
                                      <span class="info-box-number">{!! $zong_price !!}</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                               
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">返还总金额</span>
                                      <span class="info-box-number">{!! $fanxian_price !!}</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                               <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-jpy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">提现总金额</span>
                                      <span class="info-box-number">{!! $tixian_price !!}元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->


                            </div><!-- /.row -->
                 
                        </div>
                    </div><!-- /.tab-pane -->
                  
                      
                
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('account_users.table')
            </div>
        </div>
          {!! $accountUsers->appends("")->links()  !!}
    </div>
@endsection

