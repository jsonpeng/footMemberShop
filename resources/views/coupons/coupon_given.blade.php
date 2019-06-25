@extends('layouts.app')

@section('content')
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="box box-default box-solid" style="margin-top:20px;">
    <div class="box-header with-border">
      <h3 class="box-title">用户筛选</h3>
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

          <div class="form-group col-md-2">
            <label>消费金额</label>
            <div class="row">
              <div class="col-md-12">
                <input type="text" name="jine" class="form-control" @if (array_key_exists('jine', $input))value="{{$input['jine']}}"@endif>
              </div>
            </div>
          </div>

          <div class="form-group col-md-2">
            <label>消费次数</label>
            <div class="row">
              <div class="col-md-12">
                <input type="text" name="times" class="form-control" @if (array_key_exists('times', $input))value="{{$input['times']}}"@endif>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary pull-right"">查询</button>
          </div>
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="box box-default box-solid" style="margin-top:20px;">
    <div class="box-header with-border">
      <h3 class="box-title">发放优惠券</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">
        <form action="/coupons/giveCoupon" method="post">
          {{ csrf_field() }}
          <div class="form-group col-md-2">
              <label>选择赠送的优惠券</label>
              <div class="row">
                  <div class="col-md-12">
                    <select class="form-control" name="coupon_id">
                        @foreach($coupons as $coupon)
                        <option value="{!! $coupon->id !!}"  @if(array_key_exists('coupon_id', $input) && $input['coupon_id']==$coupon->id) selected="selected" @endif>{!! $coupon->name !!}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
          </div>

          <div class="form-group col-md-2">
              <label>赠送张数</label>
              <div class="row">
                  <div class="col-md-12">
                    <input type="number" name="coupon_count" class="form-control" value="1">
                  </div>
              </div>
          </div>

          <div class="form-group col-md-2">
              <label> </label>
              <div class="row">
                  <div class="col-md-12">
                    <input type="submit" value="确认发放优惠券" class="form-control btn btn-primary" />
                  </div>
              </div>
          </div>
          <div class="form-group col-md-12">共{{count($orders) + count($users)}}用户，已勾选<span id="select_users">0</span>个用户</div>
          <div class="form-group col-md-12">
            <div class="btn btn-primary" id="btnCheckAll">全选</div>
            <div class="btn btn-default" id="btnCheckNone">全部取消</div>
            <div class="btn btn-default" id="btnCheckReverse">反选</div>
          </div>


          <table width="100%" class="table table-responsive">
            <thead>
              <tr>
                <th>选择</th>
                <th>用户</th>
                <th>手机号</th>
                <th>消费次数</th>
                <th>消费金额</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <?php $tmpuser =$order->user; ?>
                <tr>
                  <td>{!! Form::checkbox('users[]', $tmpuser->id, false, ['class' => 'field minimal']) !!}</td>
                  <td>{{$tmpuser->nickname}}</td>
                  <td><a href="/orders?uid={{$tmpuser->id}}">{{$tmpuser->mobile}}</a></td>
                  <td>{{$order->user_count}}</td>
                  <td>{{$order->amount}}</td>
                </tr>
              @endforeach

              @foreach ($users as $user)
                <tr>
                  <td>{!! Form::checkbox('users[]', $user->id, false, ['class' => 'field minimal']) !!}</td>
                  <td>{{$user->nickname}}</td>
                  <td><a href="/orders?uid={{$user->id}}">{{$user->mobile}}</a></td>
                  <td>0</td>
                  <td>0</td>
                </tr>
              @endforeach
              
            </tbody>
          </table>

          
        </form>
      </div>    
    </div><!-- /.box -->
  </div>
@endsection

@section('scripts')
<script type="text/javascript">
  //Date range picker
  $('#reservation').daterangepicker({format: 'YYYY-MM-DD'});

  $('#time_start, #time_end').datepicker({
    format: "yyyy-mm-dd",
    language: "zh-CN",
    todayHighlight: true
  });

  // 全选
  $("#btnCheckAll").bind("click", function () {
       $("input[name='users[]']").each(function() {  
          $(this).prop("checked", true); 
      });
      $('#select_users').text($("input[name='users[]']:checked").length); 
      
  });

  // 全不选
  $("#btnCheckNone").bind("click", function () {
      $("input[name='users[]']").each(function() {  
            $(this).prop("checked", false); 
      }); 
      $('#select_users').text($("input[name='users[]']:checked").length); 
  });

  // 反选
  $("#btnCheckReverse").bind("click", function () {
      $("[name = 'users[]']:checkbox").each(function () {
          $(this).prop("checked", !$(this).prop("checked"));
      });
      $('#select_users').text($("input[name='users[]']:checked").length); 
  });

  $('input[type=checkbox]').click(function(){
      $('#select_users').text($("input[name='users[]']:checked").length);
  });

</script>

@endsection