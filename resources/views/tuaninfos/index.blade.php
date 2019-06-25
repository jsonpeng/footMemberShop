@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">当前拼团情况</h1>
  
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

  <div class="box box-default box-solid" style="margin-top:20px;">
            <div class="box-header with-border">
              <h3 class="box-title">查询</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <form id="form_search">
               
               
                    <div class="form-group col-md-4">
                        <label>请输入商品名称</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="product_name" placeholder="请输入商品名称"  @if (array_key_exists('product_name', $input))value="{{$input['product_name']}}"@endif>
                            </div>
                          
                        </div>
                    </div>

                         <div class="form-group col-md-4">
                        <label>起止时间</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_start" id="create_start" placeholder="开始时间"  @if (array_key_exists('create_start', $input))value="{{$input['create_start']}}"@endif >
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_end" id="create_end" placeholder="结束时间" @if (array_key_exists('create_end', $input))value="{{$input['create_end']}}"@endif >
                            </div>
                        </div>
                    </div>
                 

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" onclick="search()">查询</button>
                    </div>
                </form>
            </div><!-- /.box-body -->
  </div><!-- /.box -->


   <div class="nav-tabs-custom" style="margin-top:20px;">
           
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box box-primary" style="border-top: none;">
                            <div class="row">

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-jpy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">总团数</span>
                                      <span class="info-box-number">{!! $tuan_num !!}个</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                               
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">总人数</span>
                                      <span class="info-box-number">{!! $tuan_man_num !!}个</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                               <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-jpy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">总金额</span>
                                      <span class="info-box-number">{!! $tuan_all_price !!}元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->


                            </div><!-- /.row -->
                 
                        </div>
                    </div><!-- /.tab-pane -->
                  
                      
                
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->


        <div class="box box-primary">
            <div class="box-body">
                    @include('tuaninfos.table')
            </div>
        </div>
          @if(count($tuaninfos)>0)
           {!! $tuaninfos->appends($input)->links()  !!}
          @endif
    </div>
@endsection

