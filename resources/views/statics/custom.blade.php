@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">销售统计</h1>
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
                        <label>起止时间</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_start" id="create_start" placeholder="开始时间"  @if (array_key_exists('create_start', $input))value="{{$input['create_start']}}"@endif  {!! Request::is('memberCount') || Request::is('memberCount/month') ? 'disabled' : '' !!}>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="create_end" id="create_end" placeholder="结束时间" @if (array_key_exists('create_end', $input))value="{{$input['create_end']}}"@endif {!! Request::is('memberCount') || Request::is('memberCount/month') ? 'disabled' : '' !!}>
                            </div>
                        </div>
                    </div>

                     <div class="form-group col-md-2">
                        <label>根据分店</label>
                        <div class="row">
                            <div class="col-md-12">
                        <select class="form-control" name="fendian">
                            <option value="全部" @if (!array_key_exists('fendian', $input)) selected="selected" @endif>全部</option>
                            
                            @foreach($shop as $shops)
                          <option value="{!! $shops->id !!}"   @if(array_key_exists('fendian', $input) && $input['fendian']==$shops->id) selected="selected" @endif>{!! $shops->name !!}</option>
                            @endforeach
                             
                        </select>
                             </div>
                        </div>
                    </div>

             

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" onclick="search()">查询</button>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
          

  <div class="" style="margin-top:20px;">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ><a href="{!! route('memberCount.index') !!}" >今日统计</a></li>
                    <li ><a href="{!! route('memberCount.month') !!}" >当月统计</a></li>
                    <li class="active"><a href="{!! route('memberCount.custom') !!}" >自定义统计</a></li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box box-primary" style="border-top: none;">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-jpy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">营业额</span>
                                      <span class="info-box-number"> {!! $stats_price_count !!} 元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                               
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">订单数</span>
                                      <span class="info-box-number"> {!! $stats_dingdan_count !!}笔</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                      <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-jpy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">会员卡销售额</span>
                                      <span class="info-box-number">{!! $card_buy_price !!}元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                  <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">会员卡销售数量</span>
                                      <span class="info-box-number">{!! $card_buy_num !!}张</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->

                            </div><!-- /.row -->
                            <div class="box-header">
                               消费会员统计
                            </div>
                            <div class="box-body">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>会员姓名</th>
                                            <th>会员手机号</th>
                                            <th>店铺</th>
                                            <th>消费订单号</th>
                                            <th>消费金额</th>     
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($stats as $stat)
                                          <tr>
                                                <td>{{$stat->user->nickname}}</td>
                                                <td>{{$stat->user->mobile}}</td>
                                                <td>{{$stat->shop->name}}</td>
                                                <td>{{$stat->no}}</td>
                                                <td>{{$stat->price}}</td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                  
                      
                
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div><!-- /.col -->
{!! $stats->appends($input)->links()  !!}
          </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        //Date range picker
        $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});


        function search() {
            window.location.href = "/memberCount?"+$('#form_search').serialize();
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