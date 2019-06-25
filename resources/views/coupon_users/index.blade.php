@extends('layouts.app')

@section('content')
    <!--section class="content-header">
        <h1 class="pull-left">Coupon Users</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('couponUsers.create') !!}">Add New</a>
        </h1>
    </section-->
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="box box-default box-solid" style="margin-top:20px;">
            <div class="box-header with-border">
              <h3 class="box-title">查询时间段</h3>
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
                        <input type="text" class="form-control" name="time_start" id="time_start" placeholder="开始时间"  @if (array_key_exists('time_start', $input))value="{{substr($input['time_start'],0,10)}}"@endif  {!! Request::is('memberCount*') || Request::is('memberCount/month') ? 'disabled' : '' !!}>
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="time_end" id="time_end" placeholder="结束时间" @if (array_key_exists('time_end', $input))value="{{substr($input['time_end'],0,10)}}"@endif {!! Request::is('memberCount*') || Request::is('memberCount/month') ? 'disabled' : '' !!}>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary pull-right"">查询</button>
                  </div>
                </form>
              </div><!-- /.box-body -->
            </div><!-- /.box -->

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <div>未过期未使用</div>
                    <table width="300">
                        <thead>
                            <tr>
                                <th>名称</th>
                                <th>类型</th>
                                <th>数量</th>
                                <th>金额</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons01 as $coupon)
                                <tr>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->type}}</td>
                                    <td>{{$coupon->count}}</td>
                                    <td>@if($coupon->type != '打折券'){{$coupon->amount}}@endif</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                    <div>过期未使用</div>
                    <table width="300">
                        <thead>
                            <tr>
                                <th>名称</th>
                                <th>类型</th>
                                <th>数量</th>
                                <th>金额</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons02 as $coupon)
                                <tr>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->type}}</td>
                                    <td>{{$coupon->count}}</td>
                                    <td>@if($coupon->type != '打折券'){{$coupon->amount}}@endif</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                    <div>已使用</div>
                    <table width="300">
                        <thead>
                            <tr>
                                <th>名称</th>
                                <th>类型</th>
                                <th>数量</th>
                                <th>金额</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons03 as $coupon)
                                <tr>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->type}}</td>
                                    <td>{{$coupon->count}}</td>
                                    <td>@if($coupon->type != '打折券'){{$coupon->amount}}@endif</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

  $('#time_start, #time_end').datepicker({
    format: "yyyy-mm-dd",
    language: "zh-CN",
    todayHighlight: true
  });


</script>

@endsection