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
                    <li><a href="{!! route('memberCount.index') !!}" >今日统计</a></li>
                    <li><a href="{!! route('memberCount.month') !!}" >当月统计</a></li>
                    <li><a href="{!! route('memberCount.custom') !!}" >自定义统计</a></li>
                    <li ><a href="{!! route('memberCount.highday2') !!}" >当日消费两次及以上</a></li>
                    <li class="active"><a href="{!! route('memberCount.allday2') !!}" >连续消费2天及以上</a></li>
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