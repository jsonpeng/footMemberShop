@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">订单列表</h1>
        <h1 class="pull-right">
           <!--a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('orders.create') !!}">Add New</a-->
        </h1>
    </section>
    <div class="content">
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
                        <label>根据起止时间</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_start" id="create_start" placeholder="开始时间"  @if (array_key_exists('create_start', $input))value="{{$input['create_start']}}"@endif>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_end" id="create_end" placeholder="结束时间" @if (array_key_exists('create_end', $input))value="{{$input['create_end']}}"@endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label>支付状态</label>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control" name="order_delivery">
                                    <option value="" @if (!array_key_exists('order_delivery', $input)) selected="selected" @endif>全部</option>
                                    <option value="未支付" @if (array_key_exists('order_delivery', $input) && $input['order_delivery'] == '未支付') selected="selected" @endif>未支付</option>
                                    <option value="已支付" @if (array_key_exists('order_delivery', $input) && $input['order_delivery'] == '已支付') selected="selected" @endif>已支付</option>
                                </select>
                             </div>
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label>分店</label>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control" name="shop_id">
                                    <option value="0" @if (!array_key_exists('shop_id', $input) || empty($input['shop_id'])) selected="selected" @endif>全部</option>
                                    @foreach ($shops as $shop)
                                        <option value="{{$shop->id}}" @if (array_key_exists('shop_id', $input) && $input['shop_id'] == $shop->id ) selected="selected" @endif>{{$shop->name}}</option>
                                    @endforeach
                                </select>
                             </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>手机号</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="手机号" @if (array_key_exists('mobile', $input))value="{{$input['mobile']}}"@endif>
                             </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" onclick="search()">查询</button>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('orders.table')
            </div>
        </div>

        {!! $orders->appends($input)->links()  !!}
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">

        function search() {
            window.location.href = "/orders?"+$('#form_search').serialize();
        }

          $('#sendtime_start, #sendtime_end, #create_start, #create_end').datepicker({
            format: "yyyy-mm-dd",
            language: "zh-CN",
            todayHighlight: true
        });

        // function search() {
        //     window.location.href = "/orders?"+$('#form_search').serialize();
        // }
    </script>
@endsection
