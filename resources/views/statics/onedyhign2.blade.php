  @extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">销售统计</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

  <div class="" style="margin-top:20px;">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li ><a href="{!! route('memberCount.index') !!}" >今日统计</a></li>
                    <li ><a href="{!! route('memberCount.month') !!}" >当月统计</a></li>
                    <li><a href="{!! route('memberCount.custom') !!}" >自定义统计</a></li>
                    <li class="active"><a href="{!! route('memberCount.highday2') !!}" data-toggle="tab">当日消费两次及以上</a></li>
                    <li><a href="{!! route('memberCount.allday2') !!}">连续消费2天及以上</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box box-primary" style="border-top: none;">
                 
                            <div class="box-header">
                               会员统计
                            </div>
                            <div class="box-body">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>会员姓名</th>
                                            <th>会员手机号</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($stats as $stat)
                                          <tr>
                                                <td>{{$stat->nickname}}</td>
                                                <td>{{$stat->mobile}}</td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="box box-primary" style="border-top: none;">

                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">营业额</span>
                                      <span class="info-box-number"> 元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">成本</span>
                                      <span class="info-box-number"> 元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">新增用户数</span>
                                      <span class="info-box-number"> 位</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">订单数</span>
                                      <span class="info-box-number"> 笔</span>
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
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <div class="box box-primary" style="border-top: none;">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">营业额</span>
                                      <span class="info-box-number"> 元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">成本</span>
                                      <span class="info-box-number"> 元</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">新增用户数</span>
                                      <span class="info-box-number"> 位</span>
                                    </div><!-- /.info-box-content -->
                                  </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                  <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">订单数</span>
                                      <span class="info-box-number"> 笔</span>
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
                                      

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_4">
                        <div class="box-body">
                            <!-- Date range -->
                        
                            
                        </div>
                    </div>
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div><!-- /.col -->

          </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        //Date range picker
        $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});
    </script>
@endsection